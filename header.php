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
<div id="page" class="container">
<div class="ribbon"><a href="#">Das ist eine beta-Version</a></div>
	<header role="banner">
	<div class="row">
        <div class="col-xs-12 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4 m-t m-b">
            <img class="img-responsive" src="<?php echo get_template_directory_uri() . '/images/mm-logo.png'; ?>">
        </div>
        <div class="col-xs-12">
            


        </div>
	</div>


  <?php 
      $menu_name = 'primary';
      $branding = '<a class="navbar-brand" href="' . esc_url(home_url('/')) . '" rel="home">' . get_bloginfo('name') . '</a>';
          if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
                $menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
                $menu_items = wp_get_nav_menu_items($menu->term_id);
                $menu_list = '<nav class="navbar navbar-dark bg-inverse"><div class="nav navbar-nav">' . $branding;

                foreach ( (array) $menu_items as $key => $menu_item ) {
                    $title = $menu_item->title;
                    $url = $menu_item->url;
                    $menu_list .= '<a class="nav-item nav-link" href="' . $url . '">' . $title . '</a>';
                }
                $menu_list .= '</div></nav>';
          } else {
                $menu_list = '<ul><li>Menu "' . $menu_name . '" not defined.</li></ul>';
          }

          echo $menu_list;
  ?>

	</header>