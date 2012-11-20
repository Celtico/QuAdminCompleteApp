<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 * @package   Zend_Form
 */

namespace Zend\Form\Element;

use Zend\Form\Element;
use Zend\Form\Element\DateTime as DateTimeElement;
use Zend\Validator\Date as DateValidator;
use Zend\Validator\DateStep as DateStepValidator;
use Zend\Validator\ValidatorInterface;

/**
 * @category   Zend
 * @package    Zend_Form
 * @subpackage Element
 */
class Date extends DateTimeElement
{
    /**
     * Seed attributes
     *
     * @var array
     */
    protected $attributes = array(
        'type' => 'date',
    );

    /**
     * Date format to use for DateTime values. By default, this is RFC-3339,
     * full-date (Y-m-d), which is what HTML5 dictates.
     *
     * @var string
     */
    protected $format = 'Y-m-d';

    /**
     * Retrieves a Date Validator configured for a DateTime Input type
     *
     * @return ValidatorInterface
     */
    protected function getDateValidator()
    {
        return new DateValidator(array('format' => 'Y-m-d'));
    }

    /**
     * Retrieves a DateStep Validator configured for a Date Input type
     *
     * @return ValidatorInterface
     */
    protected function getStepValidator()
    {
        $stepValue = (isset($this->attributes['step']))
                     ? $this->attributes['step'] : 1; // Days

        $baseValue = (isset($this->attributes['min']))
                     ? $this->attributes['min'] : '1970-01-01';

        return new DateStepValidator(array(
            'format'    => 'Y-m-d',
            'baseValue' => $baseValue,
            'step'      => new \DateInterval("P{$stepValue}D"),
        ));
    }
}
