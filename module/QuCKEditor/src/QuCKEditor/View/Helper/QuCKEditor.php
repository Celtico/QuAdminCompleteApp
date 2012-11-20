<?php
/**
 * @Author: Cel Ticó Petit
 * @Contact: cel@cenics.net
 * @Company: Cencis s.c.p.
 */

namespace QuCKEditor\View\Helper;

use Zend\View\Helper\AbstractHelper;
use QuCKEditor\php\CKEditor;

class QuCKEditor extends AbstractHelper
{

    /**
     * @var
     */
    protected $QuBasePath;
    protected $QuElFinder;
    protected $QuElFinderConnector;

    /**
     * @param array $array
     */
    public function __construct($array = array())
    {
        if(isset($array['QuBasePath']))           $this->QuBasePath             = $array['QuBasePath'];
        if(isset($array['QuElFinder']))           $this->QuElFinder             = $array['QuElFinder'];
        if(isset($array['QuElFinderConnector']))  $this->QuElFinderConnector    = $array['QuElFinderConnector'];
    }

    /**
     * @param $name
     * @param $options
     *
     * @return string
     */
    public function __invoke($name,$options)
    {
        return $this->QuCkEditor($name,$options);
    }

    /**
     * @param $name
     * @param $options
     *
     * @return string
     */
    public function QuCkEditor($name,$options = array()) {

        $CKEditor = new CKEditor();

        $CKEditor->returnOutput         = true;
        $CKEditor->basePath             = $this->QuBasePath.'/';
        $CKEditor->textareaAttributes   = array("cols" => 80, "rows" => 10);

        if(isset($options['toolbar']))  $CKEditor->config['toolbar'] = $options['toolbar'];
        if(isset($options['Width']))    $CKEditor->config['width']   = $options['Width'];
        if(isset($options['Height']))   $CKEditor->config['height']  = $options['Height'];

        if($this->QuElFinder != ''){

            $CKEditor->config['filebrowserBrowseUrl'] 	   = $this->QuElFinder;
            $CKEditor->config['filebrowserImageBrowseUrl'] = $this->QuElFinder;
            $CKEditor->config['filebrowserFlashBrowseUrl'] = $this->QuElFinder;
            $CKEditor->config['filebrowserUploadUrl'] 	   = $this->QuElFinderConnector.'/Files';
            $CKEditor->config['filebrowserImageUploadUrl'] = $this->QuElFinderConnector.'/Images';
            $CKEditor->config['filebrowserFlashUploadUrl'] = $this->QuElFinderConnector.'/Flash';
            $CKEditor->config['filebrowserWindowWidth']    = '1000';
            $CKEditor->config['filebrowserWindowHeight']   = '640';

        }

        echo $CKEditor->replace($name);
    }
}