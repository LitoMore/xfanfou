<?php
// 获取消息中的所有@
if (!function_exists("getAts")) {
    function getAts($str, $self = '')
    {
        // 替换
        $str = getStatusText($str);

        // 获取所有@
        $partten = '/(@[\w.\x{4e00}-\x{9fa5}]+){1,}/u';
        $result = preg_match_all($partten, $str, $matches);
        $ats = str_replace($self, '', implode(' ', array_unique($matches[0])) . ' ');

        return $ats;
    }
}

// 获取不带 html 的消息内容
if (!function_exists("getStatusText")) {
    function getStatusText($str)
    {
        $str = preg_replace('/<a href="http:\/\/fanfou.com\/[^"#>]+" class="former">/', '', $str);
        $str = preg_replace('/<\/a>/', '', $str);

        return $str;
    }
}

// 获取 timeline 消息已过去时间
if (!function_exists("getTimelineStamp")) {
    function getTimelineStamp($timestamp)
    {
        $passed = strtotime('now') - strtotime($timestamp);
        if ($passed < 60) {
            return $passed . '秒前';
        }
        if ($passed < 3600) {
            return ceil($passed / 60) . '分钟前';
        }
        if ($passed < 86400) {
            return ceil($passed / 3600) . '小时前';
        }
        if ($passed < 2592000) {
            return ceil($passed / 86400) . '个月前';
        }
        return '很久以前';
    }
}
