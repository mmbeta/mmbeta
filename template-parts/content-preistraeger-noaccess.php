<?php
/**
 * Template part for displaying paywall on preistraeger pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package medium_magazin_beta
 */

?>

<div class="card mb-3">
  <div class="card-body">
    <h5 class="card-title">Kaufen Sie den Zugang zu <?php echo $post->preis . " " . $post->jahr_name; ?></h5>
    <p class="card-text">
      <?php 
        if ($post->preis_slug == "top-30-bis-30") {
          the_field('paywall-text_top30', 'option'); 
        }else{
          the_field('paywall-text_jdj', 'option');         
        }
      ?>
    </p>
    <?php global $post; ?>
    <a href="<?php echo mmbeta_get_laterpay_purchase_link( $post->tax_page ); ?>" class="btn btn-outline-secondary">Jetzt kaufen</a> 
  </div>
</div>