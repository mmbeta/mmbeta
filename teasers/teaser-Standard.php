<?php
/**
 * teaser Standard.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package medium_magazin_beta
 */

$teaser_image = get_the_post_thumbnail_url( $post, 'medium');
$teaser_text = get_field('teaser-text');
?>

<a href="<?php the_permalink(); ?>" class="voll-teaser-link">
  <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-6 col-md-offset-0 col-lg-6">
    <div class="card teaser teaser1-container">
      <div class="card-block teaser1-content">        
        <div class="teaser1-body">
        <?php if ($teaser_image) { ?>
          <div class="bg-image bg-image-teaser" style="background-image: url(<?php echo $teaser_image;  ?>);" >
          </div>
        <?php } ?>        
          <h3 class="card-title teaser1-header"><?php the_title(); ?></h3>
          <div class="teaser1-text">
          <?php $teaser_text ? the_field('teaser-text') : the_excerpt() ?>
            <a href="<?php the_permalink(); ?>" class="teaser1-link">mehr</a> 
          </div>
        </div>
      </div>  
    </div>
  </div>
</a>