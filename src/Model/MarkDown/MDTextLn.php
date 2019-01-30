<?php
/**
 * Created by PhpStorm.
 * User: chanlly
 * Date: 2019/1/30
 * Annotation:
 */

namespace Chanlly\DingRobot\Model\MarkDown;


use Chanlly\DingRobot\Contacts\MarkDown\AbsMDText;

class MDTextLn extends AbsMDText
{
    
    /**
     * handle the text
     * @param string $text
     * @param array $args
     * @return string
     */
    public function handle(string $text, ... $args): string
    {
        return $text. self::NEXT_LINE;
    }
}