<?php
/**
 * HP Layout Teasergruppe-3.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package medium_magazin_beta
 */

$teaser_image = get_the_post_thumbnail_url( $post, 'square');
$teaser_text = get_post_meta( get_the_ID(), 'hp_teaser', true );
?>

<a href="<?php the_permalink(); ?>" class="voll-teaser-link">
  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
    <div class="card teaser teaser1-container">
      <div class="card-block teaser1-content">       
        <div class="teaser1-body">
        <?php if ($teaser_image) { ?>
          <img src="<?php echo $teaser_image; ?>" alt="..." class="teaser1-img">
        <?php } ?>        
          <h3 class="card-title teaser1-header"><?php the_title(); ?></h3>
          <div class="teaser1-text">
            <?php 
              if ( ! empty( $teaser_text ) ) {
                echo $teaser_text;
              }else{
                the_excerpt();
              }
            ?>
            <a href="<?php the_permalink(); ?>" class="teaser1-link">mehr</a> 
          </div>
        </div>
      </div>  
    </div>
  </div>
</a>