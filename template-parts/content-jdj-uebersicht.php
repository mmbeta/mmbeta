<?php
/**
 * The template for displaying JDJ-Übersicht.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package medium_magazin_beta
 */

?>

<main id="main" class="site-main m-t" role="main">
  <?php
  $tax_name = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
  $tax_name_parent = get_term($tax_name->parent, get_query_var('taxonomy') );
  $page_name = strtolower($tax_name->slug . '-' . $tax_name_parent->slug);

  $args = array (
    'pagename' => $page_name,
  );

  $term_name_query = new WP_Query( $args );

  if ( $term_name_query->have_posts() ) {
    while ( $term_name_query->have_posts() ) {
      $term_name_query->the_post(); ?>
      <div class="col-xs-12 m-b bg-secondary p-a">
        <header class="page-header col-lg-8 col-xs-12">
          <h1 class="page-title"><?php the_title(); ?></h1>
          <div><?php the_content(); ?></div>
        </header><!-- .page-header -->
      </div>
    <div class="clear"></div>
    <?php 
    }
  } else {
    if (is_user_logged_in()) {
      echo 'Legen Sie eine Seite mit dem slug "' . $page_name . '" an.';
    }
  }

  function end_prev_letter() {
     echo "<!-- End of letter-group -->\n";
     echo "<div class='clear'></div>\n";
  }
  function start_new_letter($letter) {
     echo "<div class='alert alert-success'>\n";
     echo "\t<strong>$letter</strong>\n";
     echo "</div>";
  }


  $args = array (
    'posts_per_page' => -1,
    'post_type' => 'preistraeger',
    'meta_key' => 'nachname',
    'orderby' => 'meta_value',
    'order' => 'ASC',
  );
  query_posts($args);
  if ( have_posts() ) {
    $in_this_row = 0;
    while ( have_posts() ) {
       the_post();
       $first_letter = strtoupper(substr(get_field('nachname'),0,1));
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
  <?php } else {
    echo "<h2>Sorry, no posts were found!</h2>";
  }
//end of jdj-archive