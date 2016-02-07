<?php

if(!class_exists('KcSeoMetaData')):

    class KcSeoMetaData
    {
        private $postType;
        function __construct()
        {
            $this->postType = get_post_types();
            add_action( 'add_meta_boxes', array($this, 'KcSeo_schema_meta_box'));
            add_action( 'save_post', array($this, 'save_KcSeo_schema_data'),10, 3);
            add_action('admin_print_scripts-post-new.php', array($this, 'kcSeo_wp_schema_admin_script'), 11);
            add_action('admin_print_scripts-post.php', array($this, 'kcSeo_wp_schema_admin_script'), 11);
        }

        function KcSeo_schema_meta_box(){

            foreach($this->postType as $postType){
                add_meta_box(
                    'kcseo-wordpres-seo-structured-data-schema-meta-box',
                    __('WP SEO Structured Data Schema by <a href="http://kcseopro.com/">KCSEOPro.com</a>', KCSEO_WP_SCHEMA_SLUG),
                    array($this,'meta_box_wp_schema'),
                    $postType,
                    'normal',
                    'high'
                );
            }

        }

        function meta_box_wp_schema($post){

            global $KcSeoWPSchema;
            wp_nonce_field( $KcSeoWPSchema->nonceText(), '_kcseo_nonce' );
            $schemas = new KcSeoSchemaModel;
            $html = null;
            $html .="<div class='schema-tips'>";
                $html .= "<p><span>Tip:</span> For more detailed information on how to configure this plugin, please visit: <a href='http://kcseopro.com/wordpress-seo-structured-data-schema-plugin/'>http://kcseopro.com/wordpress-seo-structured-data-schema-plugin/</a></p>";
                $html .= "<p><span>Tip:</span> Once you save these structured data schema settings, validate this page url here: <a href='https://developers.google.com/structured-data/testing-tool/'>https://developers.google.com/structured-data/testing-tool/</a></p>";
            $html .="</div>";
            $html .= "<div class='schema-holder'>";
                $html .= '<div id="tabs-kcseo-container">';
                        $htmlMenu = null;
                        $htmlCont = null;
                        $htmlMenu .= "<ul class='tabs-menu'>";
                        foreach($schemas->schemaTypes() as $schemaID => $schema){
                            $tabId = $KcSeoWPSchema->KcSeoPrefix.$schemaID;
                            $htmlMenu .= '<li><a href="#'.$tabId.'">'.$schema['title'].'</a></li>';
                            $htmlCont .="<div id='{$tabId}'>";
                                foreach($schema['fields'] as $fieldId => $data){
                                    $data['schemaId'] = $schemaID;
                                    $htmlCont .= $schemas->get_field($fieldId,$data, $post->ID);
                                }
                            $htmlCont .="</div>";
                        }
                        $htmlMenu .="</ul>";
                              $html .= $htmlMenu .$htmlCont;
            $html .= "</div>";
            echo $html;
        }

        function save_KcSeo_schema_data($post_id,$post, $update){
            if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
            global $KcSeoWPSchema;
            if (!wp_verify_nonce(@$_REQUEST['_kcseo_nonce'], $KcSeoWPSchema->nonceText())) return;

            // Check permissions
            if (@$_GET['post_type']) {
                if (!current_user_can('edit_' . @$_GET['post_type'], $post_id)) return;
            }

            if (!in_array(@$post->post_type,$this->postType) ) return;

            $meta = array();
            $schemaModel = new KcSeoSchemaModel;
            foreach($schemaModel->schemaTypes() as $schemaID => $schema){
                $schemaMetaId = $KcSeoWPSchema->KcSeoPrefix.$schemaID;
                $data = array();
                foreach($schema['fields'] as $fieldId => $fieldData){
                    $value = (isset($_REQUEST[$schemaMetaId][$fieldId]) ? ($_REQUEST[$schemaMetaId][$fieldId] ? sanitize_text_field($_REQUEST[$schemaMetaId][$fieldId]) : null) : null);
                    if($value){
                        $data[$fieldId] = $value;
                    }
                }
                if(!empty($data)){
                    $meta[$schemaMetaId] = serialize($data);
                }
            }

            foreach($meta as $mKey => $mValue){
                update_post_meta($post_id, $mKey, $mValue);
            }
        }

        function kcSeo_wp_schema_admin_script(){
            global $KcSeoWPSchema;
            wp_enqueue_style( 'jquery-ui-datepicker' );
            wp_enqueue_style( 'kcseo-jquery-ui-css', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css');
            wp_enqueue_style( 'kcseo-select2-css', $KcSeoWPSchema->assetsUrl .'css/select2.min.css');
            wp_enqueue_style( 'kcseo-admin-css', $KcSeoWPSchema->assetsUrl .'css/admin.css');
            wp_enqueue_script( 'kcseo-wordpres-seo-structured-data-schema-select2-js', $KcSeoWPSchema->assetsUrl . 'js/select2.min.js', array('jquery'), '', true);
            wp_enqueue_script('kcseo-wordpres-seo-structured-data-schema-admin-js', $KcSeoWPSchema->assetsUrl .'js/admin.js', array('jquery', 'jquery-ui-core', 'jquery-ui-tabs','jquery-ui-datepicker') ,'' , true);
        }

    }

endif;