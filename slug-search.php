<?php
/*
Plugin Name: Slug Search
Description: A plugin that allows you to search posts/pages/post_types by slug inside /wp-admin area.
Version: 1.0
Author: Alex
*/

function slug_search_admin_modify_query( $query ) {
    if ( ! is_admin() ) {
        return;
    }

    $slug_search = '';
    $search = $query->get( 's' );

    if ( ! empty( $search ) && substr( $search, 0, 5 ) === 'slug:' ) {
        $slug_search = substr( $search, 5 );
        $query->set( 's', '' );
    }

    if ( ! empty( $slug_search ) ) {
        $query->set( 'post_name__in', array( $slug_search ) );
    }
}
add_action( 'pre_get_posts', 'slug_search_admin_modify_query' );