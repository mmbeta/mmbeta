<?php
/**
 * Template part for displaying single Preisträger.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package medium_magazin_beta
 */

?>

<article id="preistraeger-<?php the_ID(); ?>" <?php post_class(); ?>>
  <header class="entry-header">
    
  </header><!-- .entry-header -->

  <div class="lead">
    <?php if (has_post_thumbnail()) : ?>
      <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' ); ?>
      <img src="<?php echo $image[0] ?>" alt="..." class="img-circle">
    <?php endif; ?>
    <?php 
      the_excerpt();
      if ( ! post_password_required() ) {
        the_title( '<h3 class="entry-title">', '</h3>' ); the_field( "position" );
        the_field( "begruendung" );
      }

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
  </div><!-- .entry-content -->

  <footer class="entry-footer">
    <?php mmbeta_entry_footer(); ?>
  </footer><!-- .entry-footer -->
</article><!-- #post-## -->