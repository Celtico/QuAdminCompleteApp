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

use Zend\Paginator;
use Zend\View;
use Zend\View\Exception;

/**
 * @category   Zend
 * @package    Zend_View
 */
class PaginationControl extends AbstractHelper
{
    /**
     * Default view partial
     *
     * @var string|array
     */
    protected static $defaultViewPartial = null;

    /**
     * Default Scrolling Style
     *
     * @var string
     */
    protected static $defaultScrollingStyle = 'sliding';

    /**
     * Sets the default view partial.
     *
     * @param string|array $partial View partial
     */
    public static function setDefaultViewPartial($partial)
    {
        self::$defaultViewPartial = $partial;
    }

    /**
     * Gets the default view partial
     *
     * @return string|array
     */
    public static function getDefaultViewPartial()
    {
        return self::$defaultViewPartial;
    }

     /**
     * Gets the default scrolling style
     *
     * @return string
     */
    public static function getDefaultScrollingStyle()
    {
        return self::$defaultScrollingStyle;
    }

    /**
     * Sets the default Scrolling Style
     *
     * @param string $style string 'all' | 'elastic' | 'sliding' | 'jumping'
     */
    public static function setDefaultScrollingStyle($style)
    {
        self::$defaultScrollingStyle = $style;
    }

    /**
     * Render the provided pages.  This checks if $view->paginator is set and,
     * if so, uses that.  Also, if no scrolling style or partial are specified,
     * the defaults will be used (if set).
     *
     * @param  \Zend\Paginator\Paginator (Optional) $paginator
     * @param  string $scrollingStyle (Optional) Scrolling style
     * @param  string $partial (Optional) View partial
     * @param  array|string $params (Optional) params to pass to the partial
     * @return string
     * @throws Exception\RuntimeException if no paginator or no view partial provided
     * @throws Exception\InvalidArgumentException if partial is invalid array
     */
    public function __invoke(Paginator\Paginator $paginator = null, $scrollingStyle = null, $partial = null, $params = null)
    {
        if ($paginator === null) {
            if (isset($this->view->paginator) and $this->view->paginator !== null and $this->view->paginator instanceof Paginator\Paginator) {
                $paginator = $this->view->paginator;
            } else {
                throw new Exception\RuntimeException('No paginator instance provided or incorrect type');
            }
        }

        if ($partial === null) {
            if (self::$defaultViewPartial === null) {
                throw new Exception\RuntimeException('No view partial provided and no default set');
            }

            $partial = self::$defaultViewPartial;
        }

        if ($scrollingStyle === null) {
            $scrollingStyle = self::$defaultScrollingStyle;
        }

        $pages = get_object_vars($paginator->getPages($scrollingStyle));

        if ($params !== null) {
            $pages = array_merge($pages, (array) $params);
        }

        if (is_array($partial)) {
            if (count($partial) != 2) {
                throw new Exception\InvalidArgumentException(
                    'A view partial supplied as an array must contain two values: the filename and its module'
                );
            }

            if ($partial[1] !== null) {
                $partialHelper = $this->view->plugin('partial');
                return $partialHelper($partial[0], $pages);
            }

            $partial = $partial[0];
        }

        $partialHelper = $this->view->plugin('partial');
        return $partialHelper($partial, $pages);
    }
}
