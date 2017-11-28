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

<div class="row m-t">
  <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1 col-xl-8 col-xl-offset-2">
    <div class="col-xs-12">
      <div class="card teaser teaser1-body">
        <div class="col-xs-12 col-md-6">
          <?php if ( $embed ):
            
            echo '<div class="embed-container">';
              echo $embed;   
            echo '</div>';

          endif; ?> 
        </div>
        <div class="col-xs-12 col-md-6">
          <h3 class="card-title teaser1-header"><?php echo get_sub_field('embed-teaser-titel'); ?></h3>
          <div class="teaser1-text">
            <?php 
              echo get_sub_field('embed-teaser-text');
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>