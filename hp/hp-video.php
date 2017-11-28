<?php
/**
 * HP Layout Video.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package medium_magazin_beta
 */
  
  $embed = get_sub_field('embed_element');
?>


<div class="col-xs-12">
  <div class="card teaser teaser1-body">
    <div class="col-xs-12 col-md-6 col-lg-4">
      <?php if ( $embed ):
        
        echo '<div class="embed-container">';
          echo $embed;   
        echo '</div>';

      endif; ?> 
    </div>
    <div class="col-xs-12 col-md-6 col-lg-8">
      <h3 class="card-title teaser1-header"><?php the_sub_field('embed-teaser-titel'); ?></h3>
      <div class="teaser1-text">
        <?php 
          the_sub_field('embed-teaser-text');
        ?>
      </div>
    </div>
  </div>
</div>