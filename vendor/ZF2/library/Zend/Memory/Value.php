<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 * @package   Zend_Memory
 */

namespace Zend\Memory;

use ArrayAccess;
use Countable;

/**
 * String value object
 *
 * It's an OO string wrapper.
 * Used to intercept string updates.
 *
 * @category   Zend
 * @package    Zend_Memory
 */
class Value implements ArrayAccess, Countable
{
    /**
     * Value
     *
     * @var string
     */
    private $value;

    /**
     * Container
     *
     * @var Container\Movable
     */
    private $container;

    /**
     * Boolean flag which signals to trace value modifications
     *
     * @var boolean
     */
    private $trace;


    /**
     * Object constructor
     *
     * @param string $value
     * @param \Zend\Memory\Container\Movable $container
     */
    public function __construct($value, Container\Movable $container)
    {
        $this->container = $container;

        $this->value = (string) $value;

        /**
         * Object is marked as just modified by memory manager
         * So we don't need to trace followed object modifications and
         * object is processed (and marked as traced) when another
         * memory object is modified.
         *
         * It reduces overall numberr of calls necessary to modification trace
         */
        $this->trace = false;
    }

    /**
     * Countable
     *
     * @return int
     */
    public function count()
    {
        return strlen($this->value);
    }

    /**
     * ArrayAccess interface method
     * returns true if string offset exists
     *
     * @param integer $offset
     * @return boolean
     */
    public function offsetExists($offset)
    {
        return $offset >= 0  &&  $offset < strlen($this->value);
    }

    /**
     * ArrayAccess interface method
     * Get character at $offset position
     *
     * @param integer $offset
     * @return string
     */
    public function offsetGet($offset)
    {
        return $this->value[$offset];
    }

    /**
     * ArrayAccess interface method
     * Set character at $offset position
     *
     * @param integer $offset
     * @param string $char
     */
    public function offsetSet($offset, $char)
    {
        $this->value[$offset] = $char;

        if ($this->trace) {
            $this->trace = false;
            $this->container->processUpdate();
        }
    }

    /**
     * ArrayAccess interface method
     * Unset character at $offset position
     *
     * @param integer $offset
     */
    public function offsetUnset($offset)
    {
        unset($this->value[$offset]);

        if ($this->trace) {
            $this->trace = false;
            $this->container->processUpdate();
        }
    }


    /**
     * To string conversion
     *
     * @return string
     */
    public function __toString()
    {
        return $this->value;
    }


    /**
     * Get string value reference
     *
     * _Must_ be used for value access before PHP v 5.2
     * or _may_ be used for performance considerations
     *
     * @internal
     * @return string
     */
    public function &getRef()
    {
        return $this->value;
    }

    /**
     * Start modifications trace
     *
     * _Must_ be used for value access before PHP v 5.2
     * or _may_ be used for performance considerations
     *
     * @internal
     */
    public function startTrace()
    {
        $this->trace = true;
    }
}
