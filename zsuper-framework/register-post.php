<?php
function subo_register_my_post_types() {

    /**
     * Post Type: 项目.
     */

    $labels = array(
        "name" => __( '项目', 'subo' ),
        "singular_name" => __( '项目', 'subo' ),
        "menu_name" => __( '我的项目', 'subo' ),
        "all_items" => __( '所有项目', 'subo' ),
        "add_new" => __( '添加新项目', 'subo' ),
        "add_new_item" => __( '添加新项目', 'subo' ),
        "edit_item" => __( '编辑项目', 'subo' ),
        "new_item" => __( '新项目', 'subo' ),
        "view_item" => __( '查看项目', 'subo' ),
        "view_items" => __( '查看项目', 'subo' ),
        "search_items" => __( '搜索项目', 'subo' ),
        "not_found" => __( '没有找到项目', 'subo' ),
        "not_found_in_trash" => __( '在废纸篓没有找到项目', 'subo' ),
    );

    $args = array(
        "label" => __( '项目', 'subo' ),
        "labels" => $labels,
        "description" => "这里是所有的项目",
        "public" => true,
        "publicly_queryable" => true,
        "show_ui" => true,
        "show_in_rest" => false,
        "rest_base" => "",
        "has_archive" => false,
        "show_in_menu" => true,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "rewrite" => array( "slug" => "project", "with_front" => true ),
        "query_var" => true,
        "supports" => array( "title", "editor", "thumbnail" ),
        "taxonomies" => array( "category", "post_tag" ),
    );

    register_post_type( "project", $args );
}

add_action( 'init', 'subo_register_my_post_types' );
//end
 ?>
