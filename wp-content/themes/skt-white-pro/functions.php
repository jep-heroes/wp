<?php
/**
 * SKT White functions and definitions
 *
 * @package SKT White
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
function content($limit) {
$content = explode(' ', get_the_content(), $limit);
if (count($content)>=$limit) {
array_pop($content);
$content = implode(" ",$content).'...';
} else {
$content = implode(" ",$content);
}	
$content = preg_replace('/\[.+\]/','', $content);
$content = apply_filters('the_content', $content);
$content = str_replace(']]>', ']]&gt;', $content);
return $content;
}


if ( ! function_exists( 'skt_white_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function skt_white_setup() {

	if ( ! isset( $content_width ) )
		$content_width = 640; /* pixels */

	load_theme_textdomain( 'skt-white', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'woocommerce' );
	add_theme_support( 'title-tag' );
	add_image_size('homepage-thumb',240,145,true);
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'skt-white' ),
	) );
	add_theme_support( 'custom-background', array(
		'default-color' => 'ffffff'
	) );
	add_editor_style( 'editor-style.css' );
}
endif; // skt_white_setup
add_action( 'after_setup_theme', 'skt_white_setup' );


function skt_white_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Blog Sidebar', 'skt-white' ),
		'description'   => __( 'Appears on blog page sidebar', 'skt-white' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Main Sidebar', 'skt-white' ),
		'description'   => __( 'Appears on page sidebar', 'skt-white' ),
		'id'            => 'sidebar-main',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Footer Widget 1', 'skt-white' ),
		'description'   => __( 'Appears on footer', 'skt-white' ),
		'id'            => 'footer-1',
		'before_widget' => '<div class="footer-col-1">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Footer Widget 2', 'skt-white' ),
		'description'   => __( 'Appears on footer', 'skt-white' ),
		'id'            => 'footer-2',
		'before_widget' => '<div class="footer-col-1">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Footer Widget 3', 'skt-white' ),
		'description'   => __( 'Appears on footer', 'skt-white' ),
		'id'            => 'footer-3',
		'before_widget' => '<div class="footer-col-3">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'skt_white_widgets_init' );

define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/' );
require_once get_template_directory() . '/inc/options-framework.php';

// Loads options.php from child or parent theme
$optionsfile = locate_template( 'options.php' );
load_template( $optionsfile );


