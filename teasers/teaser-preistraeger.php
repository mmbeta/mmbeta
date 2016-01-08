<?php
/**
 * Template part for displaying single Preisträger Teaser.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package medium_magazin_beta
 */

?>

<article id="preistraeger-<?php the_ID(); ?>" <?php post_class(); ?>>
  <header class="entry-header">
    <div class="entry-meta">
      <?php
        $taxonomy = 'preise';
        $post_terms = wp_get_object_terms( $post->ID, $taxonomy, array( 'fields' => 'ids' ) );
        $separator = ', ';

        if ( !empty( $post_terms ) && !is_wp_error( $post_terms ) ) {
          $term_ids = implode( ',' , $post_terms );
          $terms = wp_list_categories( 'title_li=&style=none&echo=0&taxonomy=' . $taxonomy . '&include=' . $term_ids );
          $terms = rtrim( trim( str_replace( '<br />',  $separator, $terms ) ), $separator );
          echo  $terms;
        }
      ?>
    </div><!-- .entry-meta -->
  </header><!-- .entry-header -->

  <div class="lead">
    <?php 
      the_excerpt();
      if ( ! post_password_required() ) {
        the_title( '<h3 class="entry-title">', '</h3>' ); the_field( "position" );

      }
    ?>
  </div><!-- .entry-content -->

  <footer class="entry-footer">
    <?php mmbeta_entry_footer(); ?>
  </footer><!-- .entry-footer -->
</article><!-- #post-## -->