<?php
function zsuper_paging_nav(){
	global $wp_query;

	$big = 999999999; // 需要一个不太可能的整数

	$pagination_links = paginate_links( array(
			'base'         => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),//用来参考网址
			'format'       => '?page=%#%',//用于URL分页结构
			'total'        => $wp_query->max_num_pages,//总页数
	        'current'      => max( 1, get_query_var('paged') ),//当前页码
			'show_all'     => False,//是否显示默认值是false，如果设置为true，那么将显示所有的可用页码
			'end_size'     => 1,//页面显示在列表的末尾号
			'mid_size'     => 2,//多少个数字到当前页面的两侧，但不包括当前页面
			'prev_next'    => True,//布尔值，是否包含上一页和下一页的链接
			'prev_text'    => __('« Previous'),//前一页的文字。只有当’prev_next’参数设置为true
			'next_text'    => __('Next »'),//下一页的文字。只有当’prev_next’参数设置为true
			'type'         => 'plain',//定义该函数返回什么，plain, array 或 list
			'add_args'     => False,//添加查询字符串参数到链接
			'add_fragment' => '',//添加文本追加到每个链接
			//'before_page_number' => '<span class="screen-reader-text">'.$translated.' </span>'，// 在页码前显示的字符串
			'after_page_number' => ''//在页码后显示的字符串
	) );

echo $pagination_links;
}
?>
