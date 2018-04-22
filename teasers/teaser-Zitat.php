<?php
/**
 * teaser Zitat.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package medium_magazin_beta
 */

$teaser_text = get_field('teaser-text');

?>

<a href="<?php the_permalink(); ?>" class="voll-teaser-link">
  <div class="col-12 col-sm-10 col-sm-offset-1 col-md-6 col-md-offset-0 col-lg-6">
    <div class="card teaser teaser2-container"> 
      <div class="card-block teaser2-content"> 
        <div class="teaser2-body">
          <h2 class="card-title teaser2-text"><?php $teaser_text ? the_field('teaser-text') : the_excerpt() ?></h2>
          <div class="teaser2-autor">
            <p>
              <?php the_author(); ?>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</a>