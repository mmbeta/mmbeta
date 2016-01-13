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
    <main id="main" class="site-main" role="main">

    <?php while ( have_posts() ) : the_post(); ?>

      <?php get_template_part( 'template-parts/content', 'preistraeger' ); ?>


      <?php
        // If comments are open or we have at least one comment, load up the comment template.
        if ( comments_open() || get_comments_number() ) :
          comments_template();
        endif;
      ?>

    <?php endwhile; // End of the loop. ?>

    </main><!-- #main -->

        <!-- Other winners' cards -->
     <?php
      rewind_posts();
      $query = new WP_Query( array(
        'posts_per_page' => -1,
        'post_type' => 'preistraeger',
        'meta_key' => 'nachname',
        'orderby' => 'meta_value',
        'order' => 'ASC',
      ) );

      if ($query->have_posts()): ?>
        <div id="carousel-example-generic" class="carousel slide col-lg-8 col-lg-offset-1" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
          </ol>
          <div class="carousel-inner" role="listbox">
          <?php while ($query->have_posts()): $query->the_post();?>
            <div class="carousel-item active">
              <article class="card col-xs-12 col-md-6">  
                <?php if (has_post_thumbnail()) : ?>
                <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' ); ?>
                <img class="card-img-top" src="<?php echo $image[0]; ?>" alt="<?php the_title() ?>">
                <?php endif; ?>
                <div class="card-block">
                  <h4 class="card-title"><?php the_title(); ?></h4>
                  <p class="card-text"><?php the_content(); ?></p>
                  <a href="<?php the_permalink(); ?>" class="btn btn-primary">Fragebogen</a>
                </div>
              </article>
            </div>
          <?php endwhile;?>
          </div>
          <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="icon-prev" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="icon-next" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
    <?php else: ?>
      <?php echo "no Preisträger yet" ;?>
    <?php endif;?>

  </div><!-- #primary -->

<?php get_footer(); ?>