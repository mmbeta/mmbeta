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

// Cases: 
// `toplevel` - Seite ist top30 oder jdj (top-level Tag) -> Liste der Jahrgänge
// `jahrgang` - Seite ist Jahr (2016jdj, 2017top30) -> Liste der Preisträger des Jahrgangs (eigentlich über Seiten gelöst bzw. am Tag gespeichert)
// `preiskategorie` - Seite ist Preiskategorie (nur JDJ) -> Cards-Übersicht über die Preisträger der Kategorie

$page_type = "archive";
$tax_name = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
$tax_parent = get_term_by('id', $tax_name->parent, get_query_var( 'taxonomy' ) );

if(!$tax_parent){
  $page_type = "toplevel";
}elseif ( strpos( $tax_name->name, '20' ) !== false ) {
  $page_type = "jahrgang";
}elseif ( strpos( $tax_parent->name, '20' ) !== false ) {
  $page_type = "preiskategorie";
}

print($page_type);


if ($tax_name->parent) {
  $tax_name_parent = get_term($tax_name->parent, get_query_var('taxonomy') );
}else{
  $tax_name_parent = false;
}



if($tax_name_parent && $tax_name_parent->slug === 'journalisten-des-jahres' || $tax_name_parent->slug === 'top-30-bis-30'){
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
  }elseif ($tax_name_parent) {
    $args = array (
      'pagename' => strtolower($tax_name->name . '-' . $tax_name_parent->name),
    );
  }

  
  $term_name_query = new WP_Query( $args );

  if ( $term_name_query->have_posts() ) {
    while ( $term_name_query->have_posts() ) {
      $term_name_query->the_post(); ?>
        <div class="row">
          <div class="col-xs-12 col-lg-8 col-lg-offset-2">
            <div class="row">
              <h1><?php the_title();?></h1>
              <?php the_content(); ?>
            </div>
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