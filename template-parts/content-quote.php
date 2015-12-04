<?php
/**
 * Template part for displaying quote posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package medium_magazin_beta
 */

?>
<article class="card col-xs-12 col-md-6">  
  <?php if (has_post_thumbnail()) : ?>
  <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' ); ?>
  <img class="card-img-top" src="<?php echo $image[0]; ?>" alt="<?php the_title() ?>">
  <?php endif; ?>
  <div class="card-block">
    <h4 class="card-title"><?php the_title(); ?></h4>
    <p class="card-text"><?php the_content(); ?></p>
    <a href="<?php the_permalink(); ?>" class="btn btn-primary">Fragebogen</a>
  </div>
</article>