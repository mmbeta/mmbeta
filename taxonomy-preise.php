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

/** 
* Cases: 
* `toplevel` - Seite ist top30 oder jdj (top-level Tag) -> Liste der Jahrgänge
* `jahrgang` - Seite ist Jahr (2016jdj, 2017top30) -> Liste der Preisträger des Jahrgangs (eigentlich über Seiten gelöst bzw. am Tag gespeichert)
* `preiskategorie` - Seite ist Preiskategorie (nur JDJ) -> Cards-Übersicht über die Preisträger der Kategorie
*/

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

get_template_part('template-parts/archive', $page_type);

?>

<?php get_footer();?>