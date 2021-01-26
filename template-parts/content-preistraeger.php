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
  $kategorie_id = $kategorie->term_id;
  $preis = mmbeta_welcher_preis();
  $preis_slug = mmbeta_welcher_preis('slug');
  $preis_id = mmbeta_welcher_preis('term_id');
  $jahr_id = mmbeta_welches_preis_jahr('term_id');

  $jahr_object = get_term_by( 'id', $jahr_id, 'preise' );
  $tax_page = get_field('preis_seite', $jahr_object )[0];
  $tax_page_url = get_post_permalink($tax_page);
  

  global $post;
  $post->tax_page = $tax_page;
  $post->preis = $preis;
  $post->preis_slug = $preis_slug;
  $post->jahr_name = mmbeta_welches_preis_jahr();
  
?>

<article id="preistraeger-<?php the_ID(); ?>" class="row justify-content-center d-flex mt-3 mb-3" ?>


      
      <ol class="breadcrumb col-lg-10 col-11" style="background-color: <?php print mmbeta_color('grau-heller') ?>">
        <li class="breadcrumb-item"><a href="/preise/<?php print $preis_slug; ?>"><?php print $preis; ?></a></li>
        <li class="breadcrumb-item"><a href="<?php the_permalink($tax_page); ?>"><?php print $post->jahr_name; ?></a></li>
        <?php if ($preis_slug !== 'top-30-bis-30') : ?>
          <li class="breadcrumb-item">
            <a href="/preise/<?php print $kategorie->slug; ?>"><?php print $kategorie->name; ?></a>
          </li>
        <?php endif; ?>
        <li class="breadcrumb-item active"><?php the_title(); ?></li>
      </ol>

      <!-- Bild und Profilbox -->
      <div class="col-lg-3 col-md-4 col-11">
        <?php if (!has_post_thumbnail()) : ?>      
          <figure class="figure">
            <img class="logo" alt="Logo der Journalisten des Jahres" src="<?php print get_template_directory_uri() . '/images/jdjschwarzaufweiss.png'  ?>">
          </figure>
        <?php else : ?>
          <?php $caption = get_post(get_post_thumbnail_id($post->ID))->post_excerpt; ?>
          <figure class="figure">
            <?php the_post_thumbnail('cover', array('class' => 'img-responsive figure-img')); ?>
            <figcaption class="figure-caption"><?php echo $caption ?></figcaption>
          </figure>
        <?php endif; ?>
        
        <?php if ( get_field("website") || get_field('geburtsdatum') || get_field('geburtsdatum-fallback') || get_field('twitter') ) : ?>
        <div class="profil-box m-b text-xs-left">
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
      <!-- Ende: Bild und Profilbox -->

      <!-- Hauptspalte - Titel, Position, Begründung -->
      <div class="col-lg-7 col-md-6 col-11 mt-3 mt-md-0">
      <?php if ( ! post_password_required() ): ?>
          <?php the_title( '<h3 class="entry-title">', '</h3>' ); ?>
          <h6 class="text-muted"><?php the_field( "position" ); ?></h6>
          
          <?php if ($preis_slug !== 'top-30-bis-30') : ?>
          <div class="lead">
            <strong>Kategorie:</strong> <?php mmbeta_die_preiskategorie(); ?>, <strong>Jahr: </strong><?php print mmbeta_welches_preis_jahr() . ", "; ?><strong>Platz: </strong>
            <?php the_field('platz'); ?>
          </div>
          <?php endif; ?>

          <div class="m-t"><?php echo apply_filters('the_content', the_field( "begruendung" ) ); ?></div>
          
          <!-- Kategorienliste wid nur angezeigt wenn JDJ und auf am Jahr (Taxonomy Preis) der entsprechende Haken auf true steht (default) -->
          <?php if ($preis_slug !== 'top-30-bis-30' && get_field("show_cat_tags", $jahr_object) ) : ?>
          <div class="small">
            <strong>Alle Kategorien:</strong>

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
                'child_of'     => $jahr_id,
                'show_count'   => $show_count,
                'pad_counts'   => $pad_counts,
                'hierarchical' => $hierarchical,
              );
              ?>
            <ul class="list-inline">
              <?php 
                $terms = get_terms( $args );
                $terms_count = count($terms);

                for ($i=0; $i < $terms_count; $i++) { 
                  $term_link = get_term_link($terms[$i]);
                  $term_name = $terms[$i]->name;
                  $term_output = "<a href='" . $term_link . "'>" . $term_name . "</a>";

                  if ($i < $terms_count - 1 ) {
                    $term_output .= ", ";
                  }
                  echo $term_output;
                }

              ?>
            </ul>

          </div>
          <?php endif; ?>
          <!-- Ende: Kategorienliste -->

      <?php  
        else:
          the_excerpt();
        endif;
      ?>
        
      </div>


      <!-- Ende: Hauptspalte - Titel, Position, Begründung -->


</article><!-- #post-## -->