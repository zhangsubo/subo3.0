<?php 



//将文中的链接全部转换成脚注
function convert_links_to_footnotes($content) {
    // 匹配文章中的链接
    preg_match_all('/<a href="([^"]+)">([^<]+)<\/a>/i', $content, $matches);

    // 初始化脚注数组
    $footnotes = array();

    // 替换链接为脚注编号
    foreach ($matches[0] as $key => $match) {
        // 获取链接和链接文本
        $url = $matches[1][$key];
        $link_text = $matches[2][$key];

        // 将链接替换为脚注编号
        $content = str_replace($match, $link_text . '[^' . ($key + 1) . ']', $content);

        // 添加脚注到数组
        $footnotes[] = htmlspecialchars($link_text) . ': ' . htmlspecialchars($url);
    }

    // 添加脚注列表到文章末尾
    if (!empty($footnotes)) {
        $content .= '<h2>References</h2><ol>';
        foreach ($footnotes as $key => $footnote) {
            $content .= '<li id="fn-' . ($key + 1) . '">' . $footnote . ' <a href="#fnref-' . ($key + 1) . '" class="reversefootnote">&#160;&#8617;&#xFE02;</a></li>';
        }
        $content .= '</ol>';
    }

    return $content;
}

// 将函数添加到WordPress的the_content过滤器
add_filter('the_content', 'convert_links_to_footnotes');



 ?>