function skt_white_scripts() {
	wp_enqueue_style( 'skt_white-gfonts-opensans', '//fonts.googleapis.com/css?family=Open+Sans:400,600,700','',null );
	wp_enqueue_style( 'skt_white-gfonts-roboto', '//fonts.googleapis.com/css?family=Roboto:400,100,300,500,700','',null );
	wp_enqueue_style( 'skt_white-gfonts-opensanscondensed', '//fonts.googleapis.com/css?family=Open+Sans+Condensed:300','',null );

	if( of_get_option('bodyfontface',true) != '' ){
		wp_enqueue_style( 'skt_white-gfonts-body', '//fonts.googleapis.com/css?family='.rawurlencode(of_get_option('bodyfontface',true)),'',null );
	}
	if( of_get_option('logofontface',true) != '' ){
		wp_enqueue_style( 'skt_white-gfonts-logo', '//fonts.googleapis.com/css?family='.rawurlencode(of_get_option('logofontface',true)),'',null );
	}
	if ( of_get_option('navfontface', true) != '' ) {
		wp_enqueue_style( 'skt_white-gfonts-nav', '//fonts.googleapis.com/css?family='.rawurlencode(of_get_option('navfontface',true)),'',null );
	}
	if ( of_get_option('headfontface', true) != '' ) {
		wp_enqueue_style( 'skt_white-gfonts-heading', '//fonts.googleapis.com/css?family='.rawurlencode(of_get_option('headfontface',true)),'',null );
	}
	if ( of_get_option('sldfontface', true) != '' ) {
		wp_enqueue_style( 'skt_white-gfonts-slide', '//fonts.googleapis.com/css?family='.rawurlencode(of_get_option('sldfontface',true)),'',null );
	}
	if ( of_get_option('slddscfontface', true) != '' ) {
		wp_enqueue_style( 'skt_white-gfonts-slidedsc', '//fonts.googleapis.com/css?family='.rawurlencode(of_get_option('slddscfontface',true)),'',null );
	}
	if ( of_get_option('foottitlefontface', true) != '' ) {
		wp_enqueue_style( 'skt_white-gfonts-foottitle', '//fonts.googleapis.com/css?family='.rawurlencode(of_get_option('foottitlefontface',true)),'',null );
	}
	if ( of_get_option('copyfontface', true) != '' ) {
		wp_enqueue_style( 'skt_white-gfonts-copyfont', '//fonts.googleapis.com/css?family='.rawurlencode(of_get_option('copyfontface',true)),'',null );
	}
	if ( of_get_option('designfontface', true) != '' ) {
		wp_enqueue_style( 'skt_white-gfonts-designfont', '//fonts.googleapis.com/css?family='.rawurlencode(of_get_option('designfontface',true)),'',null );
	}

	wp_enqueue_style( 'skt_white-basic-style', get_stylesheet_uri() );
	wp_enqueue_style( 'skt_white-editor-style', get_template_directory_uri().'/editor-style.css','',null );
	wp_enqueue_style( 'skt_white-base-style', get_template_directory_uri().'/css/style_base.css','',null );
	wp_enqueue_style( 'skt_white-responsive-style', get_template_directory_uri().'/css/theme-responsive.css','',null );
	if ( (of_get_option('innerpageslider', true) != 'hide') || is_home() || is_front_page() ) { 
		wp_enqueue_style( 'skt_white-nivo-style', get_template_directory_uri().'/css/nivo-slider.css','',null );
		wp_enqueue_script( 'skt_white-nivo-slider', get_template_directory_uri() . '/js/jquery.nivo.slider.js', array('jquery'),null,true );
	}
	wp_enqueue_style( 'skt_white-prettyphoto-style', get_template_directory_uri().'/css/prettyPhoto.css','',null );
	wp_enqueue_style( 'skt_white-fontawesome-style', get_template_directory_uri().'/css/font-awesome.min.css','',null );
	wp_enqueue_script( 'skt_white-prettyphoto-script', get_template_directory_uri() . '/js/jquery.prettyPhoto.js', array('jquery'),null,true );
	wp_enqueue_script( 'skt_white-customscripts', get_template_directory_uri() . '/js/custom.js', array('jquery'),null );
	wp_enqueue_script( 'skt_white-smooth-scroll', get_template_directory_uri() . '/js/smooth-scroll.js', array('jquery'),null );
	wp_enqueue_script( 'skt_white-filter-scripts', get_template_directory_uri().'/js/filter-gallery.js','',null,true);
	wp_enqueue_style( 'skt_white-animation-style', get_template_directory_uri().'/css/animation.css','',null );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'skt_white_scripts' );

function media_css_hook(){
	
	?>
    	
    	<script>
			jQuery(window).bind('scroll', function() {
	var wwd = jQuery(window).width();
	if( wwd > 999 ){
		var navHeight = jQuery( window ).height() - 0;
		<?php if( of_get_option('headstick',true) != true) { ?>
		if (jQuery(window).scrollTop() > navHeight) {
			jQuery('.header').addClass('fixed');
		}else {
			jQuery('.header').removeClass('fixed');
		}
		<?php } ?>
	}
});
			jQuery.noConflict();
			jQuery(window).load(function() {
        jQuery('#slider').nivoSlider({
        	effect:'<?php echo of_get_option('slideefect','fade'); ?>', //sliceDown, sliceDownLeft, sliceUp, sliceUpLeft, sliceUpDown, sliceUpDownLeft, fold, fade, random, slideInRight, slideInLeft, boxRandom, boxRain, boxRainReverse, boxRainGrow, boxRainGrowReverse
		  	animSpeed: <?php echo of_get_option('slideanim',500); ?>,
			pauseTime: <?php echo of_get_option('slidepause',3000); ?>,
			directionNav: <?php echo of_get_option('slidenav','true'); ?>,
			controlNav: <?php echo of_get_option('slidepage','true'); ?>,
			pauseOnHover: <?php echo of_get_option('slidepausehover','false'); ?>,
    });
});
		</script>
    <?php
		
	}
