<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 * @package   Zend_Db
 */

namespace Zend\Db\Adapter\Driver;

use Countable;
use Iterator;

/**
 * @category   Zend
 * @package    Zend_Db
 * @subpackage Adapter
 */
interface ResultInterface extends
    Countable,
    Iterator
{
    /**
     * Force buffering
     *
     * @return void
     */
    public function buffer();

    /**
     * Check if is buffered
     *
     * @return bool|null
     */
    public function isBuffered();

    /**
     * Is query result?
     *
     * @return bool
     */
    public function isQueryResult();

    /**
     * Get affected rows
     *
     * @return integer
     */
    public function getAffectedRows();

    /**
     * Get generated value
     *
     * @return mixed|null
     */
    public function getGeneratedValue();

    /**
     * Get the resource
     *
     * @return mixed
     */
    public function getResource();

    /**
     * Get field count
     *
     * @return integer
     */
    public function getFieldCount();
}
