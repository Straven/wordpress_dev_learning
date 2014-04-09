<?php get_header(); ?>
	<div id="templatemo_background_section_middle">
		<div class="templatemo_container">
			<div id="templatemo_left_section">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<div class="templatemo_post">
						<div class="templatemo_post_top">
							<a href="<?php the_permalink(); ?>">
								<h1><?php the_title(); ?></h1>
							</a>
						</div>
						<div class="templatemo_post_mid">
							<?php the_content( '<p></p>' ); ?>
							<div class="clear"></div>
						</div>
						<div class="templatemo_post_bottom">
							<span class="post">Posted By: <?php the_author() ?></span>
							<span class="post">Category: <?php the_category( '<a></a>' ) ?></span>
							<span class="post">Date: <?php echo get_the_time(); ?>
								, <?php echo get_the_date( 'd M Y' ); ?></span>
							<span class="post"><?php edit_post_link( 'Edit' ); ?></span>
						</div>
						<div class="templatemo_post_bottom">
							<span class="post"><?php previous_post_link( '<strong><< %link</strong>' ); ?></span>
							<span class="post"><?php next_post_link( '<strong>%link >></strong>' ); ?></span>
						</div>
					</div><!-- end of templatemo_post-->
				<?php endwhile; endif; ?>
			</div>
			<!-- end of left section-->
			<div id="templatemo_right_section">
				<?php get_sidebar(); ?>
			</div>
			<!-- end of right Section -->
		</div>
		<!-- end of container-->
	</div><!-- end of background middle-->
<?php get_footer(); ?>