add_action('wp_head','media_css_hook');


function skt_white_custom_head_codes() { 
	if ( function_exists('of_get_option') ){
		if ( of_get_option('style2', true) != '' ) {
			echo "<style>". esc_html( of_get_option('style2', true) ) ."</style>";
		}
		echo "<style>";
		if ( of_get_option('bodyfontface', true) != '') {
			echo 'body, .top-grey-box, p, .testimonial-section, .feature-box p, .address, #footer .footer-inner p, .right-features .feature-cell .feature-desc, .price-table{font-family:\''. esc_html( of_get_option('bodyfontface', true) ) .'\', sans-serif;}';
		}
		if ( of_get_option('bodyfontcolor', true) != '' ) {
			echo 'body, .contact-form-section .address, .newsletter, .top-grey-box, .testimonial-section .testimonial-box .testimonial-content .testimonial-mid, .right-features .feature-cell, .accordion-box .acc-content, .work-box .work-info, .feature-box{color:'. esc_html( of_get_option('bodyfontcolor', true) ) .';}';
		}
		if( of_get_option('bodyfontsize',true) != ''){
			echo "body{font-size:".of_get_option('bodyfontsize',true)."}";
		}
		if( of_get_option('logofontface',true) != '' || of_get_option('logofontcolor',true) != '' || of_get_option('logofontsize',true) != ''){
			echo ".header .header-inner .logo h1, .logo a{font-family:".of_get_option('logofontface').";color:".of_get_option('logofontcolor',true).";font-size:".of_get_option('logofontsize',true)."}";
		}
		if ( of_get_option('navfontface', true) != '' || of_get_option('navfontsize',true) != '' ) {
			echo '.header .header-inner .nav ul{font-family:\''. esc_html( of_get_option('navfontface', true) ) .'\', sans-serif;font-size:'.of_get_option('navfontsize',true).'}';
		}
		if ( of_get_option('navfontcolor', true) != '' ) {
			echo '.header .header-inner .nav ul li a, .header .header-inner .nav ul li ul li a{color:'. esc_html( of_get_option('navfontcolor', true) ) .';}';
		}
		
		if( of_get_option('navbgcolor',true) != '' || of_get_option('navhovercolor', true) != ''){
			echo ".header .header-inner .nav ul li a:hover{background-color:".of_get_option('navbgcolor',true)."; color:".of_get_option('navhovercolor',true).";}";
		}
		if( of_get_option('navbgcolor',true) != ''){
			echo "@media screen and (max-width:999px){.nav ul{background-color:".of_get_option('navbgcolor',true)."}}";
		}
		if( of_get_option('navbgcolor',true) != ''){
			echo ".header{border-top:7px solid ".of_get_option('navbgcolor',true)."}";
		}
		if( of_get_option('sldfontface',true) != '' || of_get_option('sldtitlecolor') != ''){
			echo "#slider .top-bar h2{font-family:".of_get_option('sldfontface',true).";color:".of_get_option('sldtitlecolor',true)."}";
		}
		if( of_get_option('sldtitlesize',true) != ''){
			echo "#slider .top-bar h2{font-size:".of_get_option('sldtitlesize',true)."}";
		}
		if( of_get_option('slddscfontface',true) != '' || of_get_option('slddsccolor',true) != ''){
			echo "#slider .top-bar p{font-family:".of_get_option('slddscfontface',true).";color:".of_get_option('slddsccolor',true)."}";
		}
		if( of_get_option('slddescsize',true) != '' ){
			echo "#slider .top-bar p{font-size:".of_get_option('slddescsize',true)."}";
		}
		if( of_get_option('sectitlesize',true) != '' ){
			echo "body.home section h2{font-size:".of_get_option('sectitlesize',true)."}";
		}
		if ( of_get_option('headfontface', true) != '' || of_get_option('sectitlecolor',true) != '' ) {
			echo 'h1, h2, h3, h4, h5, h6, section h1, #services-box h2, .contact-banner h3, .news h2, .testimonial-box h4, .team-col h3, .newsletter h2{font-family:\''. esc_html( of_get_option('headfontface', true) ) .'\', sans-serif;color:'.of_get_option('sectitlecolor',true).'}';
		}
		if ( of_get_option('linkcolor', true) != '' ) {
			echo 'a{color:'. esc_html( of_get_option('linkcolor', true) ) .';}';
		}
		if ( of_get_option('linkhovercolor', true) != '' ) {
			echo 'a:hover, .recent-post li a:hover{color:'. esc_html( of_get_option('linkhovercolor', true) ) .';}';
		}
		if( of_get_option('logobdcolor',true) != ''){
			echo ".client_banner .client img{border:7px solid ".of_get_option('logobdcolor',true)."}";
		}
		if( of_get_option('foottitlefontface', true) != ''){
			echo ".footer .footer-col-1 h2, .footer-col-3 h2{font-family:".of_get_option('foottitlefontface', true)."}";
		}
		if( of_get_option('foottitlecolor', true) != ''){
			echo ".footer .footer-col-1 h2, .footer-col-3 h2{color:".of_get_option('foottitlecolor', true)."}";
		}
		if( of_get_option('copyfontface',true) != '' || of_get_option('copycolor', true) != ''){
			echo ".copyright-txt{font-family:".of_get_option('copyfontface',true).";color:".of_get_option('copycolor',true)."}";
		}
		if( of_get_option('designfontface',true) != '' || of_get_option('designcolor', true) != ''){
			echo ".design-by{font-family:".of_get_option('designfontface',true).";color:".of_get_option('designcolor',true)."}";
		}
		if ( of_get_option('headerbgcolor', true) != '' ) {
			echo '.header{background-color:'. esc_html( of_get_option('headerbgcolor', true) ) .'; background-image:none;}';
		}
		if ( of_get_option('serbgcolor', true) != '' ) {
			echo '#services-box{background-color:'. esc_html( of_get_option('serbgcolor', true) ) .';}';
		}
		if ( of_get_option('serhvbgcolor', true) != '' ) {
			echo '#services-box:hover{background-color:'. esc_html( of_get_option('serhvbgcolor', true) ) .';}';
		}
		if ( of_get_option('cntbgcolor', true) != '' ) {
			echo '#slider .top-bar a, .contact-banner a, input.search-submit, .post-password-form input[type=submit], .wpcf7 form input[type="submit"], .main-form-area input[type="submit"], #commentform input#submit{background-color:'. esc_html( of_get_option('cntbgcolor', true) ) .';}';
		}
		if ( of_get_option('cnthvbgcolor', true) != '' ) {
			echo '#slider .top-bar a:hover, .contact-banner a:hover, input.search-submit:hover, .post-password-form input[type=submit]:hover{background-color:'. esc_html( of_get_option('cnthvbgcolor', true) ) .';}';
		}
		if ( of_get_option('cntfontcolor', true) != '' ) {
			echo '#slider .top-bar a, .contact-banner a{color:'. esc_html( of_get_option('cntfontcolor', true) ) .';}';
		}
		if( of_get_option('socialcolor',true) != '' || of_get_option('socialiconcolor',true) != ''){
			echo ".social-icons a{background-color:".of_get_option('socialcolor',true)."; color:".of_get_option('socialiconcolor',true)."}";
		}
		if( of_get_option('socialhvcolor',true) != ''){
			echo ".social-icons a:hover{background-color:".of_get_option('socialhvcolor',true)."}";
		}
		if ( of_get_option('wdgttitleccolor', true) != '' ) {
			echo 'h3.widget-title{color:'. esc_html( of_get_option('wdgttitleccolor', true) ) .';}';
		}
		if ( of_get_option('footerbgcolor', true) != '' ) {
			echo '#footer-wrapper{background-color:'. esc_html( of_get_option('footerbgcolor', true) ) .';}';
		}
		if ( of_get_option('copybgcolor', true) != '' ) {
			echo '.copyright-wrapper{background-color:'. esc_html( of_get_option('copybgcolor', true) ) .';}';
		}
		if( of_get_option('galhvcolor',true) != ''){
			echo ".photobooth .gallery ul li:hover{ background:".of_get_option('galhvcolor',true)."; float:left; background:url(".get_template_directory_uri()."/images/camera-icon.png) 50% 50% no-repeat ".of_get_option('galhvcolor',true)."; }";
		}
		if( of_get_option('sldnavbg',true) != ''){
			echo ".nivo-directionNav a{background:url(".get_template_directory_uri()."/images/slide-nav.png) no-repeat scroll 0 0 ".of_get_option('sldnavbg',true).";}";
		}
		if( of_get_option('sldpagebg',true) != ''){
			echo ".nivo-controlNav a{background-color:".of_get_option('sldpagebg',true)."}";
		}
		if( of_get_option('sldpagehvbg',true) != ''){
			echo ".nivo-controlNav a.active{background-color:".of_get_option('sldpagehvbg',true)."}";
		}
		if( of_get_option('filterbgcolor',true) != ''){
			echo ".photobooth .filter-gallery ul{background-color:".of_get_option('filterbgcolor',true)."}";
		}
		if( of_get_option('statbgcolor',true) != '' || of_get_option('statebordercolor',true) != ''){
			echo "#some-facts li{background-color:".of_get_option('statbgcolor',true)."; border-color:".of_get_option('statebordercolor',true)."}";
		}
		if( of_get_option('statfontcolor',true) != ''){
			echo "#some-facts li h5{color:".of_get_option('statfontcolor',true)."}";
		}
		if( of_get_option('footertextcolor',true) != '') { 
			echo ".phone-no strong{color:".of_get_option('footertextcolor',true)."}";
		}
		if( of_get_option('bordercolor',true) != '') { 
			echo "#services-box, .news-box, .testimonial-box, .team-col{border-color:".of_get_option('bordercolor',true)."}";
		}
		
		if( of_get_option('darkbordercolor',true) != '') { 
			echo "body.home section h3, section, .accordion-box, h3.widget-title{border-color:".of_get_option('darkbordercolor',true)."}";
		}
		
		if( of_get_option('srvreadmorebg',true) != '' ||  of_get_option('srvreadmoreborder',true) != ''){
			echo "#services-box .read-more{background-color:".of_get_option('srvreadmorebg',true)."; border-color:".of_get_option('srvreadmoreborder',true).";}";
		}
		if( of_get_option('srvreadmorebghv',true) != '' ){
			echo "#services-box .read-more:hover{background-color:".of_get_option('srvreadmorebghv',true)."; }";
		}
		if( of_get_option('rpimgborder',true) != '' ){
			echo ".recent-post li img{border-color:".of_get_option('rpimgborder',true)."; }";
		}
		
		if( of_get_option('shortcodeanchor',true) != '' ){
			echo ".tabs-wrapper ul.tabs li a, .slide_toggle a, .accordion-box h2, .photobooth .filter-gallery ul li a{color:".of_get_option('shortcodeanchor',true)."; }";
		}
		
		if( of_get_option('shortcodeactive',true) != '' ){
			echo ".accordion-box h2.active, h3.clicked a, .tabs-wrapper ul.tabs li a.selected, .photobooth .filter-gallery ul li.current a{color:".of_get_option('shortcodeactive',true)."; }";
		}			
		
		echo "</style>";
	}
}
add_action('wp_head', 'skt_white_custom_head_codes');


