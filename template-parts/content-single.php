<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package medium_magazin_beta
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h3 class="entry-title">', '</h3>' ); ?>

		<div class="entry-meta">
			<?php mmbeta_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="lead">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<small class="page-links">' . esc_html__( 'Pages:', 'mmbeta' ),
				'after'  => '</small>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php mmbeta_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->

