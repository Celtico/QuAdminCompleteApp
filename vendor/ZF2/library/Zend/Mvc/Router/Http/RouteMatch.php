<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 * @package   Zend_Mvc
 */

namespace Zend\Mvc\Router\Http;

use Zend\Mvc\Router\RouteMatch as BaseRouteMatch;

/**
 * Part route match.
 *
 * @package    Zend_Mvc_Router
 * @subpackage Http
 */
class RouteMatch extends BaseRouteMatch
{
    /**
     * Length of the matched path.
     *
     * @var integer
     */
    protected $length;

    /**
     * Create a part RouteMatch with given parameters and length.
     *
     * @param  array   $params
     * @param  integer $length
     */
    public function __construct(array $params, $length = 0)
    {
        parent::__construct($params);

        $this->length = $length;
    }

    /**
     * setMatchedRouteName(): defined by BaseRouteMatch.
     *
     * @see    BaseRouteMatch::setMatchedRouteName()
     * @param  string $name
     * @return RouteMatch
     */
    public function setMatchedRouteName($name)
    {
        if ($this->matchedRouteName === null) {
            $this->matchedRouteName = $name;
        } else {
            $this->matchedRouteName = $name . '/' . $this->matchedRouteName;
        }

        return $this;
    }

    /**
     * Merge parameters from another match.
     *
     * @param  self $match
     * @return RouteMatch
     */
    public function merge(self $match)
    {
        $this->params  = array_merge($this->params, $match->getParams());
        $this->length += $match->getLength();

        $this->matchedRouteName = $match->getMatchedRouteName();

        return $this;
    }

    /**
     * Get the matched path length.
     *
     * @return integer
     */
    public function getLength()
    {
        return $this->length;
    }
}
