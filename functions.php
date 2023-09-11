<?php

// LINKING STYLE.CSS
function enqueue_custom_styles() {
    wp_enqueue_style( 'custom-style', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'enqueue_custom_styles' );


// LINKING SCRIPT.JS 
function custom_enqueue_scripts() {
    // Enqueue your custom JavaScript file
    wp_enqueue_script('custom-script', get_template_directory_uri() . '/script.js', null, true);
}
add_action('wp_enqueue_scripts', 'custom_enqueue_scripts');

function enqueue_font_awesome() {
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css', array(), '5.15.4', 'all');
}
add_action('wp_enqueue_scripts', 'enqueue_font_awesome');


// CUSTOM MENUS
function custom_theme_register_menus() {
    register_nav_menu( 'custom-menu', __( 'Primary Menu', 'custom-theme' ) );
}
add_action( 'after_setup_theme', 'custom_theme_register_menus' );


// FEATURE IMAGES 
function theme_setup() {
    add_theme_support('post-thumbnails'); // Enable featured image support
}
add_action('after_setup_theme', 'theme_setup');


// // FEATURED POSTS 

function add_featured_meta_box() {
    add_meta_box(
        'featured_post', // Meta box ID
        'Featured Post', // Meta box title
        'display_featured_meta_box', // Callback function to display the meta box content
        'post', // Post type (change to 'page' if you want to add featured pages)
        'side', // Position on the edit screen (e.g., 'side', 'normal', 'advanced')
        'high' // Priority of the meta box (e.g., 'high', 'low')
    );
}
add_action('add_meta_boxes', 'add_featured_meta_box');

function display_featured_meta_box($post) {
    $featured = get_post_meta($post->ID, '_featured_post', true);
    ?>
    <label for="featured_post">
        <input type="checkbox" name="featured_post" id="featured_post" value="yes" <?php checked($featured, 'yes'); ?> />
        Mark this post as featured
    </label>
    <?php
}

function save_featured_meta_data($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    if (isset($_POST['featured_post'])) {
        update_post_meta($post_id, '_featured_post', $_POST['featured_post']);
    } else {
        delete_post_meta($post_id, '_featured_post');
    }
}
add_action('save_post', 'save_featured_meta_data');




// HIGHLIGHTED POST 

function add_highlighted_meta_box() {
    add_meta_box(
        'highlighted_post',    // Meta box ID
        'Highlighted Post',    // Meta box title
        'display_highlighted_meta_box', // Callback function to display the meta box content
        'post',                // Post type
        'side',                // Position on the edit screen
        'high'                 // Priority of the meta box
    );
}

add_action('add_meta_boxes', 'add_highlighted_meta_box');

function display_highlighted_meta_box($post) {
    $highlighted = get_post_meta($post->ID, '_highlighted_post', true);
    ?>
    <label for="highlighted_post">
        <input type="checkbox" name="highlighted_post" id="highlighted_post" value="yes" <?php checked($highlighted, 'yes'); ?> />
        Highlight this post
    </label>
    <?php
}

function save_highlighted_meta_data($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    if (isset($_POST['highlighted_post'])) {
        update_post_meta($post_id, '_highlighted_post', $_POST['highlighted_post']);
    } else {
        delete_post_meta($post_id, '_highlighted_post');
    }
}
add_action('save_post', 'save_highlighted_meta_data');




function custom_excerpt_length($length) {
    return 30; // Set the desired number of words for the excerpt length
}

add_post_type_support('my_custom_post_type', 'excerpt');
add_filter('excerpt_length', 'custom_excerpt_length');
//HIDING ADMIN BAR
show_admin_bar( false );


function custom_theme_breadcrumbs() {
    echo '<div class="breadcrumbs">';
    

    $category_URL = null;
    $category_name = null;
    $post_name = null;

    if (is_category()) {
        $category = get_queried_object();
        $category_name = '<span class="b-name">' . esc_html($category->name) . '</span>';
    } elseif (is_single()) {
        $categories = get_the_category();
        $category_URL = '<a class="b-url" href="' . esc_url(get_category_link($categories[0]->term_id)) . '">' . esc_html($categories[0]->name) . '</a>';
    }

    if(is_category()){
        echo '<a class="b-url" href="' . home_url() . '">blog</a>';
        echo '<span class="separator"> / </span>';
        echo $category_name;
        echo '<span class="separator"> / </span>';
    }

    if(is_single()){
        echo '<a class="b-url" href="' . home_url() . '">blog</a>';
        echo '<span class="separator"> / </span>';
        echo $category_URL;
        echo '<span class="separator"> / </span>';
        echo '<span class="b-name">' . get_the_title() . '</span>';
    }

    
    
    echo '</div>';
}