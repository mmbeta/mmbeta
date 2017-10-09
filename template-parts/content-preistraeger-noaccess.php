<?php
/**
 * Template part for displaying paywall on preistraeger pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package medium_magazin_beta
 */

?>

<div class="col-xs-12">
  <article class="card">
    <div class="card-block">
      <h4 class="card-title">Kaufen Sie den Zugang zum Steckbrief von <?php the_title(); ?></h4>
      <p class="card-text">
        Sie können sich die Profile aller ausgezeichneten Top30 bis 30 ansehen, wenn Sie über Laterpay dafür bezahlen.
      </p>
    </div>
    <div class="card-block">
      <a href="<?php the_permalink(); ?>" class="btn btn-secondary">Jetzt kaufen</a>  
    </div>  
  </article>
</div>