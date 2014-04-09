<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one
 * of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query,
 * e.g., it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>

	<div id="main-content" class="main-content">

		<?php
		if ( is_front_page() && twentyfourteen_has_featured_posts() ) {
			// Include the featured content template.
			get_template_part( 'featured-content' );
		}
		?>

		<div id="primary" class="content-area">
			<div id="content" class="site-content" role="main">

				<div id="container-navigation">

					<?php
					$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
					global $wp_query;
					$wp_query = new WP_Query();
					$wp_query->query( 'post_type=post&paged=' . $paged );
					?>
					<div id="articles">
						<?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>

							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							<?php the_content(); ?>

						<?php endwhile; ?>
						<?php wp_reset_query(); ?>
					</div>

					<div id="navigation">
						<?php ns_navigation(); ?>
					</div>

				</div>

			</div>
			<!-- #content -->
		</div>
		<!-- #primary -->
		<?php get_sidebar( 'content' ); ?>
	</div><!-- #main-content -->

<?php
get_sidebar();
get_footer();