<?php
/**
 * The search mm form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package medium_magazin_beta
 */


?>

<form action="<?php echo home_url( '/' ); ?>" method="get" class="input-group">
  <input type="text" value="<?php the_search_query(); ?>" name="s" id="search" class="form-control" placeholder="Suche" aria-label="Suche">
  <div class="input-group-append">
    <button class="btn btn-outline-secondary" type="submit">Suchen</button>
  </div>
</form>