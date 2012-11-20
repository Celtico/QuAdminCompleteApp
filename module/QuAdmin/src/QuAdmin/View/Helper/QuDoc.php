<?php
    /**
     * @Author: Cel Ticó Petit
     * @Contact: cel@cenics.net
     * @Company: Cencis s.c.p.
     */

    namespace QuAdmin\View\Helper;

    use Zend\View\Helper\AbstractHelper;

    class QuDoc extends AbstractHelper
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
         * @param $type
         * @param $name
         * @param $style
         *
         * @return string
         */
        public function __invoke($type,$name,$style)
        {
            $nom = $type.'/'.$name;
            $img = $this->QuBasePath.'/'.$nom;
            if(is_file($img)){
                $extension = pathinfo($img, PATHINFO_EXTENSION);
                if($extension == 'jpg' or $extension == 'jpeg' or $extension == 'gif' or $extension == 'png'){
                    return '<a href="'.$this->QuBaseURL.'/'.$type.'/'.$name.'" class="lightbox">
                            <img src="'.$this->QuBaseURL.'/'.$type.'/s'.$name.'" '.$style.' />
                        </a>';
                }else{
                    return '<a href="'.$this->QuBaseURL.'/'.$type.'/'.$name.'" '.$style.'>Doc</a>';
                }
            }else{
                return;
            }
        }
    }