<?php
/*
 Plugin Name: Gooods
*/
// add custom post type products
function create_items_post_type() {
	register_post_type(
		'product',
		array(
			'labels'      => array(
				'name'          => __( 'Products' ),
				'singular_name' => __( 'Product' )
			),
			'public'      => true,
			'has_archive' => true,
			'rewrite'     => array( 'slug' => 'products' ),
		) );
}

add_action( 'init', 'create_items_post_type' );

// add taxonomy for products
function products_taxonomy() {
	register_taxonomy(
		'product_category',
		'product',
		array(
			'hierarchical' => true,
			'label'        => 'Product category',
			'query_var'    => true,
			'rewrite'      => array( 'slug' => 'product-categories' )
		) );
}

add_action( 'init', 'products_taxonomy' );

// add price for product
function price_product_meta_box() {
	add_meta_box( 'price_product', __( 'Price Product' ), 'show_product_meta_box', 'product' );
}

add_action( 'add_meta_boxes', 'price_product_meta_box' );

function show_product_meta_box( $post ) {
	wp_nonce_field( 'show_product_meta_box', 'show_product_meta_box_nonce' );

	$value = get_post_meta( $post->ID, '_my_meta_value_key', true );

	echo '<label for="price_field">';
	_e( 'Price: ' );
	echo '</label> ';
	echo '<input type="text" id="price_field" name="price_field" value="' . esc_attr( $value ) . '" size="25"/>';
}

function save_price( $post_id ) {
// check
	if ( ! isset( $_POST['show_product_meta_box_nonce'] ) ) {
		return $post_id;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return $post_id;
	}

	if ( 'page' == $_POST['post_type'] ) {
		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return $post_id;
		}
	} else {
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}
	}

// save
	$mydata = sanitize_text_field( $_POST['price_field'] );
	update_post_meta( $post_id, '_my_meta_value_key', $mydata );
}

add_action( 'save_post', 'save_price' );

/*
* filtering
*/

function search_products() {
	$min_cost           = 0;
	$max_cost           = 9999;
	$request_categories = array();
	$sorted             = 'ASC';

	global $wpdb;
	$sql_meta_key = '_my_meta_value_key';
	$minPrice = min($wpdb->get_results($wpdb->prepare(
		"SELECT meta_value FROM $wpdb->postmeta WHERE meta_key=%s",$sql_meta_key), ARRAY_A));
	$maxPrice = max($wpdb->get_results($wpdb->prepare(
		"SELECT meta_value FROM $wpdb->postmeta WHERE meta_key=%s",$sql_meta_key), ARRAY_A));

	if ( isset( $_GET['min_cost'] ) ) {
		$min_cost = (float) $_GET['min_cost'];
	}

	if ( isset( $_GET['max_cost'] ) ) {
		$max_cost = (float) $_GET['max_cost'];
	}

	if ( isset( $_GET['sorted'] ) ) {
		if ( $_GET['sorted'] == 'desc' ) {
			$sorted = 'DESC';
		}
	}

	$categories_tax = get_terms( 'product_category' );

	if ( isset( $_GET['categories'] ) ) {
		$request_categories = $_GET['categories'];
	} else {
		$i = 0;
		foreach ( $categories_tax as $value ) {
			$request_categories[ $i ++ ] = $value->slug;
		}
	}?>
	<div id="my_form">
		<form action="/products/" method="get">
			<p>
				<label for="min_cost">Min cost:</label>
				<input type="number" name="min_cost" value="<?php echo $minPrice['meta_value']; ?>"/>
			</p>
			<p>
			<label for="max_cost">Max cost: </label>
				<input type="number" name="max_cost" value="<?php echo $maxPrice['meta_value']; ?>"/><br/>
			</p>
			<p>
				<select multiple name="categories[]">
					<option disabled>Categories</option>
					<?php
					foreach ( $categories_tax as $value ) {
						echo '<option value="' . $value->slug . '">' . $value->name . '</option>';
					}
					?>
				</select>
			</p>
			<input type="radio" name="sorted" value="desc"/> DESC<br/>
			<input type="radio" name="sorted" value="asc"/> ASC <br/>
			<p><input type="submit" value="Search"/></p>
		</form>
	</div>

	<?php
	$meta_query = array(
		array(
			'key'     => '_my_meta_value_key',
			'value'   => array( $min_cost, $max_cost ),
			'type'    => 'numeric',
			'compare' => 'BETWEEN'
		)
	);

	$tax_query  = array(
		'taxonomy' => 'product_category',
		'field'    => 'slug',
		'terms'    => $request_categories,
		'operator' => 'IN',
		'relation' => 'OR'
	);
	$paged      = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
	$args_query = array(
		'post_type'      => 'product',
		'meta_key'       => '_my_meta_value_key',
		'orderby'        => 'meta_value_num',
		'order'          => $sorted,
		//'posts_per_page' => '-1',
		'paged'          => $paged,
		'meta_query'     => $meta_query,
		'tax_query'      => array( $tax_query )
	);
	global $wp_query;
	$wp_query = new WP_Query( $args_query );
}