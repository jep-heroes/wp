<?php

if(!class_exists('KcSeoOutput')):

    class KcSeoOutput
    {
        function __construct()
        {
            add_action('wp_footer', array($this,'load_schema'), 1);
        }

        function load_schema(){
            global $KcSeoWPSchema, $post;
            $schemaModel = new KcSeoSchemaModel;
            $html = null;
            $settings = get_option($KcSeoWPSchema->options['settings']);
            if(is_home() || is_front_page()){
                $metaData = array();

                $metaData["@context"] = "http://schema.org/";
                $metaData["@type"] = "WebSite";

                if($settings['homeonly']){
                    $author_url = ($settings['siteurl'] ? $settings['siteurl'] : get_home_url());
                    $to_remove = array( 'http://', 'https://','www.' );
                    foreach ( $to_remove as $item ) {
                        $author_url = str_replace($item, '', $author_url); // to: www.example.com
                    }
                    $metaData["url"] = $author_url;
                    $metaData["name"] = $settings['sitename'];
                    $metaData["alternateName"] = $settings['siteaname'];
                    $html .= $schemaModel->get_jsonEncode($metaData);
                }else{
                    $metaData["url"] = get_home_url();
                    $metaData["potentialAction"] = array(
                        "@type" => "SearchAction",
                        "target" => get_home_url() ."/?s={query}",
                        "query-input" => "required name=query"
                    );
                    $html .= $schemaModel->get_jsonEncode($metaData);
                }
            }

            $webMeta = array();
            $webMeta["@context"] = "http://schema.org";
            $webMeta["@type"] = esc_attr($settings['site_type']);

            if($settings['additionalType']){
                $aType = explode("\r\n", $settings['additionalType']);
                if(!empty($aType) && is_array($aType)){
                    if(count($aType) == 1){
                        $webMeta["additionalType"] = $aType[0];
                    }else if(count($aType) > 1){
                        $webMeta["additionalType"] = $aType;
                    }
                }
            }

            if(esc_attr($settings['site_type']) == 'Person'){
                $webMeta["name"] = esc_attr( $settings['person']['name']);
                $webMeta["worksFor"] = esc_attr( $settings['person']['worksFor']);
                $webMeta["jobTitle"] = esc_attr( $settings['person']['jobTitle']);
                $webMeta["image"] = esc_attr( $settings['person']['image']);
                $webMeta["description"] = esc_attr( $settings['person']['description']);
                $webMeta["birthDate"] = esc_attr( $settings['person']['birthDate']);
            }else{
                $webMeta["name"] = esc_attr($settings['type_name']);
                $webMeta["logo"] = esc_attr( $settings['logo_url'] );
            }
            if(esc_attr($settings['site_type']) != "Organization" && esc_attr($settings['site_type']) != "Person"){
                $webMeta["description"] = esc_attr( $settings['business_info']['description'] );
                if($settings['business_info']['openingHours']){
                    $aOhour = explode("\r\n", $settings['business_info']['openingHours']);
                    if(!empty($aOhour) && is_array($aOhour)){
                        if(count($aOhour) == 1){
                            $webMeta["openingHours"] = $aOhour[0];
                        }else if(count($aOhour) > 1){
                            $webMeta["openingHours"] = $aOhour;
                        }
                    }
                }
                $webMeta["geo"] = array(
                    "@type" => "GeoCoordinates",
                    "longitude" => esc_attr( $settings['business_info']['longitude'] ),
                    "latitude" => esc_attr( $settings['business_info']['latitude'] )
                );
            }

            $webMeta["url"] = esc_attr( $settings['web_url']);
            if(!empty($settings['social']) && is_array($settings['social'])){
                $link = array();
                foreach ($settings['social'] as $socialD) {
                    if($socialD['link']){
                        $link[] =  $socialD['link'];
                    }
                }
                if(!empty($link)){
                    $webMeta["sameAs"] = $link;
                }
            }

            $webMeta["contactPoint"] = array(
                "@type" => "ContactPoint",
                "telephone" => esc_attr( $settings['contact']['telephone']),
                "contactType" => esc_attr( $settings['contact']['contactType']),
                "contactOption" => esc_attr( $settings['contact']['contactOption']),
                "areaServed" => esc_attr( @implode(',',$settings['area_served'])),
                "availableLanguage" => esc_attr( $settings['availableLanguage'])
            );
            $webMeta["address"] = array(
                "@type" => "PostalAddress",
                "addressCountry" => esc_attr($settings['address']['country']),
                "addressLocality" => esc_attr($settings['address']['locality']),
                "addressRegion" => esc_attr($settings['address']['region']),
                "postalCode" => esc_attr($settings['address']['postalcode']),
                "streetAddress" => esc_attr($settings['address']['street'])
            );
            if($webMeta["@type"]) {
                $html .= $schemaModel->get_jsonEncode($webMeta);
            }

            if(is_single() || is_page()){

                foreach($schemaModel->schemaTypes() as $schemaID => $schema){
                    $schemaMetaId = $KcSeoWPSchema->KcSeoPrefix.$schemaID;
                    $metaData = unserialize(get_post_meta($post->ID, $schemaMetaId, true ));
                    $firstItem = @current($metaData);
                    if(!empty($metaData) && is_array($metaData) && isset($firstItem)){
                        $html .= $schemaModel->schemaOutput($schemaID, $metaData);
                    }
                }
            }
            echo $html;
        }
    }
endif;