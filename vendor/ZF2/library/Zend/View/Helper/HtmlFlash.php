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

/**
 * @category   Zend
 * @package    Zend_View
 * @subpackage Helper
 */
class HtmlFlash extends AbstractHtmlElement
{
    /**
     * Default file type for a flash applet
     *
     */
    const TYPE = 'application/x-shockwave-flash';

    /**
     * Output a flash movie object tag
     *
     * @param string $data The flash file
     * @param array  $attribs Attribs for the object tag
     * @param array  $params Params for in the object tag
     * @param string $content Alternative content
     * @return string
     */
    public function __invoke($data, array $attribs = array(), array $params = array(), $content = null)
    {
        // Params
        $params = array_merge(array('movie'   => $data,
                                    'quality' => 'high'), $params);

        $htmlObject = $this->getView()->plugin('htmlObject');
        return $htmlObject($data, self::TYPE, $attribs, $params, $content);
    }
}
