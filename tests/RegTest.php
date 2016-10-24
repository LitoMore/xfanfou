<?php

class RegTest extends TestCase
{
//    public function testReg()
//    {
//        $text = "@fan小默 @test. @te# @test @te# sfweo @te.st2 @123_ @輸入簡體字";
//
//        $partten = '/(@[\w.\x{4e00}-\x{9fa5}]+){1,}/u';
//
//        $result = preg_match_all($partten, $text, $matches);
//
//        dd(implode(' ', array_unique($matches[0])));
//    }

    public function testGet()
    {
        dd(getAts('我舍长，一出汗就有股味道，像那种番石榴熟透的味道。很恶心。 转 @春天的熊枣糕 你的鼻子也太灵敏了吧！「@你治. 我偶尔晚上会被自己的气味熏醒……转@春天的熊枣糕 自己一般对自己身上的味儿都不敏感吧「@你治. 说起来，你们能闻出来自己身上的气味变化吗？」」'));
    }
}