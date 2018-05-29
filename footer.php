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

<footer class="row m-t mmbeta_footer" role="contentinfo">

  <?php if ( is_active_sidebar( 'footer_sidebar' ) ) : ?>
    <div id="footer-sidebar" class="footer-sidebar widget-area" role="complementary">
      <?php dynamic_sidebar( 'footer_sidebar' ); ?>
    </div><!-- footer-sidebar -->
  <?php endif; ?>


  <!-- Footer Menu -->
  <?php 
      $menu_name = 'footer';
      if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
        $menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
        $menu_items = wp_get_nav_menu_items($menu->term_id);
        $menu_list = '<nav class="container d-flex flex-wrap flex-row justify-content-center" role="navigation">';


        foreach ( (array) $menu_items as $key => $menu_item ) {
            $title = $menu_item->title;
            $url = $menu_item->url;
            $menu_list .= '<a class="nav-link col-12 col-md-4 align-self-center text-md-center" href="' . $url . '">' . $title . '</a>';
        }
        $menu_list .= '</nav>';
      } else {
        $menu_list = '<ul><li>Menu "' . $menu_name . '" not defined.</li></ul>';
      }

      echo $menu_list;
  ?>

</footer><!-- #colophon -->

</div><!-- #page footer -->

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
        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- End of Image Modal box -->

</body>
</html>
