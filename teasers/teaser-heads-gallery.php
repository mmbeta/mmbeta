<?php
/**
 * teaser Heads Gallery.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package medium_magazin_beta
 */

$teaser_image = get_the_post_thumbnail_url( $post, 'square');
$teaser_text = get_field('teaser-text');

if (!$teaser_image) {
	return;
}
?>
  
  <div class="item">
    <a href="<?php the_permalink(); ?>" class="voll-teaser-link">
      <?php if ($teaser_image) { ?>  
      <img class="rounded-circle teaser3-img lazyOwl" data-src="<?php echo $teaser_image; ?>" alt="<?php the_title(); ?>">
      <?php } ?>          
      <h6 class="heads-gallery-name"><?php the_title(); ?></h6>
      <p class="heads-gallery-description"><?php the_field( "position" ); ?></p>
    </a>
  </div>