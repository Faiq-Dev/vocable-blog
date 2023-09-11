<?php /* Template Name: Home Template */ ?>


<?php
get_header();
?>


<!-- MAIN BODY OF HOME PAGE  -->

<main class='index'>


<div class='home-intro' >

<img src="<?php echo get_template_directory_uri(); ?>/images/background.png" alt="">
<h1>Navigating AI's Influence on Content Marketing</h1>
<!-- <button><a href="https://vocable.ai/">SUBSCRIBE</a></button> -->
<div class='news-letter'>
  <div class='input'>
    <input type="email" placeholder="Enter Your Email...">
     <button>SUBSCRIBE</button>
  </div>
  <p>Stay ahead of the curve on your AI-content marketing updates</p>
</div>

</div>

<div class='categories-grid'>
<?php
global $wpdb;

$category_count = 8; // Number of categories to retrieve
$categories = $wpdb->get_results(
    "
    SELECT t.*
    FROM $wpdb->terms AS t
    INNER JOIN $wpdb->term_taxonomy AS tt ON t.term_id = tt.term_id
    WHERE tt.taxonomy = 'category'
    ORDER BY tt.term_taxonomy_id DESC
    LIMIT $category_count
    "
);

if($categories){
    foreach($categories as $category){
?>
<a class='category-item hidden-ani' href="<?php echo esc_url(get_category_link($category->term_id)) ?>" >
<div >
<i class="fas fa-plus add-icon"></i>

<?php
if(z_taxonomy_image_url($category->term_id)){
?>
<img src="<?php echo z_taxonomy_image_url($category->term_id); ?>" />
<?php
}
?>


  <h2><?php echo esc_html( $category->name ) ?></h2>
</div></a>
<?php
    }
}
?>
</div>


<!-- HERO SECTION OF THE HOME PAGE  -->

<div class='h-main' >
<?php
$args = array(
    'posts_per_page' => 1, // Retrieve only one post
    'orderby' => 'date',  // Order by date
    'order' => 'DESC',    // Sort in descending order (latest first)
);
$latest_post_query = new WP_Query($args);

while($latest_post_query->have_posts()){
    $latest_post_query->the_post()
?>

<!-- HERO POST HOLDER SECTION OF HOME PAGE  -->

<div class='hero-post'>
<?php 
$imagePath = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
$postID = get_the_ID();
$post_category = get_the_category($postID);
 ?>
<a href="<?php the_permalink() ?>" class='img'><i class="fas fa-arrow-up custom-arrow"></i><img src='<?php echo $imagePath[0]; ?>' alt=""></a>
 <?php

 foreach($post_category as $category){
    echo '<a class="link" href="' . esc_url(get_category_link($category->term_id)) . '">';
    echo $category->name;
    echo '</a>';
 };
 ?>
 <h1><a class='link' href='<?php the_permalink(); ?>'><?php the_title() ?></a></h1>
 <?php the_excerpt() ?>


</div>

<?php
}
?>

<!-- RECENT POSTS HOLDER OF HOME PAGE  -->


<div class='recent-posts'>

<div class='recent'>
<h3>RECENT</h3>
<div class='r-posts'>
    <?php 
     $args = array(
         'posts_per_page' => 7, // Retrieve 7 posts
         'orderby' => 'date',   // Order by date
         'order' => 'DESC',     // Sort in descending order (latest first)
        );
        $recent_posts_query = new WP_Query($args);
        while($recent_posts_query->have_posts()){
            $recent_posts_query->the_post();
            ?>
      
      <div class='post'>
        <a href='<?php the_permalink(); ?>'>
          <?php $imagePath = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large'); ?>
          <img src="<?php echo $imagePath[0] ?>" alt="">
          <h4><?php the_title() ?></h4>
        </a>
        </div>
        
        <?php
    }
    ?>
    </div>
   </div>
</div>

</div>

<!-- CATEGORIES CONTAINER OF HOME PAGE  -->

<?php
$categories = get_categories();

foreach($categories as $category){

    ?>

    <!-- CATEGORY MAIN DIV  -->

    <div class='category-container'>

    <?php
    
    echo '<a href="' . esc_url(get_category_link($category->term_id)) . '">' . esc_html($category->name) .  '<span>SEE ALL</span> <i class="fas fa-arrow-right"></i>' . '</a>';

    $args = array(
        'category_name' => $category->name, // Replace with the slug of your desired category
        'posts_per_page' => 5, // Retrieve only 5 posts
    );
    $custom_query = new WP_Query($args);

    ?>

    <!-- POSTS CONTAINER  -->

    <div class='posts'>
<?php

    while($custom_query->have_posts()){
        $custom_query->the_post();
?>

    <!-- SINGLE POST DIV  -->

<div class='post'>
    <?php
    $imagePath = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
      ?>
   <a href='<?php the_permalink(); ?>'> <img src="<?php echo $imagePath[0] ?>" alt=""><i class="fas fa-arrow-up custom-arrow"></i></a>
    <div class='post-content' >
        <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>"><?php echo esc_html($category->name); ?></a>
        <h2><a href='<?php the_permalink(); ?>' ><?php the_title(); ?></a></h2>
    </div>
</div>

<?php
    };

    ?>
     </div>
    <?php

    ?>
    </div>

    <?php

}
?>




</main>

<?php
get_footer();
?>
