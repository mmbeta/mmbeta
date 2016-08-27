<?php
/**
 * The template for displaying the footer.
 *
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package medium_magazin_beta
 */

?>

</div><!-- #page -->
<footer class="col-xs-12 m-t text-xs-center" role="contentinfo">

  <?php if ( is_active_sidebar( 'footer_sidebar' ) ) : ?>
    <div id="footer-sidebar" class="footer-sidebar widget-area" role="complementary">
      <?php dynamic_sidebar( 'footer_sidebar' ); ?>
    </div><!-- footer-sidebar -->
  <?php endif; ?>

  <ul class="list-unstyled">
    <li><a href="http://www.mediummagazin.de/impressum">Impressum</a></li>
    <li><a href="http://www.mediummagazin.de/beta/">Über die Beta</a></li>
  </ul>
</footer><!-- #colophon -->


<?php wp_footer(); ?>

<!-- Box to show a popup in -->
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <img class="img-responsive" id="modal_image" src="">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- End of Image Modal box -->

</body>
</html>
