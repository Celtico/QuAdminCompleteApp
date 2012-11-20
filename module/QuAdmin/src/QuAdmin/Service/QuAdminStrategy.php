<?php
/**
 * @Author: Cel Ticó Petit
 * @Contact: cel@cenics.net
 * @Company: Cencis s.c.p.
 */

namespace QuAdmin\Service;

use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\Http\Response as HttpResponse;
use Zend\Mvc\Application;
use Zend\Mvc\MvcEvent;
use Zend\Stdlib\ResponseInterface as Response;
use Zend\Mvc\Controller\AbstractActionController;

class QuAdminStrategy implements ListenerAggregateInterface
{

    /**
     * @var \Zend\Stdlib\CallbackHandler[]
     */
    protected $listeners = array();

    /**
     * @param \Zend\EventManager\EventManagerInterface $events
     */
    public function attach(EventManagerInterface $events)
    {
        $events = $events->getSharedManager();

        $this->listeners[] = $events->attach('Zend\Mvc\Controller\AbstractActionController', 'dispatch', function($eve){

            // Get Services
            $controller      = $eve->getTarget();
            $app             = $eve->getApplication();
            $result          = $eve->getResult();
            $match           = $eve->getRouteMatch();
            $sm              = $app->getServiceManager();
            $auth            = $sm ->get('zfcuser_auth_service');
            $config          = $sm ->get('config');
            $QuAdmConfig     = $config['QuAdminConfig'];

            // Get NameSpace
            $controllerClass = get_class($controller);
            $Namespace       = substr($controllerClass, 0, strpos($controllerClass, '\\'));

            // setTemplate
            if (isset($QuAdmConfig['QuTemplate'][$Namespace]))
            {
                if($QuAdmConfig['QuTemplate'][$Namespace] == 'RouteMatch')
                {
                    $template   = $match->getMatchedRouteName();
                    $template  .= '/'.$match->getParam('action');
                    $result->setTemplate(strtolower($template));
                }
            }

            // setLayout
            if(isset($QuAdmConfig['QuLayout'][$Namespace]))
            {
                 $controller->layout($QuAdmConfig['QuLayout'][$Namespace]);
            }

            // setUrlBase
            if(isset($QuAdmConfig['QuBasePath'][$Namespace]))
            {
                $eve->getRequest()->setBaseUrl($QuAdmConfig['QuBasePath'][$Namespace]);
            }

            // Redirect Login and setLayout login
            if(isset($QuAdmConfig['QuRedirectLogin'][$Namespace]))
            {
                if(!$auth->hasIdentity())
                {
                    $controller->layout($QuAdmConfig['QuLayout']['ZfcUser']);

                    // In ZfcUser login return
                    if($match->getMatchedRouteName() == 'zfcuser/login')
                    {
                        return;
                    }
                    else
                    {
                        // Do nothing if the result is a response object
                        if ($result instanceof Response) { return; }

                        // get url to the zfcuser/login route
                        $router = $eve->getRouter();
                        $options['name'] = 'zfcuser/login';
                        $url = $router->assemble(array(), $options);

                        // Work out where were we trying to get to
                        $options['name'] = $match->getMatchedRouteName();
                        $redirect = $router->assemble($match->getParams(), $options);

                        // set up response to redirect to login page
                        $response = $eve->getResponse();
                        if (!$response)
                        {
                            $response = new HttpResponse();
                            $eve->setResponse($response);
                        }
                        $response->getHeaders()->addHeaderLine('Location', $url . '?redirect=' . $redirect);
                        $response->setStatusCode(302);
                    }
                }
            }
        }, -80);
    }

    /**
     * @param \Zend\EventManager\EventManagerInterface $events
     */
    public function detach(EventManagerInterface $events)
    {
        foreach ($this->listeners as $index => $listener)
        {
            if ($events->detach($listener))
            {
                unset($this->listeners[$index]);
            }
        }
    }
}
