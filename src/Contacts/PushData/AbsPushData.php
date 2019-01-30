<?php
/**
 * Created by PhpStorm.
 * User: chanlly
 * Date: 2019/1/30
 * Annotation:
 */

namespace Chanlly\DingRobot\Contacts\PushData;


abstract class AbsPushData implements IPushData
{
    /*---------------------------------------------- extends function ----------------------------------------------*/
    
    /**
     * @ somebody list
     * @return array
     */
    public function at(): array
    {
        return [];
    }
    
    
    /*---------------------------------------------- abstract ----------------------------------------------*/
    
    
    /**
     * get the message type
     * @return string
     */
    abstract protected function type(): string;
    
    
    /**
     * get the message type data
     * @return array
     */
    abstract protected function typeData(): array;
    
    
    
    /*---------------------------------------------- function ----------------------------------------------*/
    
    
    /**
     * get push data
     * @return array
     */
    public function getData(): array
    {
        $type = $this->type();
        return $this->at() + [
                "msgtype" => $type,
                $type => $this->typeData()
            ];
    }
}