<?php
/**
 * Created by PhpStorm.
 * User: 沧澜
 * Date: 2019/1/30
 * Annotation:
 */

namespace Chanlly\DingRobot\Model\MarkDown;


use Chanlly\DingRobot\Contacts\MarkDown\AbsMDText;

class MDTextBold extends AbsMDText
{
    
    /**
     * handle the text
     * @param string $text
     * @param array $args
     * @return string
     */
    public function handle(string $text, ... $args): string
    {
        return '**' . $text . '**';
    }
}