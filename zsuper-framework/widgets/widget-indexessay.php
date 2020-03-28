<?php
/**
 * Name:zsuper_mayi分类目录小工具
 * Date:20160608
 * Version:1.0
 * Description:用来显示分类目录，时间原因，暂未开放自定义设置项
 */
class zsuper_mayi_widget_indexeassy extends WP_Widget {
 
    public function __construct() {
        $widget_ops = array(
            'classname' => 'zsuper_widget_indexeassy',
            'description' => __( 'zsuper_mayi首页新闻' ),
            'customize_selective_refresh' => true,
        );
        parent::__construct( 'zs_indexeassy', __( '首页新闻(zsuper)' ), $widget_ops );
    }
     function form( $instance ) {
        /**
         * 后台设置选项
         */
        if($instance[ 'post1' ]== null){
            $instance = wp_parse_args( (array) $instance, array(
            'post1'     => '',
            'algin'     => 'left',
            'logo_url'  => '',
            'content'   => ''
        ) );
        }
        $post1 = $instance[ 'post1' ];
        $post2 = $instance[ 'post2' ];
        $post3 = $instance[ 'post3' ];
    // markup for form ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'post1' ); ?>">文章1:</label>
            <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'post1' ); ?>" name="<?php echo $this->get_field_name( 'post1' ); ?>" value="<?php echo esc_attr( $post1 ); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'post2' ); ?>">文章2:</label>
            <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'post2' ); ?>" name="<?php echo $this->get_field_name( 'post2' ); ?>" value="<?php echo esc_attr( $post2 ); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'post3' ); ?>">文章3:</label>
            <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'post3' ); ?>" name="<?php echo $this->get_field_name( 'post3' ); ?>" value="<?php echo esc_attr( $post3 ); ?>">
        </p>
    <?php
    }
 
    function update( $new_instance, $old_instance ) {

        $instance = $old_instance;

        $instance['post1']      = strip_tags( $new_instance['post1'] );
        $instance['post2']      = strip_tags( $new_instance['post2'] );
        $instance['post3']      = strip_tags( $new_instance['post3'] );

        return $instance;

    }
 
    function widget( $args, $instance ) {?>

        <div class="news w">
    <h2><img src="<?php bloginfo('template_directory' ); ?>/image/text_1.png" alt=""></h2>
    <ul class="clear">
    <?php 
    /**
         * The WordPress Query class.
         * @link http://codex.wordpress.org/Function_Reference/WP_Query
         *
         */
        $args = array(
            
            'ignore_sticky_posts' => 1,
            'post__in'             => array($instance['post1'],$instance['post2'],$instance['post3'])
            
            
        );
    
    $my_query = new WP_Query( $args );
    
    if ($my_query->have_posts()) : while ( $my_query->have_posts() ) : $my_query->the_post(); ?>
      <li class="mlr5">
        <a href="<?php esc_url(the_permalink()); ?>">
          <?php if ( has_post_thumbnail() ) : ?>
            <?php the_post_thumbnail( array(380,250) ); ?>
          <?php else: ?>
            <img src="<?php bloginfo('template_directory' ); ?>/image/img_8.png" alt="<?php the_title(); ?>">
          <?php endif; ?>
          <span class="title"><?php echo mb_strimwidth(get_the_title(),0,40,'');?></span>
          <span class="content"><?php echo mb_strimwidth(get_the_content(),0,150,''); ?></span>
        </a>
      </li>
   <?php 
    endwhile;
    endif;
    wp_reset_postdata();?>
    </ul></div>
    <?php
    }
}
function zsuper_register__widget_indexeassy() {
 
    register_widget( 'zsuper_mayi_widget_indexeassy' );
 
}
add_action( 'widgets_init', 'zsuper_register__widget_indexeassy' );
?>