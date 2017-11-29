<?php
/**
 * HP Layout Aufmacher.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package medium_magazin_beta
 */

?>

<div class="row flex-container" style="background-color: <?php echo( mmbeta_color($post->background_color) ); ?>;
color: <?php echo( mmbeta_color($post->background_color, true) ); ?>;">

  <?php
  $contrast_color = mmbeta_color($post->contrast_color);
  $contrast_text_color = mmbeta_color($post->contrast_color, true);
  $li_class = mmbeta_color( $post->background_color, true ) === "#FFFFFF" ? "li-bright" : "li-dark";
  $button_text = is_front_page() ? "Zum Heft" : "Heft kaufen";
  $button_link = is_front_page() ? get_permalink() : "https://www.newsroom.de/shop/einzelausgaben/medium-magazin/";
  $attributes = $arrayName = array('class' => 'figure-img aufmacher');
  ?>

  <?php
  //Bild
  echo '<div class="flex-item aufmacher-img-container">' . wp_get_attachment_image( get_post_thumbnail_id( $post->ID ), 'cover', false, $attributes  ) . '</div>';
  ?>
  <div class="flex-item aufmacher-text-container">
  <?php
  // Themenliste
  if( have_rows('themen') ):
      echo "<ul class='list-unstyled aufmacher'>";
    // loop through the rows of data
      while ( have_rows('themen') ) : the_row();
  ?>

          <li class="<?php echo($li_class); ?>">
            <h5 class="topic-title"><?php the_sub_field('topic-title'); ?></h5>
            <p class="topic-teaser"><?php the_sub_field('topic-teaser'); ?></p>
          </li>

  <?php
      endwhile;
      echo "</ul>";
  else :

      the_excerpt();

  endif;

  ?>
    <a href="<?php echo($button_link);  ?>" class="aufmacher-link"><button type="button" class="btn" style="background-color: <?php echo $contrast_color; ?>; border-color: <?php echo $contrast_color; ?>; color: <?php echo $contrast_text_color; ?>;"><?php echo $button_text; ?></button></a>
  </div>
</div>