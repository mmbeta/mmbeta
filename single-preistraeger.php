<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package medium_magazin_beta
 */

get_header(); ?>

  <div id="primary" class="content-area">


    <?php while ( have_posts() ) : the_post(); ?>

      <?php get_template_part( 'template-parts/content', 'preistraeger' ); ?>


      <?php
        // If comments are open or we have at least one comment, load up the comment template.
        if ( comments_open() || get_comments_number() ) :
          comments_template();
        endif;
      ?>

    <?php endwhile; // End of the loop. ?>



    <!-- Other winners' cards -->

    <?php 
      $kategorie = mmbeta_die_preiskategorie_object();
      if ( $kategorie->name !== 'JDJ' ){ ?>
        <div class="lead p-l">Außerdem wurden in der Kategorie "<?php mmbeta_die_preiskategorie(); ?>" ausgezeichnet:</div>
      <?php } 

        $die_ID = $post->ID;


        $args = array(
            'post_type' => 'preistraeger',
            'tax_query' => array(
              array(
                'taxonomy' => 'preise',
                'field'    => 'slug',
                'terms'    => $kategorie->slug,
              ),
            ),
            'post__not_in' => array( $die_ID ),
            'meta_key' => 'platz',
            'orderby' => 'meta_value_num',
            'order' => 'ASC',
          );
          $query = new WP_Query( $args );
      

      if ($query->have_posts()): ?>
        <div class="card-columns">
            <?php while ($query->have_posts()): $query->the_post();?>
              
                <article class="card">
                  <div class="card-block">
                    <h4 class="card-title"><?php the_title(); ?></h4>
                    <p class="card-text"><?php the_field( "position" ); ?></p>
                  </div>
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Platz:</strong> <?php the_field('platz'); ?></li>
                    <li class="list-group-item"><strong>Kategorie:</strong> <?php mmbeta_die_preiskategorie(); ?></li>
                  </ul>
                  <div class="card-block">
                    <a href="<?php the_permalink(); ?>" class="btn btn-secondary">Begründung</a>  
                  </div>  
                </article>
            
            <?php endwhile;?>
        </div>
      <?php endif;?>




  </div><!-- #primary -->

<?php get_footer(); ?>