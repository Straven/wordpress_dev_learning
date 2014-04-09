<?php
add_action( 'after_setup_theme', 'NsarryTheme_setup' );
function NsarryTheme_setup() {
	register_sidebar( array(
		'name'          => 'sidebar_1',
		'before_widget' => '<div class="templatemo_section_box_mid">',
		'after_widget'  => '<div class="clear">&nbsp;</div><div class="templatemo_section_box_bottom"></div></div>',
		'before_title'  => '<div class="templatemo_section_box_top"><h1>',
		'after_title'   => '</h1></div>',
	) );
	register_nav_menus( array(
		'header_menu'       => __( 'Header Menu' ),
		'footer_menu_left'  => __( 'LeftSidebar Menu' ),
		'footer_menu_midle' => __( 'MidSidebar Menu' ),
		'footer_menu_right' => __( 'RightSidebar Menu' )
	) );
}