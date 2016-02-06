<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package SKT White
 */
?>

<div id="footer-wrapper">
    	<footer class="footer">
        	<div class="widget-column-1">
        	<?php if(!dynamic_sidebar('footer-1')) : ?>
        	<div class="footer-col-1">
            	<h2><?php if( of_get_option('footerabttitle',true) != '') { echo of_get_option('footerabttitle'); }; ?></h2>
                <p><?php if( of_get_option('footerabttext') != ''){ echo of_get_option('footerabttext');}; ?></p>
            </div>
          	<?php  endif; ?>
            </div>
            
            <div class="widget-column-1">
            <?php if(!dynamic_sidebar('footer-2')) : ?>
            <div class="footer-col-1">
            	<h2><?php if( of_get_option('recenttitle') != ''){ echo of_get_option('recenttitle');}; ?></h2>
                <ul class="recent-post">
					<ul>
					<li><a href="<?php bloginfo('url'); ?>/customer-support/" title="About Us">Customer Support</a></li>
					<li><a href="<?php bloginfo('url'); ?>/technical-support/" title="Our offices">Technical Support</a></li>
					<li><a href="<?php bloginfo('url'); ?>/e-commerce-support/" title="Job Openings">E-Commerce Support</a></li>
					<li><a href="<?php bloginfo('url'); ?>/search-sell/" title="Contact US">Search &amp; Sell</a></li>
					</ul>
                </ul>
            </div>
            <?php endif; ?>
            </div>
            
            <div class="widget-column-3">
            <?php if(!dynamic_sidebar('footer-3')) : ?>
            <div class="footer-col-3">
            	<h2><?php if( of_get_option('addresstitle') != '') { echo of_get_option('addresstitle'); } ; ?></h2>
                <p><?php if( of_get_option('address',true) != '') { echo of_get_option('address',true) ; } ; ?></p>
                <div class="phone-no">
                	<?php if( of_get_option('phone',true) != ''){ ?>
                		<p><span><?php _e('Phone:','skt-white'); ?></span><?php echo of_get_option('phone'); ?></p>
                    <?php } ?>
                    <?php if( of_get_option('email',true) != '' ) { ?>
                    <p><span><?php _e('E-mail:','skt-white'); ?></span><a href="mailto:<?php echo of_get_option('email',true); ?>"><?php echo of_get_option('email',true) ; ?></a></p>
                    <?php } ?>
                    <?php if( of_get_option('weblink',true) != ''){ ?>
                    	<p><span><?php _e('Website:','skt-white'); ?></span><a href="<?php echo of_get_option('weblink',true); ?>" target="_blank"><?php echo of_get_option('weblink',true); ?></a></p>
                    <?php } ?>
                </div>
				<div class="social-icons">
					<a class="fa fa-facebook fa-2x" title="facebook" target="_blank" href="https://www.facebook.com/jepheroes"></a>
					<a class="fa fa-twitter fa-2x" title="twitter" target="_blank" href="https://twitter.com/jep_heroes"></a>
					<a class="fa fa-linkedin fa-2x" title="linkedin" target="_blank" href="https://www.linkedin.com/company/jep-heroes"></a> 
				</div>
            </div>
            <?php endif; ?>
            </div>
            <div class="clear"></div>
        </footer>
        
        <div class="copyright-wrapper">
        	<div class="copyright">
            	<div class="copyright-txt"><?php if( of_get_option('copytext',true) != ''){ echo of_get_option('copytext',true); }; ?></div>
                <div class="design-by"><?php if( of_get_option('ftlink', true) != ''){echo of_get_option('ftlink',true);}; ?></div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
  
<?php wp_footer(); ?>

</body>
</html>