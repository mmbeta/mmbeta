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

  <div class="m-t m-b row">
    <div class="col-lg-8">
    <?php if ( ! post_password_required() ) { ?>
        <?php the_title( '<h3 class="entry-title">', '</h3>' ); ?>
        <h6 class="text-muted"><?php the_field( "position" ); ?></h6>
        <div class="m-t"><?php the_field( "begruendung" ); ?></div>
    <?php  } else {
        the_excerpt();
      };
    
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
    </div>
    <div class="col-lg-2 pull-lg-right">
    <?php if (has_post_thumbnail()) : ?>
      <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' ); ?>
      <img src="<?php echo $image[0] ?>" alt="..." class="img-fluid">
    <?php endif; ?>
    </div>
  </div><!-- .entry-content -->

</article><!-- #post-## -->