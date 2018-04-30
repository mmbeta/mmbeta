<?php
/**
 * Template part for displaying galleries.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package medium_magazin_beta
 */

?>

<div class="row">
  <div class="col-12 col-lg-8 offset-lg-2">
    <?php the_content(); ?>
  </div>
</div>

<!-- Gallery Modal -->
<div class="modal fade" id="galleryModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="myModalLabel"><?php the_title(); ?></h4>
      </div>
      <div id="owl-example" class="modal-body owl-carousel">
        <!-- slides are added via jQuery -->
      </div>
    </div>
  </div>
</div>