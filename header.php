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

?>
<!DOCTYPE html>
<html <?php language_attributes();?>>
<head>
<meta charset="<?php bloginfo('charset');?>">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo('pingback_url');?>">

<?php wp_head();?>
</head>

<body <?php body_class();?> >

<?php get_template_part( 'template-parts/tracking', 'ga' ); ?>
<?php get_template_part( 'template-parts/sdk', 'facebook' ); ?>
<div id="page" class="container-fluid">
	<header role="banner">
	<div class="row">
      <div class="col-lg-8 offset-lg-2 col-12 m-t-lg social-links">
        <a target="_blank" href="http://facebook.com/mediummagazin">
          <span class="dashicons dashicons-facebook-alt social-link"></span>
        </a>
        <a target="_blank" href="http://twitter.com/mediummagazin">
          <span class="dashicons dashicons-twitter social-link"></span>
        </a>
      </div>
      <div class="col-12 col-md-6 offset-md-3 col-lg-4 offset-lg-4 m-b">
          <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
            <?php get_template_part( 'template-parts/logo', '' ); ?>
          </a>
      </div>
  </div>

  <!-- Menu desktop -->
  <div class="row d-none d-md-block">
    <!-- template tag desktop menu start -->
    <?php mm_menu('primary', 'desktop');?> 
    <!-- template tag desktop menu end-->  
  </div>
  
  <!-- Menu mobile -->
  
  <div class="row d-block d-md-none">
    <div class="collapse" id="exCollapsingNavbar">
        <?php mm_menu('primary', 'mobile');?>
    </div>
    <nav class="navbar navbar-light bg-faded col-xs-12 text-xs-center">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar">
        &#9776;
      </button>
    </nav>
  </div>





	</header>