<?php
    /**
     * @Author: Cel Ticó Petit
     * @Contact: cel@cenics.net
     * @Company: Cencis s.c.p.
     */

    namespace QuAdmin\View\Helper;

    use Zend\View\Helper\AbstractHelper;

    class QuLangUrl extends AbstractHelper
    {
        protected $Service;

        /**
         * @param $Service
         */
        public function __construct($Service)
        {
            $this->Service = $Service;
        }

        /**
         * @param $lang
         *
         * @return string
         */
        public function __invoke($lang)
        {
            return $this->getLangUrl($lang);
        }

        /**
         * @param $lang
         *
         * @return string
         */
        public function getLangUrl($lang)
        {
            $router       = $this->Service->get('router');
            $request      = $this->Service->get('request');
            $routeMatch   = $router->match($request);
            $action       = $routeMatch->getParam('action');
            $id           = $routeMatch->getParam('id');
            $id_parent    = $routeMatch->getParam('id_parent');

            if($action != '')      $action = '/'.$action;
            if($id != '')          $id = '/'.$id;
            if($id_parent != '')   $id_parent = '/'.$id_parent;

            $MatchName    = strtolower($routeMatch->getMatchedRouteName());
            $MatchNameEx  = explode('/',$MatchName);

            if(isset($MatchNameEx[1])){
                return  $MatchNameEx[0].'/'.$lang.'/'.$MatchNameEx[1].$action.$id.$id_parent;
            }else{
                return;
            }
        }
    }
