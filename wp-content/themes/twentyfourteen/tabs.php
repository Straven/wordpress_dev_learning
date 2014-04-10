<?php
/*
Template Name: Tabs Template
 */
get_header(); ?>
    <section id="primary" class="content-area">
        <div id="content" class="site-content" role="main">

            <div id="tabs">
                <ul>
                    <li><a href="#tabs-1">First Post</a></li>
                    <li><a href="#tabs-2">Second Post</a></li>
                    <li><a href="#tabs-3">Third Post</a></li>
                </ul>
                <div id="tabs-1">There will be first post</div>
                <div id="tabs-2">There will be second post</div>
                <div id="tabs-3">There will be third post</div>
            </div>

        </div>
    </section>

<?php
get_sidebar('content');
get_sidebar();
get_footer();