function skt_white_pagination() {
	global $wp_query;
	$big = 12345678;
	$page_format = paginate_links( array(
	    'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
	    'format' => '?paged=%#%',
	    'current' => max( 1, get_query_var('paged') ),
	    'total' => $wp_query->max_num_pages,
	    'type'  => 'array'
	) );
	if( is_array($page_format) ) {
		$paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
		echo '<div class="pagination"><div><ul>';
		echo '<li><span>'. $paged . ' of ' . $wp_query->max_num_pages .'</span></li>';
		foreach ( $page_format as $page ) {
			echo "<li>$page</li>";
		}
		echo '</ul></div></div>';
	}
}
/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';


/**
 * Load custom functions file.
 */
require get_template_directory() . '/inc/custom-functions.php';


function skt_white_custom_blogpost_pagination( $wp_query ){
	$big = 999999999; // need an unlikely integer
	if ( get_query_var('paged') ) { $pageVar = 'paged'; }
	elseif ( get_query_var('page') ) { $pageVar = 'page'; }
	else { $pageVar = 'paged'; }
	$pagin = paginate_links( array(
		'base' 			=> str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format' 		=> '?'.$pageVar.'=%#%',
		'current' 		=> max( 1, get_query_var($pageVar) ),
		'total' 		=> $wp_query->max_num_pages,
		'prev_text'		=> '&laquo; Prev',
		'next_text' 	=> 'Next &raquo;',
		'type'  => 'array'
	) ); 
	if( is_array($pagin) ) {
		$paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
		echo '<div class="pagination"><div><ul>';
		echo '<li><span>'. $paged . ' of ' . $wp_query->max_num_pages .'</span></li>';
		foreach ( $pagin as $page ) {
			echo "<li>$page</li>";
		}
		echo '</ul></div></div>';
	} 
}

