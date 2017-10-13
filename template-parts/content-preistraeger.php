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
  $access = true;
  

  global $post;
  $post->tax_page = $tax_page;
  $post->preis = $preis;
  $post->preis_slug = $preis_slug;
  $post->jahr_name = mmbeta_welches_preis_jahr();

  if ( class_exists("LaterPay_Helper_Request") &&  ! empty($tax_page) ):
    $access_result = LaterPay_Helper_Request::laterpay_api_get_access( array($tax_page) );
  ?>
    <div style="display: none;"><?php print_r($access_result); ?></div>
  <?php
    if ( empty( $access_result ) || ! array_key_exists( 'articles', $access_result ) ) {
      $access = false;
    }

    if ( array_key_exists( 'articles', $access_result ) ) {
      $access = $access_result['articles'][$tax_page]['access'];
    }
  endif;  
?>

<article id="preistraeger-<?php the_ID(); ?>" class="col-xs-12" ?>
  <div class="m-t m-b row">  
    <div class="col-lg-8 col-lg-offset-2 col-xs-12">
      
      <ol class="breadcrumb" style="background-color: <?php print mmbeta_color() ?>">
        <li class="breadcrumb-item"><a href="/preise/<?php print $preis_slug; ?>"><?php print $preis; ?></a></li>
        <li class="breadcrumb-item"><a href="<?php the_permalink($tax_page); ?>"><?php print $post->jahr_name; ?></a></li>
        <?php if ($preis_slug !== 'top-30-bis-30') : ?>
          <li class="breadcrumb-item">
            <a href="/preise/<?php print $kategorie->slug; ?>"><?php print $kategorie->name; ?></a>
          </li>
        <?php endif; ?>
        <li class="breadcrumb-item active"><?php the_title(); ?></li>
      </ol>

    <!-- ab hier wird nur angezeigt, wenn Access -->
    <?php if($access): ?>

      <!-- Bild und Profilbox -->
      <div class="col-lg-4 col-md-2 col-xs-5">
        <?php if (!has_post_thumbnail()) : ?>      
          <figure class="figure">
            <img class="logo" alt="Logo der Journalisten des Jahres" src="<?php print get_template_directory_uri() . '/images/jdjschwarzaufweiss.png'  ?>">
          </figure>
        <?php else : ?>
          <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' ); ?>
          <?php $caption = get_post(get_post_thumbnail_id($post->ID))->post_excerpt; ?>
          <figure class="figure">
            <img src="<?php echo $image[0] ?>" alt="<?php echo $caption ?>" class="img-responsive figure-img">
            <figcaption class="figure-caption"><?php echo $caption ?></figcaption>
          </figure>
        <?php endif; ?>
        
        <?php if ( get_field("website") || get_field('geburtsdatum') || get_field('geburtsdatum-fallback') || get_field('twitter') ) : ?>
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
      <!-- Ende: Bild und Profilbox -->

      <!-- Hauptspalte - Titel, Position, Begründung -->
      <div class="col-lg-8">
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
          
          <!-- Kategorienliste -->
          <?php if ($preis_slug !== 'top-30-bis-30') : ?>
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
                'title_li'     => $title
              );
              ?>
            <ul class="list-inline">
              <?php wp_list_categories( $args ); ?>
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

    <?php 
      else:
        get_template_part( 'template-parts/content', get_post_type( $post ) . '-noaccess' );
      endif; 
    ?>
      <!-- Ende: Hauptspalte - Titel, Position, Begründung -->
    </div><!-- col-lg-8 -->
  </div><!-- row -->
</article><!-- #post-## -->