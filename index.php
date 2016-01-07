<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package medium_magazin_beta
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php 
		$my_query = new WP_Query( 'category_name=featured&posts_per_page=1' ); 
		if ( have_posts() ) : 
		
			while ( $my_query->have_posts() ) : $my_query->the_post(); 
				$do_not_duplicate = $post->ID; ?>

					<div class="jumbotron col-xs-12 featured-area">
					  <h1 class="display-3"><?php the_title(); ?></h1>
					  <p class="lead"><?php the_excerpt(); ?></p>
					  <hr class="m-y-md">
					  <p class="lead">
					    <?php $value = get_field( "link" ); ?>
					    <a class="btn btn-primary btn-lg" href="<?php $value ? print $value : the_permalink(); ?>" role="button">Learn more</a>
					  </p>
					</div>
			<?php 
			endwhile; ?>
			<div class="col-xs-12 col-md-8">
			<?php 
			if ( have_posts() ) : while ( have_posts() ) : the_post(); 
				if ( $post->ID == $do_not_duplicate ) continue;
						get_template_part( 'template-parts/content', get_post_format() );
					
			endwhile; endif; 

				 the_posts_navigation(); 

		 else : 
		 	get_template_part( 'template-parts/content', 'none' );
		 endif; ?>
		 </div>
		</main><!-- #main -->
		<div class="col-xs-12 col-md-4">
			<?php get_sidebar(); ?>
		</div>
	</div><!-- #primary -->


<div class="col-xs-12">
	<?php get_footer(); ?>
</div>