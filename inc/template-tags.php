<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package medium_magazin_beta
 */

if ( ! function_exists( 'mmbeta_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function mmbeta_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( 'Veröffentlicht am %s', 'post date', 'mmbeta' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		esc_html_x( 'von %s', 'post author', 'mmbeta' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'mmbeta_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function mmbeta_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'mmbeta' ) );
		if ( $categories_list && mmbeta_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'mmbeta' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'mmbeta' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'mmbeta' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( esc_html__( 'Leave a comment', 'mmbeta' ), esc_html__( '1 Comment', 'mmbeta' ), esc_html__( '% Comments', 'mmbeta' ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'mmbeta' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function mmbeta_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'mmbeta_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'mmbeta_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so mmbeta_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so mmbeta_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in mmbeta_categorized_blog.
 */
function mmbeta_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'mmbeta_categories' );
}
add_action( 'edit_category', 'mmbeta_category_transient_flusher' );
add_action( 'save_post',     'mmbeta_category_transient_flusher' );


function mm_menu( $theme_location ) {
    if ( ($theme_location) && ($locations = get_nav_menu_locations()) && isset($locations[$theme_location]) ) {
        $menu = get_term( $locations[$theme_location], 'nav_menu' );
        $menu_items = wp_get_nav_menu_items($menu->term_id);

        $menu_array = array();
        $menu_list = '<nav id="mainnav" class="navbar nav-inline col-lg-8 offset-lg-2 col-12 text-center" role="navigation"><div class="top-navi"><ul>';
        
        foreach( $menu_items as $menu_item ) {
            $menu_array[$menu_item->menu_item_parent][] = $menu_item->ID;
        }

        foreach( $menu_items as $menu_item ) {
   
            $link = $menu_item->url;
            $title = $menu_item->title;
            $has_children = isset($menu_array[$menu_item->ID]);
           	
          	// var_dump(  $menu_item->menu_item_parent > 0 and !$has_children );

            
            if ( !$has_children and $menu_item->menu_item_parent == 0 ) {
           		$menu_list .= "<li><a class='nav-link' href='" . $link . "'>" . $menu_item->title . "</a></li>";
            }

            if( $has_children ){
            	$menu_list .= "<li class='dropdown show'><a class='nav-link dropdown-toggle' data-toggle='dropdown' href='" . $link . "'>" . $menu_item->title . "</a>";



            	if ( isset($menu_array[$menu_item->ID]) ) {
            		$menu_list .= "<ul class='dropdown-menu'>";
	            	
	            	foreach ($menu_array[$menu_item->ID] as $menu_child_id) {
	            		$menu_child = wp_setup_nav_menu_item(get_post($menu_child_id));
	            		
	            		$menu_list .= "<a class='dropdown-item' href='" . $menu_child->url . "'>" . $menu_child->title . "</a>";
	            	}

	            	$menu_list .= "</ul>";

            	}

            	$menu_list .= "</li>";
            }
            
           
        }
        
        $menu_list .= "</ul>";


    } else {
        $menu_list = 'no menu defined in location "'.$theme_location.'"';
    }
    
    echo($menu_list);
}




function mm_menu_( $theme_location ) {
    if ( ($theme_location) && ($locations = get_nav_menu_locations()) && isset($locations[$theme_location]) ) {
        $menu = get_term( $locations[$theme_location], 'nav_menu' );
        $menu_items = wp_get_nav_menu_items($menu->term_id);
 
        $menu_list  = '<nav>' ."\n";
        $menu_list .= '<ul class="main-nav">' ."\n";
 
        $count = 0;
        $submenu = false;
         
        foreach( $menu_items as $menu_item ) {
             
            $link = $menu_item->url;
            $title = $menu_item->title;
            
            //has no parent
            if ( !$menu_item->menu_item_parent ) {
                $parent_id = $menu_item->ID;
                 
                $menu_list .= '<li class="item">' ."\n";
                $menu_list .= '<a href="'.$link.'" class="title">'.$title.'</a>' ."\n";
            }
 				


            if ( $parent_id == $menu_item->menu_item_parent ) {
 
                if ( !$submenu ) {
                    $submenu = true;
                    $menu_list .= '<ul class="sub-menu">' ."\n";
                }
 
                $menu_list .= '<li class="item">' ."\n";
                $menu_list .= '<a href="'.$link.'" class="title">'.$title.'</a>' ."\n";
                $menu_list .= '</li>' ."\n";
                     
 
                if ( $menu_items[ $count + 1 ]->menu_item_parent != $parent_id && $submenu ){
                    $menu_list .= '</ul>' ."\n";
                    $submenu = false;
                }
 
            }
 
            if ( $menu_items[ $count + 1 ]->menu_item_parent != $parent_id ) { 
                $menu_list .= '</li>' ."\n";      
                $submenu = false;
            }
 
            $count++;
        }
         
        $menu_list .= '</ul>' ."\n";
        $menu_list .= '</nav>' ."\n";
 
    } else {
        $menu_list = '<!-- no menu defined in location "'.$theme_location.'" -->';
    }
    echo $menu_list;
}
