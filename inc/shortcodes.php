<?php
/**
 * Custom Shortcodes.
 *
 * @package medium_magazin_beta
 */


function owl_gallery_shortcode( $attr ) {
  $post = get_post();

  static $instance = 0;
  $instance++;

  if ( ! empty( $attr['ids'] ) ) {
    // 'ids' is explicitly ordered, unless you specify otherwise.
    if ( empty( $attr['orderby'] ) ) {
      $attr['orderby'] = 'post__in';
    }
    $attr['include'] = $attr['ids'];
  }

  /**
   * Filter the default gallery shortcode output.
   *
   * If the filtered output isn't empty, it will be used instead of generating
   * the default gallery template.
   *
   * @since 2.5.0
   * @since 4.2.0 The `$instance` parameter was added.
   *
   * @see gallery_shortcode()
   *
   * @param string $output   The gallery output. Default empty.
   * @param array  $attr     Attributes of the gallery shortcode.
   * @param int    $instance Unique numeric ID of this gallery shortcode instance.
   */
  $output = apply_filters( 'owl_post_gallery', '', $attr, $instance );
  if ( $output != '' ) {
    return $output;
  }


  $atts = shortcode_atts( array(
    'order'      => 'ASC',
    'orderby'    => 'menu_order ID',
    'id'         => $post ? $post->ID : 0,
    'itemtag'    => 'figure',
    'icontag'    => 'div',
    'captiontag' => 'figcaption',
    'columns'    => 3,
    'size'       => 'large',
    'include'    => '',
    'exclude'    => '',
    'link'       => ''
  ), $attr, 'gallery' );

  $id = intval( $atts['id'] );

  if ( ! empty( $atts['include'] ) ) {
    $_attachments = get_posts( array( 'include' => $atts['include'], 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );

    $attachments = array();
    foreach ( $_attachments as $key => $val ) {
      $attachments[$val->ID] = $_attachments[$key];
    }
  } elseif ( ! empty( $atts['exclude'] ) ) {
    $attachments = get_children( array( 'post_parent' => $id, 'exclude' => $atts['exclude'], 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );
  } else {
    $attachments = get_children( array( 'post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );
  }

  if ( empty( $attachments ) ) {
    return '';
  }

  if ( is_feed() ) {
    $output = "\n";
    foreach ( $attachments as $att_id => $attachment ) {
      $output .= wp_get_attachment_link( $att_id, $atts['size'], true ) . "\n";
    }
    return $output;
  }

  $itemtag = tag_escape( $atts['itemtag'] );
  $captiontag = tag_escape( $atts['captiontag'] );
  $icontag = tag_escape( $atts['icontag'] );


  $columns = intval( $atts['columns'] );
  $itemwidth = $columns > 0 ? floor(100/$columns) : 100;
  $float = 'left';

  $selector = "gallery-{$instance}";

  $gallery_style = '';

  $size_class = sanitize_html_class( $atts['size'] );
  $gallery_div = "<div id='owl-gallery' class='gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class} owl-carousel'>";

  /**
   * Filter the default gallery shortcode CSS styles.
   *
   * @since 2.5.0
   *
   * @param string $gallery_style Default CSS styles and opening HTML div container
   *                              for the gallery shortcode output.
   */
  $output = apply_filters( 'gallery_style', $gallery_style . $gallery_div );

  $i = 0;
  foreach ( $attachments as $id => $attachment ) {

    $image_meta  = wp_get_attachment_metadata( $id );
    $credit = trim($image_meta[image_meta][credit]) ? '&#169; ' . $image_meta[image_meta][credit] : "";

    $attr = ( trim( $attachment->post_excerpt ) ) ? array( 'aria-describedby' => "$selector-$id" ) : '';
    if ( ! empty( $atts['link'] ) && 'file' === $atts['link'] ) {
      $image_output = wp_get_attachment_link( $id, $atts['size'], false, false, false, $attr );
    } elseif ( ! empty( $atts['link'] ) && 'none' === $atts['link'] ) {
      $image_output = wp_get_attachment_image( $id, $atts['size'], false, $attr );
    } else {
      $image_output = wp_get_attachment_link( $id, $atts['size'], true, false, false, $attr );
    }
    

    $orientation = '';
    if ( isset( $image_meta['height'], $image_meta['width'] ) ) {
      $orientation = ( $image_meta['height'] > $image_meta['width'] ) ? 'portrait' : 'landscape';
    }
    $output .= "<{$itemtag} class='gallery-item'>";
    $output .= "
      <{$icontag} class='gallery-icon {$orientation}'>
        $image_output
      </{$icontag}>";
    if ( $captiontag && trim($attachment->post_excerpt) ) {
      $output .= "
        <{$captiontag} class='figure-caption' id='$selector-$id'>
        " . wptexturize($attachment->post_excerpt) . "<br><small>" . $credit .  "</small>" .
        "</{$captiontag}>";
    }
    $output .= "</{$itemtag}>";

  }


  $output .= "
    </div>\n";

  $output .= "
    <script type='text/javascript'>
      jQuery(document).ready(function(){
        if(jQuery('#owl-gallery').length > 0){
          jQuery('#owl-gallery').owlCarousel({
            navigation : true,
            slideSpeed : 300,
            paginationSpeed : 400,
            singleItem:true,
            autoHeight : true
          });    
        }
      });
    </script>
  ";

  return $output;
}
add_shortcode('owl-gallery', 'owl_gallery_shortcode');

/////////////////////////////////////
//                               ///
// list-gallery-shortcode /////////
//                             ///  
/////////////////////////////////

add_shortcode('list-gallery', 'list_gallery_shortcode');

function list_gallery_shortcode( $attr ) {
  $post = get_post();

  static $instance = 0;
  $instance++;

  if ( ! empty( $attr['ids'] ) ) {
    // 'ids' is explicitly ordered, unless you specify otherwise.
    if ( empty( $attr['orderby'] ) ) {
      $attr['orderby'] = 'post__in';
    }
    $attr['include'] = $attr['ids'];
  }

  $atts = shortcode_atts( array(
    'order'      => 'ASC',
    'orderby'    => 'menu_order ID',
    'id'         => $post ? $post->ID : 0,
    'itemtag'    => 'figure',
    'icontag'    => 'div',
    'captiontag' => 'figcaption',
    'columns'    => 3,
    'size'       => 'preview',
    'second-size' => 'large',
    'include'    => '',
    'exclude'    => '',
    'link'       => 'file'
  ), $attr, 'gallery' );

  $id = intval( $atts['id'] );

  if ( ! empty( $atts['include'] ) ) {
    $_attachments = get_posts( array( 'include' => $atts['include'], 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );

    $attachments = array();
    foreach ( $_attachments as $key => $val ) {
      $attachments[$val->ID] = $_attachments[$key];
    }
  } elseif ( ! empty( $atts['exclude'] ) ) {
    $attachments = get_children( array( 'post_parent' => $id, 'exclude' => $atts['exclude'], 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );
  } else {
    $attachments = get_children( array( 'post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );
  }

  if ( empty( $attachments ) ) {
    return '';
  }

  if ( is_feed() ) {
    $output = "\n";
    foreach ( $attachments as $att_id => $attachment ) {
      $output .= wp_get_attachment_link( $att_id, $atts['size'], true ) . "\n";
    }
    return $output;
  }

  $itemtag = tag_escape( $atts['itemtag'] );
  $captiontag = tag_escape( $atts['captiontag'] );
  $icontag = tag_escape( $atts['icontag'] );
  $columns = intval( $atts['columns'] );
  $itemwidth = $columns > 0 ? floor(100/$columns) : 100;
  $float = 'left';

  $selector = "gallery-{$instance}";

  $gallery_style = '';


  $size_class = sanitize_html_class( $atts['size'] );
  $gallery_div = "<div id='$selector' class='row gallery-columns-{$columns} gallery-size-{$size_class}'>";


  $i = 0;
  $iterator = 0;
  foreach ( $attachments as $id => $attachment ) {
    $iterator++;
    $attr = ( trim( $attachment->post_excerpt ) ) ? array( 'aria-describedby' => "$selector-$id", 'data-imgcount' => "$iterator" ) : array( 'data-imgcount' => "$iterator" );
    if ( ! empty( $atts['link'] ) && 'file' === $atts['link'] ) {
      $image_output = wp_get_attachment_link( $id, $atts['size'], false, false, false, $attr );
    } elseif ( ! empty( $atts['link'] ) && 'none' === $atts['link'] ) {
      $image_output = wp_get_attachment_image( $id, $atts['size'], false, $attr );
    } else {
      $image_output = wp_get_attachment_link( $id, $atts['size'], true, false, false, $attr );
    }
    $image_meta  = wp_get_attachment_metadata( $id );

    $orientation = '';
    if ( isset( $image_meta['height'], $image_meta['width'] ) ) {
      $orientation = ( $image_meta['height'] > $image_meta['width'] ) ? 'portrait' : 'landscape';
    }
    $column_to_grid = 12/$columns;
    $output .= "<{$itemtag} class='gallery-item col-xs-12 col-lg-{$column_to_grid}'>";
    $output .= "
      <{$icontag} class='gallery-icon {$orientation}'>
        $image_output
      </{$icontag}>";
    if ( $captiontag && trim($attachment->post_excerpt) ) {
      $output .= "
        <{$captiontag} class='wp-caption-text gallery-caption' id='$selector-$id'>
        " . wptexturize($attachment->post_excerpt) . "
        </{$captiontag}>";
    }
    $output .= "</{$itemtag}>";
  }

  $output .= '</div><div class="modal fade" id="galleryModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"><div class="modal-dialog" role="document">' .
      '<div class="modal-content">' .
        '<div class="modal-header">' .
          '<button type="button" class="close" data-dismiss="modal" aria-label="Close">' .
            '<span aria-hidden="true">&times;</span>' .
          '</button>' .
          '<h4 class="modal-title" id="myModalLabel">' . get_the_title() . '</h4>' .
        '</div>' .
        '<div id="owl-carousel-single" class="modal-body owl-carousel">';

  // Gallery Modal

  $iterator = 0;
  foreach ( $attachments as $id => $attachment ) {
    $image_meta  = wp_get_attachment_metadata( $id );
    $credit = trim($image_meta[image_meta][credit]) ? '&#169; ' . $image_meta[image_meta][credit] : "";
    $iterator++;
    $attr = ( trim( $attachment->post_excerpt ) ) ? array( 'aria-describedby' => "$selector-$id", 'data-imgcount' => "$iterator", 'class' => 'figure-img' ) : array( 'data-imgcount' => "$iterator", 'class' => 'figure-img'  );
    if ( ! empty( $atts['link'] ) && 'file' === $atts['link'] ) {
      $image_output = wp_get_attachment_link( $id, $atts['second-size'], false, false, false, $attr );
    } elseif ( ! empty( $atts['link'] ) && 'none' === $atts['link'] ) {
      $image_output = wp_get_attachment_image( $id, $atts['second-size'], false, $attr );
    } else {
      $image_output = wp_get_attachment_link( $id, $atts['second-size'], true, false, false, $attr );
    }
    $image_meta  = wp_get_attachment_metadata( $id );

    $orientation = '';
    if ( isset( $image_meta['height'], $image_meta['width'] ) ) {
      $orientation = ( $image_meta['height'] > $image_meta['width'] ) ? 'portrait' : 'landscape';
    }
   
    $output .= "<{$itemtag} class='figure'>";
    $output .= "
      <{$icontag} class='gallery-icon {$orientation}'>
        $image_output
      </{$icontag}>";
    if ( $captiontag && trim($attachment->post_excerpt) ) {
      $output .= "
        <{$captiontag} class='wp-caption-text gallery-caption' id='$selector-$id'>
        " . wptexturize($attachment->post_excerpt) . "<br><small>" . $credit .  "</small>" .
        "</{$captiontag}>";
    }
    $output .= "</{$itemtag}>";
  }

  $output .= "
    </div></div></div></div></div>"; 

  ?>


  <?php
  return $output;
}

////////////////////////////
// Owl-Heads-Slider...   //
//////////////////////////

function heads_gallery_shortcode( $attr ) {

  if (!$attr['kategorie']) {
    $attr['kategorie'] = 'journalisten-des-jahres';
  }

  if (! $attr['farbe']) {
    $attr['farbe'] = 'grau';
  }

  if (!$attr['titel']) {
    $attr['titel'] =  get_term_by( 'slug', $attr['kategorie'] );
  }

  $bg_color = mmbeta_color( $attr['farbe'] );

  $args = array(
      'post_type' => 'preistraeger',
      'tax_query' => array(
        array(
          'taxonomy' => 'preise',
          'field'    => 'slug',
          'terms'    => $attr['kategorie'],
        ),
      ),
    );
  

  $output = "
    </div></div>
    <style>
    .heads-gallery-container {
      background-color: " . $bg_color . ";
    }
    .heads-gallery .item{
      padding: 30px 0px;
      margin: 5px;
      color: #FFF;
      -webkit-border-radius: 3px;
      -moz-border-radius: 3px;
      border-radius: 3px;
      text-align: center;
    }
    </style>
    <script type='text/javascript'>
      jQuery(document).ready(function(){
        if(jQuery('.heads-gallery').length > 0){
          jQuery('.heads-gallery').owlCarousel({
            items : 4,
            lazyLoad: true
          });    
        }
      });
    </script>
  ";


  $query = new WP_Query( $args );
  if ($query->have_posts()) :

    echo '<div class="row heads-gallery-container"><h6 class="heads-gallery-heading">' . $attr['titel']. '</h6><div class="heads-gallery">';

    while ( $query->have_posts() ) : $query->the_post();
      get_template_part( 'teasers/teaser', 'heads-gallery' );
    endwhile;
    echo $output;
  endif;
}
add_shortcode('heads-gallery', 'heads_gallery_shortcode');

////////////////////////////
// Owl-Cover-Slider...   //
//////////////////////////

function cover_gallery_shortcode( $attr ) {
  if ( !isset($attr['kategorie']) ) {
    $attr['kategorie'] = 'ausgabe';
  }
  if ( !isset($attr['titel']) ) {
    $attr['titel'] = 'Aktuelle Ausgaben';
  }
  if ( !isset($attr['farbe']) ) {
    $bg_color = 'transparent';
  }else{
    $bg_color = mmbeta_color( $attr['farbe'] );
  }

  $output = "<div class='cover-gallery'>";

  $query = new WP_Query( array( 'category_name' => $attr['kategorie']) ); 
    if ( $query->have_posts() ) : 
      while ( $query->have_posts() ) : $query->the_post();
      $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'cover' );
      $output .= "<a href='" . get_permalink() . "'><div class='item'>";
      $output .= "<img data-src='" . $image[0] . "' class='figure-img lazyOwl'>"; 
      $output .= "</div></a>";
      endwhile;
    endif;


  $output .= "
    </div>
    <style>
    .cover-gallery div.item{
      padding: 10px 0px;
      margin: 5px;
      color: #FFF;
      -webkit-border-radius: 3px;
      -moz-border-radius: 3px;
      border-radius: 3px;
      text-align: center;
    }

    </style>
    <script type='text/javascript'>
      jQuery(document).ready(function(){
        if(jQuery('.cover-gallery').length > 0){
          jQuery('.cover-gallery').owlCarousel({
            navigation : false,
            lazyLoad: true,
            itemsScaleUp:true,
            itemsCustom : [
                    [0, 1],
                    [450, 4],
                    [600, 6],
                    [800, 8],
                    [1000, 10],
                    [1200, 12],
                    [1400, 14],
                    [1600, 16]
            ]
          });    
        }
      });
    </script>
  ";

  return $output;
}
add_shortcode('cover-gallery', 'cover_gallery_shortcode');

// MM Showcase zum Heft bestellen
function mm_showcase_shortcode( $atts, $content = null ) {
  // Attributes
  $attributes = shortcode_atts(
    array(
      'ausgabe' => '01/2016',
      'epaper-kaufen' => 'https://www.newsroom.de/shop/einzelausgaben/medium-magazin/',
      'print-kaufen' => 'https://www.newsroom.de/shop/einzelausgaben/medium-magazin/',
      'abo-link' => 'https://www.newsroom.de/shop/abos/medium-magazin/',
      'teaser' => '',
      'untertitel' => '',
      'img-src' => '',
    ), 
  $atts );

  $image_noclass = preg_replace(
         "/thumbnail/", 
         "medium", 
         $content);

  $main_image_id =  mm_get_attachment_id_from_url($attributes['img-src']); 
  $main_image_path = wp_get_attachment_image_src( $main_image_id, 'full')[0];

  $output = '<div class="card showcase">';
    $output .= '<div class="card-block">';
      $output .= '<h4 class="card-title">' . $attributes['ausgabe'] . '</h4>';
      $output .= '<h6 class="card-subtitle text-muted">' . $attributes['untertitel'] . '</h6>';
    $output .= '</div>';
    $output .= '<img src="' . wp_get_attachment_image_src( $main_image_id, 'large')[0] . '" class="img-responsive popup" alt="' . $attributes['ausgabe'] . '" data-imgpath="' . $main_image_path . '" >';
    $output .= '<div class="card-block">';
    $output .= '<p class="card-text">' . $attributes['teaser'] . '</p>';

    $output .= '<div class="container">';
      $output .= '<div class="row">
        <a class="button-link" href="' . $attributes['print-kaufen'] . '">
          <button class="btn btn-secondary-outline btn-block showcase-button">
            Print kaufen
            <span class="dashicons dashicons-book"></span>
          </button>
        </a>
        <a class="button-link" href="' . $attributes['epaper-kaufen'] . '">
          <button class="btn btn-secondary-outline btn-block showcase-button">
            E-Paper kaufen
            <span class="dashicons dashicons-tablet"></span>
          </button>
        </a>
        <a class="button-link" href="' . $attributes['abo-link'] . '">
          <button class="btn btn-secondary-outline btn-block showcase-button">
            Abos
            <span class="dashicons dashicons-money"></span>
          </button>
        </a>
      </div>';
    $output .= '</div>';

    $output .= '</div>';

  $output .= '</div>';

  return $output;
}
add_shortcode( 'mmshowcase', 'mm_showcase_shortcode' );


//PDF embedding
function pdf_function($attr, $url) {
   extract(shortcode_atts(array(
       'width' => '100%',
       'height' => '480px'
   ), $attr));
   return '<iframe src="http://docs.google.com/viewer?url=' . $url . '&embedded=true" style="width:' .$width. '; height:' .$height. ';">Your browser does not support iframes</iframe>';
}
add_shortcode('pdf', 'pdf_function');

//Slide out more content

function show_more_function($attr, $content) {
   extract(shortcode_atts(array(
       'width' => '100%',
       'height' => '480px'
   ), $attr));
   $button = '<button type="button" class="btn btn-secondary btn-block m-b button-toggle" data-toggle="collapse" data-target="#collapsedContent" aria-expanded="false" aria-controls="collapsedContent" title="Klicken Sie hier, um weiteren Inhalt auszuklappen.">mehr</button>';
   $body = '<div class="collapse" id="collapsedContent">' . $content . '</div>';
   return $button . $body;
}
add_shortcode('more', 'show_more_function');

function iframe_shortcode($attr, $url) {

 $style = "<style type='text/css'>.embed-container { position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 100%; } .embed-container iframe, .embed-container object, .embed-container embed { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }</style>";

 $output = $style;
 $output .= "<div class='embed-container'><iframe src='";
 $output .= $url . "'";
 $output .= " allowfullscreen frameborder=0></iframe></div>";
 return $output;
}
add_shortcode('iframe', 'iframe_shortcode');