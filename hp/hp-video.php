<?php
/**
 * HP Layout Video.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package medium_magazin_beta
 */
  
  $embed = get_sub_field('embed_element');
  $link = get_permalink( get_sub_field('embed-teaser-link') );
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
        
        <?php if($link): ?>
          <a href="<?php echo $link; ?>" class="voll-teaser-link">
        <?php endif; ?>
        <div class="col-xs-12 col-md-6">
          <h3 class="card-title teaser1-header"><?php echo get_sub_field('embed-teaser-titel'); ?></h3>
          <div class="teaser1-text">
            <?php 
              echo get_sub_field('embed-teaser-text');
            ?>
          </div>
          <?php if($link): ?>
          <div>
            <a href="<?php echo $link; ?>" class="teaser1-link">mehr</a>
          </div>
          <?php endif; ?> 
        </div>
        <?php if($link): ?>
          </a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>