<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .categories-grid a:nth-child(1)::before{
            background-image: url("<?php echo get_template_directory_uri(); ?>/images/category-icon.png");
        }
    </style>

    <title>Vocable Blog</title>
    <?php wp_head(); ?>
</head>
<body>

<header class='site-header'>

<div class='links'>
<a href='https://vocable.ai/'><img src="https://vocable.ai/Images/vocable__logo_svg.svg" alt="VOCABLE_LOGO"></a>
    <?php 
      wp_nav_menu(
        array(
            'theme_location' => 'custom-menu',
            'menu_class'     => 'custom-menu-class',
        ))
     ?>
</div>
     <div class='btns'>
     <a href='https://vocable.ai/' > <button class='login'>Login</button></a>
     <a href='https://vocable.ai/' > <button class='try-beta'>Try Beta For Free</button></a>
     </div>
</header>

<header class='site-header2'>

    <div class='nav'>
   <a href='https://vocable.ai/'> <img src="https://vocable.ai/Images/vocable__logo_svg.svg" alt=""></a>
    <button class='toggler' id="toggleMenu">
        <span></span>
        <span></span>
        <span></span>
        </button>
    </div>

   <div class='links' id='links'>
   <?php 
      wp_nav_menu(
        array(
            'theme_location' => 'custom-menu',
            'menu_class'     => 'custom-menu-class',
        ))
     ?>

     <div class='btns'>
     <a href='https://vocable.ai/' ><button class='login'>Login</button></a>
     <a href='https://vocable.ai/' > <button class='try-beta'>Try Beta For Free</button></a>
     </div>
   </div>
 
</header>