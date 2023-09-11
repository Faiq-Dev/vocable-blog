<?php
get_header();
?>

<main class='index'>
<?php custom_theme_breadcrumbs(); ?>

<div class='single'>

<div class='single-post'>

<div class='post_head'>
  
  <h1><?php the_title(); ?></h1>
  <?php the_excerpt(); ?>
  <?php
  $imagePath = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
    ?>
    <img class='f-img' src="<?php echo $imagePath[0] ?>" alt="">
</div>

<div class='single-post-c'>
  <?php the_content(); ?>
</div>

</div>


<div class='more-r'>
  <h3>MORE RESOURCES</h3>
<div class='m-posts'>
<?php
  $current_post_id = get_the_ID();
  $categories = get_the_category($current_post_id);
  if (!empty($categories)) {
    // Get the first category
    $category_id = $categories[0]->term_id;

    // Custom query to fetch 5 posts from the same category
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => 5,
        'category__in' => array($category_id),
        'post__not_in' => array($current_post_id), // Exclude the current post
    );

    $related_posts_query = new WP_Query($args);

    if($related_posts_query->have_posts()){
      while ($related_posts_query->have_posts()) {
        $related_posts_query->the_post();
  ?>

  <div class='m-post'>
  <a href='<?php the_permalink(); ?>'>
          <?php $imagePath = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large'); ?>
          <img src="<?php echo $imagePath[0] ?>" alt="">
          <h4><?php the_title() ?></h4>
        </a>
  </div>

  <?php
       }
      }
    }
  ?>
</div>
</div>


</div>
<div class='single-news-letter news-letter'>
  <div class='input'>
    <input type="email" placeholder="Enter Your Email...">
     <button>SUBSCRIBE</button>
  </div>
  <p>Stay ahead of the curve on your AI-content marketing updates</p>
</div>
</div>



</main>

<?php
get_footer();
?>