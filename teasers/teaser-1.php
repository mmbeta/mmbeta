<?php
/**
 * teaser 1.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package medium_magazin_beta
 */

$teaser_image = get_the_post_thumbnail_url( $post, 'medium');
?>
<div class="card col-xs-12 col-sm-6 col-md-4 teaser1-container">
  
  <div class="card-block teaser1-content"> 
    
    <div class="teaser1-body">
      <?php if ($teaser_image) { ?>
        <img class="card-img-top teaser1-img" src="<?php echo $teaser_image;  ?>" alt="Card image cap">
      <?php } ?>
      <h3 class="card-title teaser1-header"><?php the_title(); ?></h3>
      <div class="teaser1-text">
      <?php the_excerpt(); ?>
        <a href="<?php echo the_permalink(); ?>" class="teaser1-link">Button</a> 
      </div>
    </div>
  
  </div>
    
</div>