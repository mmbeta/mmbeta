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
  <div class="card col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 teaser1-container">
    
    <div class="card-block teaser1-content"> 
      
      <div class="teaser1-body">
      <?php if ($teaser_image) { ?>
        <img class="card-img-top teaser1-img" src="<?php echo $teaser_image;  ?>" alt="Card image cap">
      <?php } ?>        
        <h3 class="card-title teaser1-header"><?php the_title(); ?></h3>
        <div class="teaser1-text">
        <?php $teaser_text ? the_field('teaser-text') : the_excerpt() ?>
          <a href="<?php the_permalink(); ?>" class="teaser1-link">mehr</a> 
        </div>
      </div>
    
    </div>
      
  </div>
</a>