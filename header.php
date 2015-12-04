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

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> >
<div id="page" class="container">

	<header role="banner">
	<div class="row">
		<div class="col-xs-12">
			<?php if ( is_front_page() && is_home() ) : ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php else : ?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
			<?php endif; ?>
			<p class="site-description"><?php bloginfo( 'description' ); ?></p>
		</div>
	</div>

	<nav class="navbar navbar-light bg-faded">
	  <a class="navbar-brand" href="#">Navbar</a>
	  

	  <?php wp_nav_menu( array(
                'menu'              => 'primary',
                'theme_location'    => 'primary',
                'depth'             => 2,
                'container'         => 'div',
                'container_class'   => 'collapse navbar-collapse',
        				'container_id'      => 'bs-example-navbar-collapse-1',
                'menu_class'        => 'nav navbar-nav',
                'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                'walker'            => new wp_bootstrap_navwalker())
            );
		?>
	  

	  <ul class="nav navbar-nav">
	    <li class="nav-item active">
	      <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
	    </li>
	    <li class="nav-item">
	      <a class="nav-link" href="#">Features</a>
	    </li>
	    <li class="nav-item">
	      <a class="nav-link" href="#">Pricing</a>
	    </li>
	    <li class="nav-item">
	      <a class="nav-link" href="#">About</a>
	    </li>
	  </ul>
	  <form class="form-inline navbar-form pull-right">
	    <input class="form-control" type="text" placeholder="Search">
	    <button class="btn btn-secondary-outline" type="submit">Search</button>
	  </form>
	</nav>

	</header>

	<div id="content" class="site-content">
