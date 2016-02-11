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
      echo '<div id="owl-example" class="owl-carousel">';
      while ( $owlcarousel->have_posts() ) {     
        $owlcarousel->the_post();
        $image = wp_get_attachment_image_src( $post->ID, 'thumbnail', false );
        echo '<img src="' . $image[0] . '">';
      }
      echo "</div>";
    } else {
      echo 'no postst found';
    }

    // Restore original Post Data
    wp_reset_postdata();

  get_footer();

  ?>
  <!-- Ende Galerie -->