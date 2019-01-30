<?php
/**
 * Created by PhpStorm.
 * User: chanlly
 * Date: 2019/1/30
 * Annotation:
 */

namespace Chanlly\DingRobot\Contacts\PushData;


interface IPushData
{
    /**
     * get push data
     * @return array
     */
    public function getData(): array;
    
}