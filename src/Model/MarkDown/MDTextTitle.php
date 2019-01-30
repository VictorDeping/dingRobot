<?php
/**
 * Created by PhpStorm.
 * User: chanlly
 * Date: 2019/1/30
 * Annotation:
 */

namespace Chanlly\DingRobot\Model\MarkDown;


use Chanlly\DingRobot\Contacts\MarkDown\AbsMDText;

class MDTextTitle extends AbsMDText
{
    
    /**
     * handle the text
     * @param string $text
     * @param array $args
     * @return string
     */
    public function handle(string $text, ... $args): string
    {
        return str_repeat("#", abs($args[0] ?? 1)) . ' ' . $text . self::NEXT_LINE;
    }
}