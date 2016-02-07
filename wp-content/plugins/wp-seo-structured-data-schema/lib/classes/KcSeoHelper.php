<?php

if(!class_exists('KcSeoSettings')):

    class KcSeoHelper
    {
        function verifyNonce( ){
            $nonce = @$_REQUEST['_kcseo_nonce'];
            if( !wp_verify_nonce( $nonce, $this->nonceText() ) ) return false;
            return true;
        }

        function nonceText(){
            return "kcseo_nonce_secret_text";
        }
    }

endif;