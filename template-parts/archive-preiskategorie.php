<?php
  $terms = get_the_terms( get_the_ID(), 'preise');
  $term = get_query_var( 'term' );
  $term_object = get_term_by( 'slug', $term, 'preise' );
  $tax_page = get_field('preis_seite', $term_object );

  // To keep pages working where pages where included by page-slug-logic I fall back to this behaviour
  if($tax_page){
    $args = array (
      'page_id' => $tax_page[0],
    );   
  }elseif ( isset($tax_name_parent) ) {
    $args = array (
      'pagename' => strtolower($tax_name->name . '-' . $tax_name_parent->name),
    );
  }else{
    $args = array ();
  }

  
  $term_name_query = new WP_Query( $args );

  if ( $term_name_query->have_posts() ) {
    while ( $term_name_query->have_posts() ) {
      $term_name_query->the_post(); ?>
        <div class="row">
          <div class="col-12 col-lg-8 col-lg-offset-2">
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
