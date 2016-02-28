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

<a href="<?php the_permalink(); ?>">
  <div class="card col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-4 teaser2-container"> 
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
</a>