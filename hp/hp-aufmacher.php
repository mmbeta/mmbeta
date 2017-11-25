<?php
/**
 * HP Layout Aufmacher.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package medium_magazin_beta
 */

?>

<div class="row" style="background-color: <?php echo( mmbeta_color($post->background_color) ); ?>">

  <?php
  // echo mmbeta_color($post->contrast_color);
  //Bild
  echo wp_get_attachment_image( get_post_thumbnail_id( $post->ID ), 'cover' );
  
  // Themenliste
  if( have_rows('themen') ):
      echo "<ul>";
    // loop through the rows of data
      while ( have_rows('themen') ) : the_row();
  ?>

          <li>
            <?php the_sub_field('topic-title'); ?>
            <?php the_sub_field('topic-teaser'); ?>
          </li>

  <?php
      endwhile;
      echo "</ul>";
  else :

      the_excerpt();

  endif;

  ?>
</div>