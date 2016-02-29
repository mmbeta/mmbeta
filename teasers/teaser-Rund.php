<?php
/**
 * teaser Rund.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package medium_magazin_beta
 */

$teaser_image = get_the_post_thumbnail_url( $post, 'medium');
$teaser_text = get_field('teaser-text');
?>
    <div class="card col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 teaser3-container">
      
      <div class="card-block teaser3-content"> 
        
        <div class="teaser3-body">
          <?php if ($teaser_image) { ?>  
          <img class="img-circle teaser3-img" src="<?php echo $teaser_image; ?>" alt="Card image cap">
          <?php } ?>          
          <h3 class="card-title teaser3-header"><?php the_title(); ?></h3>
          <div class="teaser3-text">
            <?php $teaser_text ? the_field('teaser-text') : the_excerpt() ?>
            <a href="<?php the_permalink(); ?>" class="teaser1-link">mehr</a>
          </div>
        </div>
      
      </div>
        
    </div>