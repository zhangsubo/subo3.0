<?php
/**
 * 定义the_slug函数
 */
function the_slug() {
    $post_data = get_post($post->ID, ARRAY_A);
    $slug = $post_data['post_name'];
    return $slug;
}
?>
