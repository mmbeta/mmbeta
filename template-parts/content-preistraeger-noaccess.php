<?php
/**
 * Template part for displaying paywall on preistraeger pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package medium_magazin_beta
 */

?>

<div class="card col-12 col-lg-8 mb-3">
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
    <a href="<?php echo mmbeta_get_laterpay_purchase_link( $post->tax_page ); ?>" class="btn btn-lg btn-outline-secondary">Jetzt kaufen</a> 

    <!-- Test redeem voucher -->

      <div id="lp_js_giftCardWrapper" class="lp_js_giftCodeWrapper lp_js_dataDeferExecution lp_redeem-code__wrapper lp_clearfix">
        <input type="text" name="gift_code" class="lp_js_giftCardCodeInput lp_redeem-code__value" maxlength="6">
        <p class="lp_redeem-code__input-hint"><?php esc_html_e( 'Gutscheincode', 'laterpay' ); ?></p>
        <a href="#" class="lp_js_giftCardRedeemButton lp_redeem-code__button lp_button"><?php esc_html_e( 'Redeem', 'laterpay' ); ?></a>
      </div>

      <a href="#" id="fakebtn" class="lp_js_doPurchase" style="display:none;" data-laterpay="" data-preview-as-visitor="<?php echo esc_attr( $laterpay['preview_post_as_visitor'] ); ?>"></a>

    <!-- End Test -->


  </div>
</div>