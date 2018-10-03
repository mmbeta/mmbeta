<?php
/**
 * The search mm form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package medium_magazin_beta
 */


?>

<div class="d-lg-flex">
	<a class="nav-link" data-toggle="collapse" data-target="#navbarSearch" href="#">Suchen</a>
	<div id="navbarSearch" class="collapse">
		<form action="<?php echo home_url( '/' ); ?>" method="get" class="input-group mm-searchform">
		  <div class="input-group-prepend">
		    <button class="btn btn-sm btn-outline-secondary" type="submit">
		    	<img src="<?php print get_template_directory_uri() . '/images/baseline-search-24px.svg'  ?>" height="20" alt="Suchen">
		    </button>
		  </div>
		  <input type="text" value="<?php the_search_query(); ?>" name="s" id="search" class="form-control form-control-sm" aria-label="Suche">
		</form>
	</div>
</div>