<?php if (is_active_sidebar('maxstore-footer-area')) { ?>  				
    <div id="content-footer-section" class="row clearfix">    				
        <?php
        // Calling the header sidebar if it exists.
        dynamic_sidebar('maxstore-footer-area');
        ?>  				
    </div>		
<?php } ?>         
<footer id="colophon" class="rsrc-footer" role="contentinfo">                
    <div class="row rsrc-author-credits">                    
        <p class="text-center">
            <?php printf(__('Proudly powered by %s', 'universal-store'), '<a href="' . esc_url(__('https://wordpress.org/', 'universal-store')) . '">WordPress</a>'); ?>
            <span class="sep"> | </span>
            <?php printf(__('Theme: %1$s by %2$s', 'universal-store'), '<a href="https://themes4wp.com/theme/universal-store/" >Universal Store</a>', 'Themes4WP'); ?>
        </p>                
    </div>    
</footer>
<div id="back-top">  
    <a href="#top">
        <span></span>
    </a>
</div>
</div>
<!-- end main container -->
<?php wp_footer(); ?>
</body>
</html>