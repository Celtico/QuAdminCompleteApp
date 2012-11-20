<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 * @package   Zend_View
 */

namespace Zend\View\Resolver;

use Zend\View\Renderer\RendererInterface as Renderer;

/**
 * @category   Zend
 * @package    Zend_View
 * @subpackage Resolver
 */
interface ResolverInterface
{
    /**
     * Resolve a template/pattern name to a resource the renderer can consume
     *
     * @param  string $name
     * @param  null|Renderer $renderer
     * @return mixed
     */
    public function resolve($name, Renderer $renderer = null);
}
