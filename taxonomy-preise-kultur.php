<?php
/**
 * The template test for gallery.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package medium_magazin_beta
 */

get_header();?>

<!-- Galerie -->
  <div class="row">
  <?php
    // WP_Query arguments
    $args = array(
      'post_type' => 'attachment',
      'post_mime_type' => 'image',
      'post_status' => 'inherit',
      'tax_query' => array(
        array(
          'taxonomy' => 'preise',
          'field'    => 'slug',
          'terms'    => '2015',
        ),
      ),
    );

    // The Query
    $owlcarousel = new WP_Query( $args );
    
    // The Loop
    if ( $owlcarousel->have_posts() ) {
      echo '<div id="owl-example" class="owl-carousel col-xs-12 col-lg-8 col-lg-offset-2">';
      while ( $owlcarousel->have_posts() ) {     
        $owlcarousel->the_post();
        $image = wp_get_attachment_image_src( $post->ID, 'large', false );
        $thumb_id = get_post_thumbnail_id( $post->ID );
        $thumb = get_post($thumb_id);
        $image_metadata = wp_get_attachment_metadata( $thumb_id, false )[image_meta];
        ?>

        <figure class="figure">
          <img class="figure-img img-fluid center-block" src="<?php echo $image[0]; ?>">
          <figcaption class="figure-caption">
            <?php echo $thumb->post_excerpt; ?>
            <br><small>
            <?php if ( $image_metadata[credit] ){ echo '&#169; ' . $image_metadata[credit]; } ?>
            </small>
          </figcaption>
        </figure>
      <?php
      }
      echo "</div>";
    } else {
      echo 'no postst found';
    }

    // Restore original Post Data
    wp_reset_postdata();
  get_footer();

  ?>
  </div>
  <!-- Ende Galerie -->