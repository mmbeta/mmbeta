<?php
/**
 * Template part for displaying topics of Ausgaben.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package medium_magazin_beta
 */

?>

<?php

// check if the repeater field has rows of data
if( have_rows('ausgabenthemen') ):

  $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
?>

  <div class="row">
    <div class="page-header col-12 m-b p-a text-center" style="background-color: <?php echo mmbeta_color('petrol'); ?>">

      <figure class="figure col-12 col-sm-8 col-m-6 col-lg-4 col-xl-2">
        <img src="<?php echo $image[0] ?>" alt="<?php echo $caption ?>" class="img-responsive figure-img">
      </figure>


      <ul> 
        <?php
        // loop through the rows of data
        while ( have_rows('ausgabenthemen') ) : the_row();
        ?>
            <li>
            <h4><?php the_sub_field('titel'); ?></h4>
            <p><?php the_sub_field('thementeaser'); ?></p>
            </li>

        <?php
        endwhile;
        ?>
        </ul>
      </div>
  </div>

<?php
else :

    // no rows found

endif;

?>

