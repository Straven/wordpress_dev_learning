<?php
/*
Template Name: Tabs Template
 */
get_header(); ?>
    <section id="primary" class="content-area">
        <div id="content" class="site-content" role="main">

            <div id="tabs">

                <?php
                    $args_tab1 = array(
                        'post_type' => 'post',
                        'category_name' => 'bez-rubriki',
                        'posts_per_page' => 1
                    );
                    $args_tab2 = array(
                        'post_type' => 'post',
                        'category_name' => 'shops',
                        'posts_per_page' => 1
                    );
                    $args_tab3 = array(
                        'post_type' => 'post',
                        'category_name' => 'prosto-tak',
                        'posts_per_page' => 1
                    );
                    $wp_query_tab1 = new WP_Query($args_tab1);
                    $wp_query_tab2 = new WP_Query($args_tab2);
                    $wp_query_tab3 = new WP_Query($args_tab3);
                ?>

                <ul>
                    <li>
                        <?php
                        while ($wp_query_tab1->have_posts()) : $wp_query_tab1->the_post(); ?>
                            <a href="#tabs-1"><?php the_title(); ?></a>
                        <?php endwhile; ?>
                    </li>
                    <li>
                        <?php
                        while ($wp_query_tab2->have_posts()) : $wp_query_tab2->the_post(); ?>
                            <a href="#tabs-2"><?php the_title(); ?></a>
                        <?php endwhile; ?>
                    </li>
                    <li>
                        <?php
                        while ($wp_query_tab3->have_posts()) : $wp_query_tab3->the_post(); ?>
                            <a href="#tabs-3"><?php the_title(); ?></a>
                        <?php endwhile; ?>
                    </li>
                </ul>
                <div id="tabs-1">
                    <?php
                    while ($wp_query_tab1->have_posts()) : $wp_query_tab1->the_post(); ?>
                        <p><?php the_content(); ?></p>
                    <?php endwhile; ?>
                </div>
                <div id="tabs-2">
                    <?php
                    while ($wp_query_tab2->have_posts()) : $wp_query_tab2->the_post(); ?>
                        <p><?php the_content(); ?></p>
                    <?php endwhile; ?>
                </div>
                <div id="tabs-3">
                    <?php
                    while ($wp_query_tab3->have_posts()) : $wp_query_tab3->the_post(); ?>
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