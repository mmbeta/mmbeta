<?php
/**
 * The template for displaying Preisträger-Übersicht.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package medium_magazin_beta
 */

get_header();?>
<?php 
$tax_name = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
$tax_name_parent = get_term($tax_name->parent, get_query_var('taxonomy') );
$page_name = strtolower($tax_name->name . '-' . $tax_name_parent->name);

if($tax_name_parent->slug === 'journalisten-des-jahres'){
  get_template_part('template-parts/content', 'jdj-uebersicht');
}else{

  $args = array (
    'pagename' => $page_name,
  );

  $term_name_query = new WP_Query( $args );

  if ( $term_name_query->have_posts() ) {
    while ( $term_name_query->have_posts() ) {
      $term_name_query->the_post(); ?>
        <div class="row">
          <div class="col-xs-12 col-lg-8 col-lg-offset-2">
            <h1 class="display-4"><?php the_title(); ?></h1>
            <?php the_content(); ?>
          </div>
        </div>
    <?php 
    }
  } else {
    if (is_user_logged_in()) {
      echo 'Legen Sie eine Seite mit dem slug "' . $page_name . '" an.';
    }
  }
  get_template_part('template-parts/content', 'preis-uebersicht');
  // Restore original Post Data
  wp_reset_postdata();

}  ?>

</main><!-- #main -->
<?php get_footer();?>