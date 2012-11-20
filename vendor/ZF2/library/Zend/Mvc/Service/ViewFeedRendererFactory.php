<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 * @package   Zend_Mvc
 */

namespace Zend\Mvc\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\View\Renderer\FeedRenderer;

/**
 * @category   Zend
 * @package    Zend_Mvc
 * @subpackage Service
 */
class ViewFeedRendererFactory implements FactoryInterface
{
    /**
     * Create and return the feed view renderer
     *
     * @param  ServiceLocatorInterface $serviceLocator
     * @return FeedRenderer
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $feedRenderer = new FeedRenderer();
        return $feedRenderer;
    }
}
