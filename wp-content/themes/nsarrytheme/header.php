<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?> "/>
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<meta name="keywords" content=""/>
	<meta name="description" content="<?php bloginfo( 'description' ); ?>"/>
	<link href="<?php bloginfo( 'stylesheet_url' ); ?>" rel="stylesheet" type="text/css"/>
	<?php wp_head(); ?>
</head>

<body>
<div id="templatemo_background_section_top">
	<div class="templatemo_container">
		<div id="templatemo_header">
			<div id="templatemo_logo_section">
				<a href="<?php echo home_url( '/' ); ?>"><h1><?php bloginfo( 'name' ); ?></h1></a>

				<h2><?php bloginfo( 'description' ); ?></h2>
			</div>
			<div id="templatemo_search_box">
				<?php get_search_form(); ?>
			</div>
		</div>
		<!-- end of headder -->
		<div id="templatemo_menu_panel">
			<div id="templatemo_menu_section">
				<ul>
					<?php
					wp_nav_menu( array(
						'theme_location' => 'header_menu',
						'container'      => false,
						'items_wrap'     => '%3$s'
					) );
					?>
				</ul>
			</div>
		</div>
		<!-- end of menu -->
	</div>
	<!-- end of container-->
</div>
<!-- end of templatemo_background_section_top-->