<?php
/**
 * HP Layout Teasergruppe-2.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package medium_magazin_beta
 */
$teaser_format = get_post_meta( get_the_ID(), 'hp_teaser_format', true ); 
$teaser_image = get_the_post_thumbnail_url( $post, image_size_for_teaser($teaser_format) );
$teaser_text = get_post_meta( get_the_ID(), 'hp_teaser', true );
?>



<?php if ($teaser_image) { ?>
  <div class="col-12 col-md-6 col-lg-4">
    <a href="<?php the_permalink(); ?>" class="voll-teaser-link">
      <img src="<?php echo $teaser_image; ?>" alt="..." class="teaser-img <?php echo 'teaser-img-' . $teaser_format; ?>">
    </a>
  </div>
<?php } ?>

   
<div class="col-12 col-md-6 col-lg-8 align-self-center">
  <!-- Hier könnte ich checken ob $teaser_format 'ad' und dann  -->
  <?php 
    echo $teaser_format;
    if ($teaser_format == 'ad') {
      echo '<img src="https://placeimg.com/970/250/any" title="ad placeholder">';
    }else{
  ?>
  <a href="<?php the_permalink(); ?>" class="voll-teaser-link">
    <h3 class="card-title teaser1-header"><?php the_title(); ?></h3>
    <div class="teaser1-text">
      <?php 
        if ( ! empty( $teaser_text ) ) {
          echo $teaser_text;
        }else{
          the_excerpt();
        }
      ?>
      <div>
        <a href="<?php the_permalink(); ?>" class="teaser1-link">mehr</a>
      </div> 
    </div>
  </a>

<?php } ?>
</div>


