<?php
/**
 * teaser 1.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package medium_magazin_beta
 */

?>
<div class="card col-xs-12 col-sm-6 col-md-4 teaser1-container">
  
  <div class="card-block teaser1-content"> 
    
    <div class="teaser1-body">
      
      <img class="card-img-top teaser1-img" src="<?php the_post_thumbnail_url(); ?>" alt="Card image cap">        
      <h3 class="card-title teaser1-header"><?php the_title(); ?></h3>
      <div class="teaser1-text">
      <?php the_excerpt(); ?>
        <a href="#" class="teaser1-link">Button</a> 
      </div>
    </div>
  
  </div>
    
</div>