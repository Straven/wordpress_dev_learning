<?php

class NewsPages_Widget extends WP_Widget
{

    public function __construct()
    {
        parent::__construct('NewsPages_Widget', 'Latest NewsPages', array(
            'description' => 'Show latest NewsPages.'));
    }

    public function widget($args, $instance)
    {
        $args = array(
            'post_type' => 'newspages',
            'order' => 'DESC',
            'showposts' => $instance['numnewspages']
        );

        echo $instance['title'];

        $query = new WP_Query($args);

        if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
            echo '<br /><a href="'.get_permalink().'">'.get_the_title().'</a>';
        endwhile; endif;
    }

    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['numnewspages'] = strip_tags($new_instance['numnewspages']);
        $instance['title'] = strip_tags($new_instance['title']);
        return $instance;
    }

    public function form($instance)
    {
        $numnewspages = isset($instance['numnewspages']) ? $instance['numnewspages'] : '3';
        $title = isset($instance['title']) ? $instance['title'] : 'Latest NewsPages';
        ?>
        <p>
            <label for="<?= $this->get_field_id('title'); ?>">Заголовок</label>
            <input class="widefat" id="<?= $this->get_field_id('title'); ?>"
                   name="<?= $this->get_field_name('title'); ?>" type="text"
                   value="<?= $instance['title']; ?>"/>
        </p>
        <p>
            <label
                for="<?= $this->get_field_id('numnewspages'); ?>"><?= 'Number of shown NewsPages:' ?></label>
            <input class="widefat" id="<?= $this->get_field_id('numnewspages'); ?>"
                   name="<?= $this->get_field_name('numnewspages'); ?>" type="text"
                   value="<?= esc_attr($numnewspages); ?>"/>
        </p>
    <?php
    }
}

add_action('widgets_init', create_function('', 'register_widget("NewsPages_Widget");'));