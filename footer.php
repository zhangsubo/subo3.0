<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package subo2017
 */
?>
<footer>
    <hr>
    <div class="row text-center">
        <div class="sns-link">
            <ul>
                <li>
                    <a href="<?php the_field('subo_weibo','option'); ?>" target="_blank">
                        <span class="fa-stack fa-2x">
                            <i class="fa fa-circle fa-stack-2x"></i>
                            <i class="fa fa-weibo fa-stack-1x fa-inverse"></i>
                        </span>
                    </a>
                </li>
                <li>
                    <a class="weixin" href="javascript:void(0);">
                        <span class="fa-stack  fa-2x">
                            <i class="fa fa-circle fa-stack-2x"></i>
                             <i class="fa fa-wechat fa-stack-1x fa-inverse"></i>
                        </span>
                    </a>
                </li>
                <li>
                    <a href="<?php the_field('subo_github','option')?>" target="_blank">
                        <span class="fa-stack fa-2x">
                            <i class="fa fa-circle fa-stack-2x"></i>
                            <i class="fa fa-github fa-stack-1x fa-inverse"></i>
                        </span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="copyright">
        Copyright@<?php $website=home_url( );echo str_replace('http://', '', $website)." ".date('Y'); ?>
        <?php if(get_field('subo_icp','option')): ?>
        <div class="icp"><a href="http://www.miitbeian.gov.cn/" rel="nofollow"><?php the_field('subo_icp','option');?></a></div><?php endif ?>
    </div>
    <div class="overlay"></div>
        <div class="weixindiag">
            <a class="weixinclose"></a>
            <img src="<?php the_field('subo_wechat','option') ?>" alt="" />
    </div>
</footer>
<?php wp_footer(); ?>

</body>
</html>

