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
	<div class="row d-none d-lg-block">
      <div class="col-lg-8 offset-lg-2 col-12 mt-5 social-links">
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

  <div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
      <!-- mm logo for mobile -->
      <a class="d-lg-none navbar-brand mm_logo-mobile" href="<?php echo esc_url( home_url( '/' ) ); ?>">
        <img src="<?php print get_template_directory_uri() . '/images/mm_logo_nourl.svg'  ?>" width="110" height="30" alt="">
      </a>
      
      <!-- button expands menu on mobile -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- nav items -->
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <div class="container d-flex flex-row justify-content-center">
        <!-- menu template tag start -->
        <?php mm_menu('primary'); ?>
        <!-- menu template tag end -->
        </div>
      </div>
    </nav>
  </div>

	</header>