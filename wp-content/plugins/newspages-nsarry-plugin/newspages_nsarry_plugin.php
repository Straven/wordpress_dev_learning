<?php
/*
Plugin Name: NewsPages Plugin
Description: Plugin added new content type with widget and shortcode for this content type
Author: Nickolaj Sarry
Author URI: http://nickolaj-sarry.info
 */

include 'newspages_widget.php';

//Register new type
add_action('init', 'create_newspages_type');

function create_newspages_type()
{
    register_post_type('newspages',
        array(
            'labels' => array(
                'name' => __('NewsPages'),
                'singular_name' => __('NewsPage')
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array('title', 'editor', 'thumbnail')
        )
    );
}

//Add Newspages categories
add_action('init', 'newspages_taxonomies', 0);

function newspages_taxonomies()
{
    register_taxonomy('newspages_category', 'newspages',
        array(
            'hierarchical' => true,
            'label' => 'Categories',
        )
    );
}

//Add meta boxes
add_action('add_meta_boxes', 'newspages_extra_box');
//save
add_action('save_post', 'newspages_save_post_data');

//meta boxes
function newspages_extra_box()
{
    add_meta_box(
        'newspages_info_box',
        __('NewsPage Information', 'newspages_info_box'),
        'newspages_info_box',
        'newspages',
        'side'
    );
}

//print box content
function newspages_info_box($post)
{
    $price = get_post_meta($post->ID, 'price', true);
    $newspage_status = get_post_meta($post->ID, 'newspage_status', true);
    $statuses = array('New', 'Old', 'Test');

    wp_nonce_field(plugin_basename(__FILE__), 'newspages_noncename');
    ?>

    <p>
        <label for="price">Price
            <input type="text" name="price" id="price" size="20" value="<?= $price ?>">
        </label>
    </p>
    <p>
        <label for="status">Status
            <select name="status" id="status">
                <?php foreach ($statuses as $value) : ?>
                    <option value="<?= $value ?>" <?= selected($value, $newspage_status); ?>><?= $value ?></option>
                <?php endforeach; ?>
            </select>
        </label>
    </p>
<?php
}

//save post data

function newspages_save_post_data($post_id)
{
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return;
    if (!wp_verify_nonce($_POST['newspages_noncename'], plugin_basename(__FILE__)))
        return;
    if (!current_user_can('edit_post', $post_id))
        return;
    if (isset($_POST['status'])) {
        update_post_meta($post_id, 'newspage_status', esc_attr($_POST['status']));
    }
    if (isset($_POST['price'])) {
        update_post_meta($post_id, 'price', esc_attr($_POST['price']));
    }
}

//Enable Thumbnail
/*if (function_exists('add_theme_support')) {
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(150, 150);
    add_image_size('newspages-thumb', 84, 107, true);
}*/

function newspages_display($atts)
{
    extract(shortcode_atts(array('category' => '', 'newspages_show' => 3), $atts));

    $args = array(
        'post_type' => 'newspages',
        'newspages_category' => $category,
        'orderby' => 'date',
        'order' => 'DESC',
        'showposts' => $newspages_show,
    );

    $posts = new WP_Query($args);

    $html = '<div>';

    if ($posts->have_posts()) : while ($posts->have_posts()) : $posts->the_post();

        $newspage_status = get_post_meta(get_the_ID(), 'newspage_status', true);
        $price = get_post_meta(get_the_ID(), 'price', true);

        $html .= '<p><b><a href="' . get_permalink() . '">' . get_the_title() . '</a></b></p>';

        $html .= '<p>';
        //$html .= '<p>' . get_the_content() . '</p>';
        if ($newspage_status) {
            $html .= 'Cтатус: ' . $newspage_status . '<br />';
        }
        if ($price) {
            $html .= 'Цена: ' . $price . '<br />';
        }

        $html .= '</p>';
        $html .= '<hr />';
    endwhile; endif;

    $html .= '</div>';

    return $html;
}

add_shortcode('newspages', 'newspages_display');