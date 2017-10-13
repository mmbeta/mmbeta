<?php
/**
 * Template part for displaying paywall on preistraeger pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package medium_magazin_beta
 */

?>

<div class="col-xs-12">
  <article class="card">
    <div class="card-block">
      <h4 class="card-title">Kaufen Sie den Zugang zu <?php echo $post->preis . " " . $post->jahr_name; ?></h4>
      <p class="card-text">
        <?php 
        if ($post->preis_slug == "top-30-bis-30") {
          the_field('paywall-text_top30', 'option'); 
        }else{
          the_field('paywall-text_jdj', 'option');         
        }
        ?>
      </p>
    </div>
    <div class="card-block">
      <?php global $post; ?>
      <a href="<?php echo mmbeta_get_laterpay_purchase_link( $post->tax_page ); ?>" class="btn btn-secondary">Jetzt kaufen</a> 

 
    </div>  
  </article>
</div>