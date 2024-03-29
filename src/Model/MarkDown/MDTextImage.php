<?php
/**
 * Created by PhpStorm.
 * User: 沧澜
 * Date: 2019/1/30
 * Annotation:
 */

namespace Chanlly\DingRobot\Model\MarkDown;


use Chanlly\DingRobot\Contacts\MarkDown\AbsMDText;

class MDTextImage extends AbsMDText
{
    
    /**
     * handle the text
     * @param string $url
     * @param array $args
     * @return string
     */
    public function handle(string $url, ... $args): string
    {
        return "![screenshot]($url)";
    }
}