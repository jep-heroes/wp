<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package SKT White
 */
?>
<?php if( function_exists('is_woocommerce') && is_woocommerce() ) { ?>
		</div>
<?php } ?>
<div id="sidebar" <?php if( is_page_template('blog-post-left-sidebar.php')){?> style="float:left;"<?php } ?>>
    
    <?php if ( ! dynamic_sidebar( 'sidebar-main' ) ) : ?>
        <aside id="contactform" class="widget">
            <h3 class="widget-title"><?php _e( 'Contact Form', 'skt-white' ); ?></h3>
             <?php echo do_shortcode('[contactform to_email="sales@jep-heroes.com" title="Contact Form"] '); ?>
        </aside>
    <?php endif; // end sidebar widget area ?>
	
</div><!-- sidebar -->

<?php if( function_exists('is_woocommerce') && is_woocommerce() ) { ?>
		</div>
	</div>
    <div class="clear"></div>
<?php } ?>
