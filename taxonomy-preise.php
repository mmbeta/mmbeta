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

if($tax_name_parent->slug === 'journalisten-des-jahres' || $tax_name_parent->slug === 'top-30-bis-30'){
  get_template_part('template-parts/content', 'uebersicht');
}else{

  $terms = get_the_terms( get_the_ID(), 'preise');

  $term = get_query_var( 'term' );
  $term_object = get_term_by( 'slug', $term, 'preise' );

  $tax_page = get_field('preis_seite', $term_object )[0];

  // To keep pages working where pages where included by page-slug-logic I fall back to this behaviour
  if($tax_page){
    $args = array (
      'page_id' => $tax_page,
    );   
  }else{
    $args = array (
      'pagename' => $page_name,
    );
  }

  
  $term_name_query = new WP_Query( $args );

  if ( $term_name_query->have_posts() ) {
    while ( $term_name_query->have_posts() ) {
      $term_name_query->the_post(); ?>
        <div class="row">
          <div class="col-xs-12 col-lg-8 col-lg-offset-2">
            <h1><?php the_title(); ?></h1>
            <?php the_content(); ?>
          </div>
        </div>
    <?php 
    }
  } else {
    if (is_user_logged_in()) {
      $warning = 'Wählen Sie ' . edit_term_link( 'hier', '', '', $term_object, false ) . ' eine Seite aus, die über der Preis-Kategorie-Übersicht angezeigt werden soll.'; 
      echo $warning;
    }
  }
  get_template_part('template-parts/content', 'preis-uebersicht');
  // Restore original Post Data
  wp_reset_postdata();

}  ?>

</main><!-- #main -->
<?php get_footer();?>