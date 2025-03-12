<?php
/**
 * 主题选项配置文件
 *
 * 包含 ACF 设置
 *
 * @package subo2017
 */

// ACF 路径设置
add_filter('acf/settings/path', 'my_acf_settings_path');
function my_acf_settings_path($path) {
    return OPTION_DIR;
}

// ACF 目录设置
add_filter('acf/settings/dir', 'my_acf_settings_dir');
function my_acf_settings_dir($dir) {
    return OPTION_URL;
}

// 隐藏 ACF 字段组菜单项
// add_filter('acf/settings/show_admin', '__return_false');

// 引入 ACF 核心文件
include_once(OPTION_DIR . '/acf.php');

/**
 * 创建主题设置页面
 */
if (function_exists('acf_add_options_page')) {
    acf_add_options_page(array(
        'page_title'    => '主题设置',
        'menu_title'    => '主题设置',
        'menu_slug'     => 'theme-general-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));
}

/**
 * 设置默认特色图片
 */
add_filter('post_thumbnail_html', 'my_post_thumbnail_html');
function my_post_thumbnail_html($html) {
    if (empty($html)) {
        $html = sprintf(
            '<img src="%s/images/default-thumbnail.png" alt="%s" />',
            get_stylesheet_directory_uri(),
            esc_attr__('默认特色图片', 'subo')
        );
    }
    return $html;
}
if( function_exists('acf_add_local_field_group') ):

    acf_add_local_field_group(array (
        'key' => 'group_67d13b355ab5e',
        'title' => '关于我设置',
        'fields' => array (
            array (
                'tabs' => 'all',
                'toolbar' => 'full',
                'media_upload' => 1,
                'default_value' => '张小璋，野蛮生长成世界500强企业供应链金融产品经理的法语毕业生。微信公众号： iamzhangsubo。一直在互联网金融公司从事产品经理工作并负责互联网金融产品线，深耕互联网金融和区块链领域。「PMCAFF」、「人人都是产品经理」专栏作家、「PmTalk」签约作家。',
                'delay' => 0,
                'key' => 'field_67d13b3f3a9fc',
                'label' => '关于我设置',
                'name' => 'field_about_me_content',
                'type' => 'wysiwyg',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'theme-general-settings',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => 1,
        'description' => '',
    ));
    
    acf_add_local_field_group(array (
        'key' => 'group_588f570b83a5b',
        'title' => '底部设置',
        'fields' => array (
            array (
                'default_value' => 'https://weibo.com/zhangsubo',
                'maxlength' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'key' => 'field_58916b1cea91c',
                'label' => '微博',
                'name' => 'subo_weibo',
                'type' => 'text',
                'instructions' => '个人微博地址：例如：https://weibo.com/zhangsubo',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
            ),
            array (
                'return_format' => 'url',
                'preview_size' => 'full',
                'library' => 'all',
                'min_width' => '',
                'min_height' => '',
                'min_size' => '',
                'max_width' => '',
                'max_height' => '',
                'max_size' => '',
                'mime_types' => 'jpg,png',
                'key' => 'field_58916b67ea91d',
                'label' => '微信',
                'name' => 'subo_wechat',
                'type' => 'image',
                'instructions' => '请上传微信二维码，尺寸235X235',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
            ),
            array (
                'default_value' => 'https://github.com/zhangsubo',
                'maxlength' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'key' => 'field_58916bcfea91e',
                'label' => 'Github',
                'name' => 'subo_github',
                'type' => 'text',
                'instructions' => 'github地址，例如：https://github.com/zhangsubo',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
            ),
            array (
                'default_value' => '',
                'maxlength' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'key' => 'field_5891f02daab26',
                'label' => 'ICP备案号',
                'name' => 'subo_icp',
                'type' => 'text',
                'instructions' => '请填写网站ICP备案号，无ICP备案可不填写',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
            ),
            array (
                'default_value' => '',
                'maxlength' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'key' => 'field_5897cca7f3cfe',
                'label' => '底部广告',
                'name' => 'subo_ad',
                'type' => 'text',
                'instructions' => '广告位置',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'theme-general-settings',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => 1,
        'description' => '',
    ));
    
    endif;

?>
