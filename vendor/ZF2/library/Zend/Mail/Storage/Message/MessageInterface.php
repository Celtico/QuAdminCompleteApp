<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 * @package   Zend_Mail
 */

namespace Zend\Mail\Storage\Message;

/**
 * @category   Zend
 * @package    Zend_Mail
 * @subpackage Storage
 */
interface MessageInterface
{
    /**
     * return toplines as found after headers
     *
     * @return string toplines
     */
    public function getTopLines();

    /**
     * check if flag is set
     *
     * @param mixed $flag a flag name, use constants defined in Zend\Mail\Storage
     * @return bool true if set, otherwise false
     */
    public function hasFlag($flag);

    /**
     * get all set flags
     *
     * @return array array with flags, key and value are the same for easy lookup
     */
    public function getFlags();
}
