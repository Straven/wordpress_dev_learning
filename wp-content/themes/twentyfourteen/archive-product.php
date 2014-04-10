<?php
/*
Template Name: Goods Page
 */
get_header(); ?>
    <section id="primary" class="content-area">
        <div id="content" class="site-content" role="main">
            <div id="my_content">
                
                <!-- форма фильтрации продуктов -->
                <?php search_products(); ?>
                
                    <?php if ( $wp_query->have_posts() ) : ?>
            
                    <?php
                        // Start the Loop.
                        while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
                            <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                            <h4><?php the_content(); ?></h4>
                            <?php _e('Price: '); echo get_post_meta(get_the_ID(), '_my_meta_value_key', true).'<br />'; ?>
                            <?php

                            /*$categories_post = get_the_terms(get_the_ID(), 'category');
                            foreach ($categories_post as $value) {
                                echo _e('Category: ') . $value->name . '<br />';
                            }*/
                        endwhile;

                    /*else :
                        // If no content, include the "No posts found" template.
                        get_template_part( 'content', 'none' );*/

                    endif;
                    wp_reset_query();
                    ?>
            </div>
        </div><!-- #content -->
    </section><!-- #primary -->

<?php
get_sidebar( 'content' );
get_sidebar();
get_footer();
