<?php
/*
Template Name: Tabs Template
 */
get_header(); ?>
    <section id="primary" class="content-area">
        <div id="content" class="site-content" role="main">

            <div id="tabs">

                <ul>
                    <li><a href="#tabs-1">First Tab</a></li>
                    <li><a href="#tabs-2">Second Tab</a></li>
                    <li><a href="#tabs-3">Third Tab</a></li>
                </ul>
                <div id="tabs-1">
                    <?php
                    $args = array(
                        'post_type' => 'any',
                        'posts_per_page' => 1,
                    );
                    $wp_query = new WP_Query($args);
                    while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
                        <h2><?php the_title(); ?></h2>
                        <p><?php the_content(); ?></p>
                    <?php endwhile; ?>
                </div>
                <div id="tabs-2">
                    <?php
                    $args = array(
                        'post_type' => 'post',
                        'posts_per_page' => 1,
                    );
                    $wp_query = new WP_Query($args);
                    while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
                        <h2><?php the_title(); ?></h2>
                        <p><?php the_content(); ?></p>
                    <?php endwhile; ?>
                </div>
                <div id="tabs-3">
                    <?php
                    $args = array(
                        'post_type' => 'page',
                        'posts_per_page' => 1,
                    );
                    $wp_query = new WP_Query($args);
                    while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
                        <h2><?php the_title(); ?></h2>
                        <p><?php the_content(); ?></p>
                    <?php endwhile; ?>
                </div>
            </div>

        </div>
    </section>

<?php
get_sidebar('content');
get_sidebar();
get_footer();