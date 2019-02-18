<?php
/**
 * HP Layout Video.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package medium_magazin_beta
 */
  
  $embed = get_sub_field('embed_element');
  $link = get_sub_field('embed-teaser-link') ? get_permalink( get_sub_field('embed-teaser-link') ) : false;
?>

        
<!-- Video -->
<div class="col-12 col-lg-6">
  <?php if ( $embed ):
    
    echo '<div class="embed-container">';
      echo $embed;   
    echo '</div>';

  endif; ?> 
</div>

<!-- Text-Block -->
<div class="col-12 col-lg-6 mt-1 mt-lg-0">
  <?php if( $link ): ?>
    <a href="<?php echo($link); ?>" class="voll-teaser-link">
  <?php endif; ?>
  <h3 class="card-title teaser1-header"><?php echo get_sub_field('embed-teaser-titel'); ?></h3>
  <div class="teaser1-text">
    <?php 
      echo get_sub_field('embed-teaser-text');
    ?>
  </div>

  <?php if( $link ): ?>
  </a>
  <div>
    <a href="<?php echo $link; ?>" class="teaser1-link">mehr</a>
  </div>
  <?php endif; ?> 
</div>