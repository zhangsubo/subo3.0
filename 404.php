<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package subo2017
 */

get_header(); ?>

	<section class="content-area">

				<div class="subo-404 text-center">
					<p><img src="<?php bloginfo('template_url') ?>/images/not-found.png" alt=""></p>
					<p><span class="timeShow" id="timers">3</span>秒后将返回<a href="<?php bloginfo('url') ?>" style="color:#abcdef;text-decoration:underline;">首页</a></p>
				</div>

	</section><!-- #primary -->
	<script language="javascript" type="text/javascript">
		var i = 3;
		var intervalid;
		intervalid = setInterval("fun()", 1000);
		function fun() {
		if (i == 0) {
		window.location.href = "/";
		clearInterval(intervalid);
		}
		document.getElementById("timers").innerHTML = i;
		i--;
		}
	</script>
<?php
get_footer();
