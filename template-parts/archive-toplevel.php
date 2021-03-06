  <div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
    
    <?php
      $taxonomy_name = get_query_var( 'taxonomy' );
      $term = get_term_by( 'slug', get_query_var( 'term' ), $taxonomy_name ); 
      $term_children = get_terms( $taxonomy_name, array('parent' => $term->term_id ) );
    ?>


      <div class="row">
        <header class="page-header col-12 m-b p-a text-center" style="background-color: <?php echo mmbeta_color('petrol'); ?>">
          <?php
            single_term_title( '<h1 class="page-title">', '</h1>' );
          ?>
        </header><!-- .page-header -->
        <div class="text-center">
          <?php
            the_archive_description( '<div class="taxonomy-description">', '</div>' );
          ?>
        </div>
      </div>
      <div class="row">
        <div class="col-12 text-center">
          <ul class="list-group">
          <?php
            foreach ( $term_children as $child ) {
              // $term_child = get_term_by( 'id', $child, $taxonomy_name );
              echo '<li class="list-group-item"><a href="' . get_term_link( $child, $taxonomy_name ) . '">' . $child->name . '</a></li>';
            }
          ?>
          </ul>
        </div>
      </div>



    </main><!-- #main -->
  </div><!-- #primary -->