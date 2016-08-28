<?php
/**
 * teaser Heads Gallery.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package medium_magazin_beta
 */

$teaser_image = get_the_post_thumbnail_url( $post, 'thumbnail');
$teaser_text = get_field('teaser-text');
?>
  <div class="item">
    <a href="<?php the_permalink(); ?>" class="voll-teaser-link">
      <?php if ($teaser_image) { ?>  
      <img class="img-circle teaser3-img" src="<?php echo $teaser_image; ?>" alt="Card image cap">
      <?php } ?>          
      <h6><?php the_title(); ?></h6>
      <p><?php the_field( "position" ); ?></p>
    </a>
  </div>