<?php
/**
 * @Author: Cel Ticó Petit
 * @Contact: cel@cenics.net
 * @Company: Cencis s.c.p.
 */

namespace QuWebDemo\View\Helper;

use Zend\View\Helper\AbstractHelper;

/**
 * Get images
 * Extract path config QuPhpThumb
 */
class Img extends AbstractHelper
{

    /**
     * @var
     */
    protected $QuBasePath;
    protected $QuBaseURL;

    /**
     * @param $Config
     */
    public function __construct($Config)
    {
        $this->QuBasePath   = $Config['QuBasePath'];
        $this->QuBaseURL    = $Config['QuBaseURL'];
    }

    /**
     * @param $img
     * @param $type
     * @param $class
     *
     * @return string
     */
    public function __invoke($img,$type,$class)
    {
        return $this->Filter($img,$type,$class);
    }

    /**
     * @param $img
     * @param $type
     * @param $class
     *
     * @return string
     */
    function Filter($img,$type,$class){

        $file = $this->QuBasePath.'/'.$type.'/'.$img;
        if(is_file($file)){
            return '<img src="'.$this->QuBaseURL.'/'.$type.'/'.$img.'"'.$class.'>';
        }
        return;
    }
}
