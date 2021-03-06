<?php
if (get_option('show_on_front') == 'page') { // Display static front page if is set.
    include( get_page_template() );
} elseif (class_exists('WooCommerce') && get_theme_mod('universal_store_demo_front_page', 1) == 1) { // Display demo homepage only if WooCommerce plugin is activated and demo enabled via customizer.
    get_header();

    get_template_part('template-part', 'head');
    ?>

    <!-- start content container --> 
    <div class="row rsrc-fullwidth-home"> 	
        <div class="rsrc-home">                                   
            <div <?php post_class('rsrc-post-content'); ?>>                                                      
                <div class="entry-content">
                    <?php
                    if (get_theme_mod('universal_store_front_page_demo_carousel', 1) == 1) {
                        get_template_part('template-parts/demo-home', 'cats');
                    }
                    $loop = new WP_Query(array(
                        'post_type' => 'product',
                    ));
                    if ($loop->have_posts()) :
                        if (get_theme_mod('universal_store_front_page_demo_style', 'style-one') == 'style-one') {
                            get_template_part('template-parts/demo-layout', 'one');
                        } else {
                            get_template_part('template-parts/demo-layout', 'two');
                        }
                    else :
                        ?>
                        <p class="text-center">	
                            <?php esc_html_e('No products found', 'universal-store'); ?>
                        </p>
                    <?php endif; ?>
                </div>                                                       
            </div>        
        </div>
    </div>
    <!-- end content container -->
    <?php get_footer(); ?>

    <?php
} else { // Display blog posts.
    include( get_home_template() );
}
