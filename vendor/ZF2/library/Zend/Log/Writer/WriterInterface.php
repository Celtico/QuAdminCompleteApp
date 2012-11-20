<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 * @package   Zend_Log
 */

namespace Zend\Log\Writer;

use Zend\Log\Filter\FilterInterface as Filter;
use Zend\Log\Formatter\FormatterInterface as Formatter;

/**
 * @category   Zend
 * @package    Zend_Log
 */
interface WriterInterface
{
    /**
     * Add a log filter to the writer
     *
     * @param  int|Filter $filter
     * @return WriterInterface
     */
    public function addFilter($filter);

    /**
     * Set a message formatter for the writer
     *
     * @param Formatter $formatter
     * @return WriterInterface
     */
    public function setFormatter(Formatter $formatter);

    /**
     * Write a log message
     *
     * @param  array $event
     * @return WriterInterface
     */
    public function write(array $event);

    /**
     * Perform shutdown activities
     *
     * @return void
     */
    public function shutdown();
}
