<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package medium_magazin_beta
 */

;?>
<!DOCTYPE html>
<html <?php language_attributes();?>>
<head>
<meta charset="<?php bloginfo('charset');?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo('pingback_url');?>">

<?php wp_head();?>
</head>

<body <?php body_class();?> >

<?php get_template_part( 'inc/google', 'analytics' ); ?>
<div id="page" class="container-fluid">
<div class="ribbon hidden-md-down"><a href="http://www.mediummagazin.de/beta/">Das ist eine beta-Version</a></div>
	<header role="banner">
	<div class="row">
        <div class="col-xs-12 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4 m-t m-b">
            <img class="img-responsive" src="<?php echo get_template_directory_uri() . '/images/mm-logo.png'; ?>">
        </div>
  </div>
  <div class="row">
    
    <?php 
        $menu_name = 'primary';
        if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
          $menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
          $menu_items = wp_get_nav_menu_items($menu->term_id);
          $menu_list = '<nav id="mainnav" class="navbar nav-inline col-lg-8 col-lg-offset-2 col-xs-12 text-xs-center" role="navigation"><div class=""><ul>';

          foreach ( (array) $menu_items as $key => $menu_item ) {
              $title = $menu_item->title;
              $url = $menu_item->url;
              $menu_list .= '<li><a class="nav-link" href="' . $url . '">' . $title . '</a></li>';
          }
          $menu_list .= '</ul></div></nav>';
        } else {
          $menu_list = '<ul><li>Menu "' . $menu_name . '" not defined.</li></ul>';
        }

        echo $menu_list;
    ?>
   
  </div>
  <div class="row m-b">
    <?php putRevSlider('hp-slider', 'homepage'); ?> 
  </div>

	</header>