// get slug by id
function skt_white_get_slug_by_id($id) {
	$post_data = get_post($id, ARRAY_A);
	$slug = $post_data['post_name'];
	return $slug; 
}


// custom post type for testimonial
function my_custom_post_testimonial() {
	$labels = array(
		'name'               => __( 'Testimonial','skt-white'),
		'singular_name'      => __( 'Testimonial','skt-white'),
		'add_new'            => __( 'Add Testimonial','skt-white'),
		'add_new_item'       => __( 'Add New Testimonial','skt-white'),
		'edit_item'          => __( 'Edit Testimonial','skt-white'),
		'new_item'           => __( 'New Testimonial','skt-white'),
		'all_items'          => __( 'All Testimonials','skt-white'),
		'view_item'          => __( 'View Testimonial','skt-white'),
		'search_items'       => __( 'Search Testimonial','skt-white'),
		'not_found'          => __( 'No Testimonial found','skt-white'),
		'not_found_in_trash' => __( 'No Testimonial found in the Trash','skt-white'), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Testimonial'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Manage Testimonials',
		'public'        => true,
		'menu_icon'		=> 'dashicons-format-quote',
		'menu_position' => null,
		'supports'      => array( 'title', 'editor', 'thumbnail'),
		'has_archive'   => true,
	);
	register_post_type( 'testimonial', $args );	
}
add_action( 'init', 'my_custom_post_testimonial' );


