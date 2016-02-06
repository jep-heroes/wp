<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package SKT White
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width">
<link rel="apple-touch-icon" sizes="57x57" href="<?php bloginfo('template_url'); ?>/images/favicons/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="<?php bloginfo('template_url'); ?>/images/favicons/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="<?php bloginfo('template_url'); ?>/images/favicons/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="<?php bloginfo('template_url'); ?>/images/favicons/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="<?php bloginfo('template_url'); ?>/images/favicons/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="<?php bloginfo('template_url'); ?>/images/favicons/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="<?php bloginfo('template_url'); ?>/images/favicons/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="<?php bloginfo('template_url'); ?>/images/favicons/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="<?php bloginfo('template_url'); ?>/images/favicons/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="<?php bloginfo('template_url'); ?>/images/favicons/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="<?php bloginfo('template_url'); ?>/images/favicons/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="<?php bloginfo('template_url'); ?>/images/favicons/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="<?php bloginfo('template_url'); ?>/images/favicons/favicon-16x16.png">
<link rel="icon" type="image/x-icon" href="<?php bloginfo('template_url'); ?>/images/favicons/favicon.ico" />
<link rel="profile" href="http://gmpg.org/xfn/11">
<!--[if lt IE 9]>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/ie.css" type="text/css" media="all" />
<![endif]-->
<?php
	wp_head();
	$themename = wp_get_theme();
	$themename = preg_replace("/\W/", "_", strtolower($themename) );
	if( !get_option( 'optionsframework_skt_white_pro' ) ) {
	require get_template_directory() . '/index-default.php';
	exit;
	}
?>

</head>

<body <?php body_class(); ?>>

<?php if ( is_home() || is_front_page() ) { ?>
    <div class="slider-main">
       <?php

			$slAr = array();
			$m = 0;
			for ($i=1; $i<11; $i++) {
				if ( of_get_option('slide'.$i, true) != "" ) {
					$imgSrc 	= of_get_option('slide'.$i, true);
					$imgTitle	= of_get_option('slidetitle'.$i, true);
					$imgDesc	= of_get_option('slidedesc'.$i, true);
					$imglink	= of_get_option('slidelink'.$i, true);
					$imgbut		= of_get_option('slidebutton'.$i, true);
					if ( strlen($imgSrc) > 10 ) {
						$slAr[$m]['image_src'] = of_get_option('slide'.$i, true);
						$slAr[$m]['image_title'] = of_get_option('slidetitle'.$i, true);
						$slAr[$m]['image_desc'] = of_get_option('slidedesc'.$i, true);
						$slAr[$m]['image_url'] = of_get_option('slidelink'.$i, true);
						$slAr[$m]['image_but'] = of_get_option('slidebutton'.$i, true);
						$m++;
					}
				}

			}
			$slideno = array();
			if( $slAr > 0 ){
				$n = 0;?>
                <div id="slider" class="nivoSlider">
                <?php
                foreach( $slAr as $sv ){
                    $n++; ?><img src="<?php echo esc_url($sv['image_src']); ?>" alt="<?php echo esc_attr($sv['image_title']);?>" title="<?php if ( ($sv['image_title']!='') && ($sv['image_desc']!='')) { echo '#slidecaption'.$n ; } ?>"/><?php
                    $slideno[] = $n;
                }
                ?>
                </div><?php
                foreach( $slideno as $sln ){ ?>
                    <div id="slidecaption<?php echo $sln; ?>" class="nivo-html-caption">
                    <div class="top-bar">
                        <?php if( of_get_option('slidetitle'.$sln, true) != '' ){ ?>
                            <h2><?php echo of_get_option('slidetitle'.$sln, true); ?></h2>
                        <?php } ?>
                        <?php if( of_get_option('slidedesc'.$sln, true) != '' ){ ?>
                            <p><?php echo of_get_option('slidedesc'.$sln, true); ?></p>
                        <?php } ?>
						<?php if( of_get_option('slidebutton'.$sln, true) != ''){ ?>
                        	<?php echo of_get_option('slidebutton'.$sln, true); ?>
                        <?php } ?>
                    </div>
                    </div><?php
                } ?>

                </div>
                <div class="clear"></div><?php
			}
            ?>
        </div>
        <a href="<?php echo get_site_url(); ?>/#services" class="arrow-down"></a>
    </div><!-- slider -->
<?php } ?>

<div class="header">
				<div class="header-inner">
                    		<div class="logo">
                            		<a href="<?php echo home_url('/'); ?>">
                                    	<?php if( of_get_option( 'logo', true ) != '' ) { ; ?>
 	                                       <img src="<?php echo esc_url( of_get_option( 'logo', true )); ?>" / >
                                        <?php } else { ?>
    	                                    <h1><?php bloginfo('name'); ?></h1>
                                        <?php } ?>
                                    </a>
                                    <p><?php bloginfo('description'); ?></p>
                             </div><!-- logo -->
                            <div class="toggle">
                            <a class="toggleMenu" href="#"><?php _e('Menu','skt-white'); ?></a>
                            </div><!-- toggle -->
                            <div class="nav">
								<?php wp_nav_menu( array('theme_location'  => 'primary') ); ?>
                            </div><!-- nav --><div class="clear"></div>
                    </div><!-- header-inner -->
            </div><!-- header -->

 <?php if ( !is_home() || !is_front_page() ) { ?>
      <div class="innerbanner">
          <?php
			$header_image = get_header_image();
			if( is_single() || is_archive() || is_category() || is_author()|| is_search()) {
        		echo '<img src="'.esc_url( $header_image ).'" width="'.get_custom_header()->width.'" height="'.get_custom_header()->height.'" alt="" />';
			}
			elseif( has_post_thumbnail() ) {
				$src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
				$thumbnailSrc = $src[0];
				echo '<img src="'.$thumbnailSrc.'" alt="">';
			}
			elseif ( ! empty( $header_image ) ) {
				echo '<img src="'.esc_url( $header_image ).'" width="'.get_custom_header()->width.'" height="'.get_custom_header()->height.'" alt="" />';
            }
			else {
            	echo '<img src="'.get_template_directory_uri().'/images/default-banner.jpg" alt="">';
		    } ?>
    </div>
 <?php } ?>

      <div class="main-container">
         <?php if( function_exists('is_woocommerce') && is_woocommerce() ) { ?>
		 	<div class="content-area">
                <div class="middle-align content_sidebar">
                	<div id="sitemain" class="site-main">
         <?php } ?>
