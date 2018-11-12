<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package medium_magazin_beta
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>
			<div class="row">
				<header class="page-header col-12 p-3 mb-4 text-center" style="background-color: <?php echo mmbeta_color('petrol'); ?>">

				<h1 class="page-title"><?php printf( esc_html__( 'Suchergebnisse für: %s', 'mmbeta' ), '<span>' . get_search_query() . '</span>' ); ?></h1>

				</header><!-- .page-header -->
			</div>
      <div class="d-flex justify-content-center flex-row flex-wrap">
			
      <?php while ( have_posts() ) : the_post(); ?>

        <article class="container col-12 col-md-10 col-lg-8 d-flex flex-row flex-wrap justify-content-center">
          <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' ); ?>

            <?php if ($image): ?>
            <div class="col-12 col-md-4 d-flex justify-content-center">
              <a class="img-link" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                <figure class="figure">
                  <?php echo wp_get_attachment_image(get_post_thumbnail_id( $post->ID ), 'cover', false, array('class' => 'img-responsive figure-img') ); ?>
                </figure>
              </a>
            </div>
            <?php endif; ?>

            <div class="col-12 col-md-8">
              <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                <h2><?php the_title(); ?></h2>
              </a>
              <div class="lead"><?php the_excerpt(); ?></div>
            </div>

        </article> 

			<?php endwhile; ?>

    </div>

		<?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>


		</main><!-- #main -->
	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