// add shortcode for features
function skt_white_services($skt_var, $content = null){
		extract( shortcode_atts(array(
			'title' => 'title',
			'icon'  => get_template_directory_uri().'/images/icon-customizable.png',
			'bold'	=> '',
			'link'	=> '',
			'button_text' => 'Read More',
		), $skt_var));
		
		return '<div id="services-box">
				<img src="'.$icon.'" />
				<h2>'.$title.' <span>'.$bold.'</span></h2>
				<p>'.$content.'</p>
				'.(($link != '') ? '<a class="read-more" href="'.$link.'">'.$button_text.'</a>' : '').'
				</div>';
}
add_shortcode('services','skt_white_services');

// add shortcode for skills
function skt_white_skills($skt_skill_var){
	extract( shortcode_atts(array(
		'title' 	=> 'title',
		'percent'	=> 'percent',
		'bgcolor'	=> 'bgcolor',
	), $skt_skill_var));
	
	return '<div class="skillbar clearfix " data-percent="'.$percent.'%">
			<div class="skillbar-title"><span>'.$title.'</span></div>
			<div class="skill-bg"><div class="skillbar-bar" style="background:'.$bgcolor.'"></div></div>
			<div class="skill-bar-percent">'.$percent.'%</div>
			</div>';
}

add_shortcode('skill','skt_white_skills');

// add shortcode for statistics main area
function skt_white_stat_main($atts, $stat_main_content = null){

	return '<ul id="some-facts">'.do_shortcode($stat_main_content).'</ul>';
}
add_shortcode('stat_main','skt_white_stat_main');

// add shortcode for statistics
function skt_white_stat($skt_stat_var, $stat_content = null){
	extract( shortcode_atts(array(
		'value'		=> '',
	), $skt_stat_var));
	
	return '<li><h2>'.$value.'</h2><h5>'.$stat_content.'</h5></li>';
}
add_shortcode('stat','skt_white_stat');

remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' ); 