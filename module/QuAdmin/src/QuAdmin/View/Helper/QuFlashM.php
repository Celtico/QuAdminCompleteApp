<?php
/**
 * @Author: Cel Ticó Petit
 * @Contact: cel@cenics.net
 * @Company: Cencis s.c.p.
 */

namespace QuAdmin\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\Mvc\Controller\Plugin\FlashMessenger;

class QuFlashM extends AbstractHelper
{
    /**
     * @var \Zend\Mvc\Controller\Plugin\FlashMessenger
     */
    protected $flashMessenger;
    protected $class;

    /**
     * @param \Zend\Mvc\Controller\Plugin\FlashMessenger $plugin
     * @param                                            $class
     */
    public function __construct(FlashMessenger $plugin,$class)
    {
        $this->flashMessenger = $plugin;
        $this->class          = $class;
    }

    /**
     * @return string
     */
    public function __invoke()
    {
        $this->flashMessenger->setNamespace('QuAdmin');
        if(count($this->flashMessenger))
        {
            foreach($this->flashMessenger as $msg){}

            if(isset($msg['type'])){
               $type = $msg['type'];
            }else{
               $type = '';
            }

            if($this->class == 'alert'){
                $button = '<button type="button" class="close" data-dismiss="alert">×</button>';
            }else{
               $button = '';
            }

            $message = '
            <div class="'.$this->class.' '.$type.'">
                '.$button.'
                '.$msg['message'].'
            </div>';
            return $message;
        }
        else
        {
            return;
        }
    }
}
