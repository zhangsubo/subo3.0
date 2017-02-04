<?php
/**
 * Name:zsuper_mayi活动公告
 * Date:20160608
 * Version:1.0
 * Description:用来显示活动公告
 */
class zsuper_mayi_widget_notice extends WP_Widget {
 
    public function __construct() {
    	$widget_ops = array(
			'classname' => 'zsuper_widget_notice',
			'description' => __( 'zsuper_mayi活动公告' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'zs_notice', __( '活动公告(zsuper)' ), $widget_ops );
    }
 
    function form( $instance ) { 
    	$defaults = array(
        'img1' => 'http://cdn.zhangsubo.cn/wp-content/themes/TBUed/images/top1.png',
        'img2' => 'http://cdn.zhangsubo.cn/wp-content/themes/TBUed/images/top1.png',
        'web1' => 'http://zhangsubo.cn',
        'web2' => 'http://zhangsubo.cn'
    );
    $img1 = $instance[ 'img1' ];
    $img2 = $instance[ 'img2' ];
    $web1 = $instance[ 'web1' ];
    $web2 = $instance[ 'web2' ];
    // markup for form ?>
    <p>注意：图片地址和活动地址都需要包括"http://",图片大小为270*120,圆角会更好看<br/>如有问题请联系<a href="http://zhangsubo.cn" traget="_blank">张小璋</a></p>
    <p>
        <label for="<?php echo $this->get_field_id( 'img1' ); ?>">活动1banner:</label>
        <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'img1' ); ?>" name="<?php echo $this->get_field_name( 'img1' ); ?>" value="<?php echo esc_attr( $img1 ); ?>">
    </p>
    <p>
        <label for="<?php echo $this->get_field_id( 'web1' ); ?>">活动1地址:</label>
        <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'web1' ); ?>" name="<?php echo $this->get_field_name( 'web1' ); ?>" value="<?php echo esc_attr( $web1 ); ?>">
    </p>
    <p>
        <label for="<?php echo $this->get_field_id( 'img2' ); ?>">活动2banner:</label>
        <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'img2' ); ?>" name="<?php echo $this->get_field_name( 'img2' ); ?>" value="<?php echo esc_attr( $img2 ); ?>">
    </p>
    <p>
        <label for="<?php echo $this->get_field_id( 'web2' ); ?>">活动2地址:</label>
        <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'web2' ); ?>" name="<?php echo $this->get_field_name( 'web2' ); ?>" value="<?php echo esc_attr( $web2 ); ?>">
    </p>
    <?
    }
 
    function update( $new_instance, $old_instance ) { 
    	$instance = $old_instance;
    	$instance[ 'img1' ] = strip_tags( $new_instance[ 'img1' ] );
    	$instance[ 'img2' ] = strip_tags( $new_instance[ 'img2' ] );
    	$instance[ 'web1' ] = strip_tags( $new_instance[ 'web1' ] );
    	$instance[ 'web2' ] = strip_tags( $new_instance[ 'web2' ] );
        return $instance;
    }
 
    function widget( $args, $instance  ) {
 	?>
 	<!-- 活动公告开始 -->
    	<div class="catalog clear">
      		<p>活动公告</p>
      		<div class="img">
      		<a href="<?php echo $instance['web1']; ?>"><img src="<?php echo $instance['img1']; ?>"></a>
      		</div>
      		<div class="img">
      		<a href="<?php echo $instance['web2']; ?>"><img src="<?php echo $instance['img2']; ?>"></a>
      		</div>
    	</div>
    <!-- 活动公告结束 -->
    <?php }
 
}
function zsuper_mayi_register__widget_notice() {
 
    register_widget( 'zsuper_mayi_widget_notice' );
 
}
add_action( 'widgets_init', 'zsuper_mayi_register__widget_notice' );
?>