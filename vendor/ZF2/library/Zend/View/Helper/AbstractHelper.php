<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 * @package   Zend_View
 */

namespace Zend\View\Helper;

use Zend\View\Helper\HelperInterface;
use Zend\View\Renderer\RendererInterface as Renderer;

/**
 * @category   Zend
 * @package    Zend_View
 * @subpackage Helper
 */
abstract class AbstractHelper implements HelperInterface
{
    /**
     * View object
     *
     * @var Renderer
     */
    protected $view = null;

    /**
     * Set the View object
     *
     * @param  Renderer $view
     * @return AbstractHelper
     */
    public function setView(Renderer $view)
    {
        $this->view = $view;
        return $this;
    }

    /**
     * Get the view object
     *
     * @return null|Renderer
     */
    public function getView()
    {
        return $this->view;
    }
}
