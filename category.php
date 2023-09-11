<?php
get_header();
?>
<?php
$category = get_category(get_query_var('cat'));
?>


<main class='categories-main index'>
<?php custom_theme_breadcrumbs(); ?>

    <div class='category_header'>
     <div class='category_header_img'>
     <img src="<?php echo get_template_directory_uri(); ?>/images/category-header.jpg" alt="">
     </div>

     <div class='category_header_content'>
     <h1><?php single_cat_title(); ?></h1>
<?php
        if (!empty($category->description)) {
         echo '<p class="category-description">' . category_description() . '</p>';
}
?>
     </div>
    </div>

    <div class='posts'>
       <?php
        $args = array(
            'cat' => $category->cat_ID, // ID of the current category
            'posts_per_page' => -1,    // Display all posts
        );
        
        $query = new WP_Query($args);

        while($query->have_posts()){
            $query->the_post();
       ?>
        <div class='post'>
    <?php
    $imagePath = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
      ?>
    <a href='<?php the_permalink(); ?>'><i class="fas fa-arrow-up custom-arrow"></i><img src="<?php echo $imagePath[0] ?>" alt=""></a>
    <div class='post-content' >
        <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>"><?php echo esc_html($category->name); ?></a>
        <h2><a href='<?php the_permalink() ?>'><?php the_title(); ?></a></h2>
        <div class='post-author'>
            <?php echo get_avatar(get_the_author_meta('user_email')) ?>
            <span><?php echo get_the_author() ?></span>
        </div>
    </div>
</div>
       <?php 
        }
       ?>
    </div>

</main>

<?php
get_footer();
?>

