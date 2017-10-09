<?php 

/**
 * Template Name: Preisträger Liste
 * Template Post Type: post, page
 * The template file for Preisträger lists.
 *
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package medium_magazin_beta
 */

get_header();

$tax_name = get_field('preis_to_show')[0];
$tax_name_parent = get_term($tax_name->parent, get_query_var('taxonomy') );
$access = true;
$post_id = get_the_ID();

$access = true;

$access_result = LaterPay_Helper_Request::laterpay_api_get_access( array($post_id) );

if ( empty( $access_result ) || ! array_key_exists( 'articles', $access_result ) ) {
  $access = false;
}

if ( array_key_exists( 'articles', $access_result ) ) {
  $access = $access_result['articles'][$post_id]['access'];
}

?>

<div id="primary" class="content-area">
  <main id="main" role="main">
    <div class="row">
      <div class="col-xs-12 m-b bg-jdj p-a">
        <header class="page-header col-xs-12 col-lg-8 col-lg-offset-2">
          <h1 class="page-title"><?php the_title(); ?></h1>
          <div><?php the_field('header-text'); ?></div>
        </header><!-- .page-header -->
      </div>
    </div>
    <div>
      <?php if(get_post_thumbnail_id($post->ID)) :
        $thumb_id = get_post_thumbnail_id($post->ID);
        $image_meta  = wp_get_attachment_metadata( $thumb_id );
        $credit = trim($image_meta['image_meta']['credit']) ? '&#169; ' . $image_meta['image_meta']['credit'] : "";
        ?>
        <div class="row">
          <div class="col-lg-6 col-lg-offset-3 col-xs-10 col-xs-offset-1">
            <figure class="figure">
              <img src="<?php the_post_thumbnail_url('large'); ?>" class="figure-img">
              <figcaption class="figure-caption">
                <?php echo get_post($thumb_id)->post_excerpt; ?>
                <br><small><?php echo $credit; ?></small>
              </figcaption>
            </figure>
          </div>  
        </div>
      <?php 
      endif; 
      ?>
    </div>
    <div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-xs-12">
      <?php the_content(); ?>
    </div>
    <div class="preistraeger-collection-container">
    <?php 

    function end_prev_letter() {
       echo "<!-- End of letter-group -->\n";
       echo "<div class='clear'></div>\n";
    }
    function start_new_letter($letter) {
       echo "<div class='alert-jdj'>\n";
       echo "\t <strong>" . $letter . "</strong>\n";
       echo "</div>";
    }


    $args = array (
      'posts_per_page' => -1,
      'post_type' => 'preistraeger',
      'meta_key' => 'nachname',
      'orderby' => 'meta_value',
      'order' => 'ASC',
      'tax_query' => array(
        'relation' => 'AND',
        array(
          'taxonomy' => 'preise',
          'field'    => 'slug',
          'terms'    => $tax_name_parent->slug,
        ),
        array(
          'taxonomy' => 'preise',
          'field'    => 'slug',
          'terms'    => $tax_name->slug,
        ),
      ),
    );

    query_posts($args);
    if ( have_posts() ) {
      echo '<div class="row">';
      echo '  <div class="col-xs-12 col-lg-8 col-lg-offset-2">';
      $in_this_row = 0;
      $curr_letter = "";
      $post_count = 0;
      while ( have_posts() ) {
         the_post();
         $first_letter = strtoupper(mb_substr(get_field('nachname'),0,1));
         if ($first_letter != $curr_letter) {
            if (++$post_count > 1) {
               end_prev_letter();
            }
            start_new_letter($first_letter);
            $curr_letter = $first_letter;
         }
        get_template_part('teasers/teaser', get_post_type());
      }
      end_prev_letter();
      ?>
      </div>
    <?php } else {
      echo "<h2>Sorry, no posts were found!</h2>";
    } //end of jdj-archive

    ?>
    </div>
  </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>