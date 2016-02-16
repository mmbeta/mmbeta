<?php
/**
 * Preistraeger Übersicht.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package medium_magazin_beta
 */
?>
<div class="row m-t m-b">
  <header class="col-xs-12">
    <h1 class="page-title"><?php echo single_cat_title('', false); ?></h1>
    <div class="lead"><?php the_archive_description();?></div>
  </header><!-- .page-header -->
</div>
<?php
$kategorie = mmbeta_die_preiskategorie_object();
$args = array(
    'post_type' => 'preistraeger',
    'tax_query' => array(
      array(
        'taxonomy' => 'preise',
        'field'    => 'slug',
        'terms'    => $kategorie->slug,
      ),
    ),
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
              <li class="list-group-item bg-primary-faded"><strong>Platz:</strong> <?php the_field('platz'); ?></li>
              <li class="list-group-item"><strong>Kategorie:</strong> <?php mmbeta_die_preiskategorie(); ?></li>
            </ul>
            <div class="card-block">
              <a href="<?php the_permalink(); ?>" class="btn btn-secondary">Begründung</a>  
            </div>  
          </article>
      
      <?php endwhile;?>
  </div>
<?php endif;?>