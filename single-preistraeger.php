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
    <div class="row">
    <div class="lead">Außerdem wurden in der Kategorie "<?php mmbeta_die_preiskatekorie(); ?>" ausgezeichnet:</div>
    <div class="col-xs-12 m-t">
     <?php
        $kategorie = mmbeta_die_preiskatekorie_slug();
        $die_ID = $post->ID;


        $args = array(
            'post_type' => 'preistraeger',
            'tax_query' => array(
              array(
                'taxonomy' => 'preise',
                'field'    => 'slug',
                'terms'    => $kategorie,
              ),
            ),
            'post__not_in' => array( $die_ID ),
            'meta_key' => 'platz',
            'orderby' => 'meta_value_num',
            'order' => 'ASC',
          );
          $query = new WP_Query( $args );
      

      if ($query->have_posts()): ?>

            <?php while ($query->have_posts()): $query->the_post();?>
              
                <article class="card col-lg-3 col-md-6 col-sm-12">
                  <?php if (has_post_thumbnail()) : ?>
                  <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' ); ?>
                  
                  <img class="card-img-top img-responsive" src="<?php echo $image[0]; ?>" alt="<?php the_title() ?>">
                  <?php endif; ?>
                  <div class="card-block">
                    <h4 class="card-title"><?php the_title(); ?></h4>
                    <p class="card-text"><?php the_field( "position" ); ?></p>
                  </div>
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Platz:</strong> <?php the_field('platz'); ?></li>
                    <li class="list-group-item"><strong>Kategorie:</strong> <?php mmbeta_die_preiskatekorie(); ?></li>
                  </ul>
                  <div class="card-block">
                    <a href="<?php the_permalink(); ?>" class="btn btn-primary">Fragebogen</a>  
                  </div>  
                </article>
        
            <?php endwhile;?>

    <?php else: ?>
      <?php echo "no Preisträger yet" ;?>
    <?php endif;?>
  </div>
  </div><!-- #primary -->

<?php get_footer(); ?>