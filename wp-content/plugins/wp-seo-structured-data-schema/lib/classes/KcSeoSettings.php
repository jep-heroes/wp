<?php

if(!class_exists('KcSeoSettings')):

    class KcSeoSettings
    {
        function __construct()
        {
            add_action( 'plugins_loaded', array($this, 'kcSeo_pluginInit') );
            add_action( 'admin_menu' , array($this, 'kcSeo_Wp_Schema_menu'));
            add_action(	'wp_ajax_kcSeoWpSchemaSettings', array($this, 'kcSeoWpSchemaSettings'));
            add_action(	'wp_ajax_newSocial', array($this, 'newSocial'));
        }

        function newSocial(){
            $schemaModel = new KcSeoSchemaModel;
            $id = ($_REQUEST['id'] ? $_REQUEST['id'] +1 : 0 );
            $html = null;
            $html = "<div class='sfield'>";
            $html .= "<select name='social[$id][id]'>";
            foreach ($schemaModel->socialList() as $skey => $social) {
                $html .= "<option value='$skey'>$social</option>";
            }
            $html .= "</select>";
            $html .= "<input type='text' name='social[$id][link]'>";
            $html .= '<span class="dashicons dashicons-trash social-remove"></span>';
            $html .= "</div>";


            wp_send_json( array('data' => $html) );
            die();
        }

        function kcSeoWpSchemaSettings(){
            global $KcSeoWPSchema;
            $error = true;
            $msg = null;
            if($KcSeoWPSchema->verifyNonce()){
                unset($_REQUEST['action']);
                update_option( $KcSeoWPSchema->options['settings'], $_REQUEST );
                $error = false;
                $msg = __('Settings successfully updated',KCSEO_WP_SCHEMA_SLUG);
            }else{
                $msg = __('Security Error !!',KCSEO_WP_SCHEMA_SLUG);
            }
            $response = array(
                'error'=> $error,
                'msg' => $msg
            );
            wp_send_json( $response );
            die();
        }

        function wp_schema_page(){
            global $KcSeoWPSchema;
            $KcSeoWPSchema->render('settings');
        }

        function kcSeo_Wp_Schema_menu(){
            global $KcSeoWPSchema;
            $page = add_menu_page( 'WP SEO Structured Data Schema', 'WP SEO Schema', 'manage_options', 'wp-seo-schema', array($this,'wp_schema_page'), $KcSeoWPSchema->assetsUrl . 'images/wp-seo-schema.png');

            add_action('admin_print_styles-' . $page, array( $this,'tlp_schema_style'));
            add_action('admin_print_scripts-'. $page, array( $this,'tlp_schema_script'));
        }

        function tlp_schema_style(){
            global $KcSeoWPSchema;
            wp_enqueue_style( 'kcseo-jquery-ui-css', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css');
            wp_enqueue_style( 'kcseo-select2-css', $KcSeoWPSchema->assetsUrl .'css/select2.min.css');
            wp_enqueue_style( 'kcseo-tooltip-css','http://cdnjs.cloudflare.com/ajax/libs/qtip2/2.2.1/jquery.qtip.css');
            wp_enqueue_style( 'kcseo-admin-css', $KcSeoWPSchema->assetsUrl .'css/admin.css');
        }
        function tlp_schema_script(){
            global $KcSeoWPSchema;
            wp_enqueue_script( 'kcseo-wordpres-seo-structured-data-schema-select2-js', $KcSeoWPSchema->assetsUrl . 'js/select2.min.js', array('jquery'), '', true);
            wp_enqueue_script( 'kcseo-wordpres-seo-structured-data-schema-tooltip-js', 'http://cdnjs.cloudflare.com/ajax/libs/qtip2/2.2.1/jquery.qtip.js', array('jquery'), '', true);
            wp_enqueue_script( 'kcseo-wordpres-seo-structured-data-schema-admin-js', $KcSeoWPSchema->assetsUrl . 'js/admin.js', array('jquery', 'jquery-ui-core', 'jquery-ui-tabs','jquery-ui-datepicker'), '', true);
        }

        function kcSeo_pluginInit(){
            load_plugin_textdomain( KCSEO_WP_SCHEMA_SLUG, FALSE,  KCSEO_WP_SCHEMA_LANGUAGE_PATH );
        }
    }
endif;