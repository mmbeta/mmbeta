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

  <div class="m-t m-b row">  
    <?php if (!has_post_thumbnail()) : ?>
    <div class="col-md-2 col-xs-5">
      <figure class="figure">
        <img class="img-responsive" alt="Logo der Journalisten des Jahres" src="<?php print get_template_directory_uri() . '/images/jdjschwarzaufweiss.png'  ?>">
      </figure>
    </div>
    <?php else : ?>
    <div class="col-lg-3">
      <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' ); ?>
      <?php $caption = get_post(get_post_thumbnail_id($post->ID))->post_excerpt; ?>
      <figure class="figure">
        <img src="<?php echo $image[0] ?>" alt="<?php echo $caption ?>" class="img-responsive figure-img">
        <figcaption class="figure-caption"><?php echo $caption ?></figcaption>
      </figure>
    </div>
    <?php endif; ?>
    
    <div class="col-lg-8">
    <?php if ( ! post_password_required() ) { ?>
        <?php the_title( '<h3 class="entry-title">', '</h3>' ); ?>
        <h6 class="text-muted"><?php the_field( "position" ); ?></h6>
        <div class="lead"><strong>Kategorie:</strong> <?php mmbeta_die_preiskategorie(); ?>, <strong>Platz: </strong><?php the_field('platz'); ?> </div>
        <div class="m-t"><?php the_field( "begruendung" ); ?></div>
        <div class="small">
          <strong>Alle Kategorien:</strong>
          <?php
            $taxonomy = 'preise';
            echo $post->ID;
            $post_terms = wp_get_object_terms( $post->ID, $taxonomy, array( 'fields' => 'ids' ) );
            $separator = ', ';
            if ( !empty( $post_terms ) && !is_wp_error( $post_terms ) ) {
              $term_ids = implode( ',' , $post_terms );
              $terms = wp_list_categories( 'title_li=&style=none&echo=0&taxonomy=' . $taxonomy . '&exclude=2,3' );
              $terms = rtrim( trim( str_replace( '<br />',  $separator, $terms ) ), $separator );
              echo  $terms;
          }
          ?>
          </div>
    <?php  } else {
        the_excerpt();
      };
    
    ?>
      
    </div>
  </div><!-- .entry-content -->

</article><!-- #post-## -->