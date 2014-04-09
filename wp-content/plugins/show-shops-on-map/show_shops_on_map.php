<?php
/*
Plugin Name: Show Shops On Map Plugin
Description: Plugin added new content type with widget and shortcode for this content type
Author: Nickolaj Sarry
Author URI: http://nickolaj-sarry.info
 */

/* --- Creating Shop PostType --- */
add_action( 'init', 'create_shop_post_type' );
function create_shop_post_type() {
	$labels = array(
		'name'               => __( 'Shops' ),
		'singular_name'      => __( 'Shop' ),
		'add_new'            => __( 'Add Shop' ),
		'add_new_item'       => __( 'Adding Shop' ),
		'edit_item'          => __( 'Editing Shop' ),
		'new_item'           => __( 'Shop' ),
		'view_item'          => __( 'View Shop' ),
		'search_items'       => __( 'Search Shop' ),
		'not_found'          => __( 'No Shops' ),
		'not_found_in_trash' => __( 'No Shops in trash' ),
		'parent_item_colon'  => ''
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'query_var'          => true,
		'menu_icon'          => null,
		'rewrite'            => true,
		'capability_type'    => 'post',
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'thumbnail' ),
		'has_archive'        => true,
	);

	register_post_type( 'shops', $args );
	flush_rewrite_rules( false );
}

/* --- Add field for Address --- */
add_action( 'add_meta_boxes', 'create_shop_address' );
function create_shop_address() {
	add_meta_box( 'shop_address', __( 'Shop Address' ), 'shop_address_content', 'shops', 'side', 'high' );
}

function shop_address_content( $post ) {
	$shop_address = get_post_meta( $post->ID, 'shop_address', true );
	wp_nonce_field( plugin_basename( __FILE__ ), 'shop_address_content_nonce' );
	echo '<label for="shop_address">Shop Address: </label>
		  <input id="shop_address" name="shop_address"
		         placeholder="Enter shop address" type="text" value="' . $shop_address . '" />';
}

/* --- Save 'shop_address_field' data --- */
add_action( 'save_post', 'save_shop_address' );
function save_shop_address( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! wp_verify_nonce( $_POST['shop_address_content_nonce'], plugin_basename( __FILE__ ) ) ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	if ( isset( $_POST['shop_address'] ) ) {
		update_post_meta( $post_id, 'shop_address', $_POST['shop_address'] );
	}
}

/* --- Connecting scripts --- */
add_action( 'wp_enqueue_scripts', 'connecting_scripts' );
function connecting_scripts() {
	wp_register_script( 'google-map-javascript-api-v3', 'http://maps.google.com/maps/api/js?&sensor=false', array( 'jquery' ), '1.10.2', false );
	wp_register_script( 'show-shops-on-map', plugins_url( '/show_shops_on_map.js', __FILE__ ), array( 'jquery' ), '1.10.2', false );

	wp_enqueue_script( 'google-map-javascript-api-v3' );
	wp_enqueue_script( 'show-shops-on-map' );
}

/* --- Creating Shortcode [showmap] to show all shops in post body --- */
add_shortcode( 'showmap', 'show_all_shops_on_map' );
function show_all_shops_on_map() {
	ob_start();
	?>
	<div id="map_canvas" style="width: 700px; height: 500px;"></div>
	<script>
		showShopOnMap_init(13);
	</script>
	<?php
	$args  = array(
		'post_type' => 'shops',
		'posts_per_page' => -1,
		);
	$shops = new WP_Query( $args );
	if ( $shops->have_posts() ) : while ( $shops->have_posts() ) : $shops->the_post();
		$address = get_post_meta( get_the_ID(), 'shop_address', true );
		?>
		<script>
			addMarkersOnMap('<?php echo $address; ?>')
		</script>
	<?php
	endwhile; endif;
	wp_reset_postdata();
	$out = ob_get_contents();
	ob_end_clean();

	return $out;
}

/* --- Adding map to the post --- */
add_filter( 'the_content', 'show_map_in_content' );
function show_map_in_content( $content ) {
	if ( is_singular( 'shops' ) ) {
		$shop_address = get_post_meta( get_the_ID(), 'shop_address', true );
		ob_start();
		?>
		<div>Address: <?php echo $shop_address; ?></div>
		<div id="map_canvas" style="width: 700px; height: 500px;"></div>
		<script>
			showShopOnMap_init(13);
		</script>
		<script>
			addMarkersOnMap('<?php echo $shop_address; ?>');
		</script>
		<?php
		$out = $content . ob_get_contents();
		ob_end_clean();
	} else {
		$out = $content;
	}

	return $out;
}
