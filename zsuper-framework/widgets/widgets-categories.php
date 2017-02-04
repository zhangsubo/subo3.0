<?php
/**
 * Name:zsuper_mayi分类目录小工具
 * Date:20160608
 * Version:1.0
 * Description:用来显示分类目录，时间原因，暂未开放自定义设置项
 */
class zsuper_mayi_widget_categories extends WP_Widget {
 
    public function __construct() {
    	$widget_ops = array(
			'classname' => 'zsuper_widget_categories',
			'description' => __( 'zsuper_mayi分类目录' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'zs_categories', __( '分类目录(zsuper)' ), $widget_ops );
    }
 
    function form( $instance ) { ?>
    	<p>未开放自定义选项,请联系<a href="http://zsuper.xyz" target="_blank">zsuper团队</a>或者联系<a href="http://www.zhangsubo.cn" target="_blank">张小璋</a>修改设置项。</p>
   <?php
    }
 
    function update( $new_instance, $old_instance ) {       
    }
 
    function widget( $args, $instance ) {
 			$categories_set = array(
 				'show_option_all'    => '',
				'orderby'            => 'name',
				'order'              => 'ASC',
				'style'              => 'list',
				'show_count'         => 1,
				'hide_empty'         => 1,
				'use_desc_for_title' => 1,
				'child_of'           => 0,
				'feed'               => '',
				'feed_type'          => '',
				'feed_image'         => '',
				'exclude'            => '',
				'exclude_tree'       => '',
				'include'            => '',
				'hierarchical'       => 1,
				'title_li'           => '',
				'show_option_none'   => __('No categories'),
				'number'             => null,
				'echo'               => 1,
				'depth'              => 0,
				'current_category'   => 0,
				'pad_counts'         => 0,
				'taxonomy'           => 'category',
				'walker'             => null 
				);//设置参考项http://www.wpdaxue.com/wp_list_categories.html
 			?>
 			<!-- 文章目录开始 -->
   				<div class="catalog clear">
    				<p>文章目录</p>
    				<ul>
        				<?php wp_list_categories($categories_set); ?>
    				</ul>
    			</div>
			<!-- 文章目录结束 -->
<?php
    }
 
}
function zsuper_mayi_register__widget_categories() {
 
    register_widget( 'zsuper_mayi_widget_categories' );
 
}
add_action( 'widgets_init', 'zsuper_mayi_register__widget_categories' );
?>