<?php get_header(); ?>

	<div id="templatemo_background_section_middle">
		<div class="templatemo_container">
			<div id="templatemo_left_section">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<div class="templatemo_post">
						<div class="templatemo_post_top">
							<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
						</div>
						<div class="templatemo_post_mid">
							<?php the_content(); ?>
							<div class="clear"></div>
						</div>
						<div class="templatemo_post_bottom">
							<span class="post"><?php _e( 'Posted By: ' ); ?><?php the_author(); ?></span>
							<span class="post"><?php _e( 'Category: ' ); ?><?php the_category( ' ' ); ?></span>
							<span class="post"><?php _e( 'Date: ' ); ?><?php the_date( 'G:i, j F Y' ); ?></span>
						</div>
					</div><!-- end of templatemo_post-->
				<?php endwhile; ?>
				<?php endif; ?>
				<p align="center"><?php posts_nav_link(); ?></p>
			</div>
			<div id="templatemo_right_section">
				<?php if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar( 1 ) ) : ?>
				<?php endif; ?>
			</div>
		</div>
	</div>

<?php get_footer(); ?>