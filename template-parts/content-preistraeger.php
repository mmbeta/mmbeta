<?php
/**
 * Template part for displaying single Preisträger.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package medium_magazin_beta
 */

?>

<?php
  $kategorie = mmbeta_die_preiskategorie_object();
  $preis = get_term($kategorie->parent, 'preise')->slug;
?>

<article id="preistraeger-<?php the_ID(); ?>" <?php post_class(); ?>>
  <div class="m-t m-b row">  
    <div class="col-lg-8 col-lg-offset-2 col-xs-12">
    <?php if (!has_post_thumbnail()) : ?>
    <div class="col-md-2 col-xs-5">
      <figure class="figure">
        <img class="img-responsive col-lg-12" alt="Logo der Journalisten des Jahres" src="<?php print get_template_directory_uri() . '/images/jdjschwarzaufweiss.png'  ?>">
      </figure>
    </div>
    <?php else : ?>
    <div class="col-lg-4">
      <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' ); ?>
      <?php $caption = get_post(get_post_thumbnail_id($post->ID))->post_excerpt; ?>
      <figure class="figure">
        <img src="<?php echo $image[0] ?>" alt="<?php echo $caption ?>" class="img-responsive figure-img">
        <figcaption class="figure-caption"><?php echo $caption ?></figcaption>
      </figure>
      
      <?php if ($preis === 'top-30-bis-30') : ?>
      <div class="profil-box m-b">
        <ul class="list-group">
          <?php if(get_field('geburtsdatum')) : ?>
            <li class="list-group-item"><strong>Geburtstag:</strong> <?php echo date_i18n(get_option( 'date_format' ), strtotime( get_field( "geburtsdatum" ) ) ); ?></li>
          <?php elseif (get_field('geburtsdatum-fallback')) : ?>
            <li class="list-group-item"><strong>Geburtstag:</strong> <?php the_field( "geburtsdatum-fallback" ); ?></li>
          <?php endif; ?>
          <?php if(get_field('twitter')) : ?>
            <?php $twitterlink = "http://www.twitter.com/" . get_field( 'twitter' ); ?>
            <li class="list-group-item"><strong>Twitter:</strong> <a href="<?php echo $twitterlink; ?>"><?php the_field( 'twitter' ); ?></a></li>
          <?php endif;?>
            <?php if (get_field("website")) : ?>
            <li class="list-group-item"><strong>Web:</strong> <a href="<?php echo get_field("website"); ?>"><?php the_field( "website_label" ); ?></a></li>
          <?php endif; ?>
        </ul>
      </div>
      <?php endif; ?>

    </div>
    <?php endif; ?>
    
    <div class="col-lg-8">
    <?php if ( ! post_password_required() ) { ?>
        <?php the_title( '<h3 class="entry-title">', '</h3>' ); ?>
        <h6 class="text-muted"><?php the_field( "position" ); ?></h6>
        

        <?php if ($preis !== 'top-30-bis-30') : ?>
        <div class="lead">
          <strong>Kategorie:</strong> <?php mmbeta_die_preiskategorie(); ?>, <strong>Platz: </strong>
          <?php the_field('platz'); ?>
        </div>
        <?php endif; ?>

        <div class="m-t"><?php the_field( "begruendung" ); ?></div>
        <?php if ($preis !== 'top-30-bis-30') : ?>
        <div class="small">
          <!-- <strong>Alle Kategorien:</strong> -->

          <?php
            $taxonomy = 'preise';        
 
            $orderby      = 'count'; 
            $show_count   = 0;      // 1 for yes, 0 for no
            $pad_counts   = 0;      // 1 for yes, 0 for no
            $hierarchical = 0;      // 1 for yes, 0 for no
            $title        = '';

            $args = array(
              'taxonomy'     => $taxonomy,
              'orderby'      => $orderby,
              'order'        => 'DESC',
              'exclude'      => '2,3',
              'show_count'   => $show_count,
              'pad_counts'   => $pad_counts,
              'hierarchical' => $hierarchical,
              'title_li'     => $title
            );
            ?>


        </div>
        <?php endif; ?>
      </div>
    <?php  } else {
        the_excerpt();
      };
    
    ?>
      
    </div>
  </div><!-- .entry-content -->

</article><!-- #post-## -->