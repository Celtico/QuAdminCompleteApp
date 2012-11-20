<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 * @package   Zend_Mvc
 */

namespace Zend\Mvc\View\Http;

use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\Http\Request as HttpRequest;
use Zend\Console\Request as ConsoleRequest;
use Zend\Mvc\MvcEvent;

/**
 * @category   Zend
 * @package    Zend_Mvc
 * @subpackage View
 */
class InjectRoutematchParamsListener implements ListenerAggregateInterface
{
    /**
     * @var \Zend\Stdlib\CallbackHandler[]
     */
    protected $listeners = array();

    /**
     * Should request params overwrite existing request params?
     *
     * @var bool
     */
    protected $overwrite = true;

    /**
     * Attach the aggregate to the specified event manager
     *
     * @param  EventManagerInterface $events
     * @return void
     */
    public function attach(EventManagerInterface $events)
    {
        $this->listeners[] = $events->attach('dispatch', array($this, 'injectParams'), 90);
    }

    /**
     * Detach listeners
     *
     * @param  EventManagerInterface $events
     * @return void
     */
    public function detach(EventManagerInterface $events)
    {
        foreach ($this->listeners as $index => $listener) {
            if ($events->detach($listener)) {
                unset($this->listeners[$index]);
            }
        }
    }

    /**
     * Take parameters from RouteMatch and inject them into the request.
     *
     * @param  MvcEvent $e
     * @return void
     */
    public function injectParams(MvcEvent $e)
    {
        $routeMatchParams = $e->getRouteMatch()->getParams();
        $request = $e->getRequest();

        /** @var $params \Zend\Stdlib\Parameters */
        if ($request instanceof ConsoleRequest) {
            $params = $request->params();
        } elseif ($request instanceof HttpRequest) {
            $params = $request->get();
        } else {
            // unsupported request type
            return;
        }

        if ($this->overwrite) {
            foreach ($routeMatchParams as $key => $val) {
                $params->$key = $val;
            }
        } else {
            foreach ($routeMatchParams as $key => $val) {
                if (!$params->offsetExists($key)) {
                    $params->$key = $val;
                }
            }
        }
    }

    /**
     * Should RouteMatch parameters replace existing Request params?
     *
     * @param boolean $overwrite
     */
    public function setOverwrite($overwrite)
    {
        $this->overwrite = $overwrite;
    }

    /**
     * @return boolean
     */
    public function getOverwrite()
    {
        return $this->overwrite;
    }
}
