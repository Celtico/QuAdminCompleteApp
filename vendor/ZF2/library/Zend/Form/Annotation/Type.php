<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 * @package   Zend_Form
 */

namespace Zend\Form\Annotation;

/**
 * Type annotation
 *
 * Use this annotation to specify the specific \Zend\Form class to use when
 * building the form, fieldset, or element. The value should be a string
 * representing a fully qualified classname.
 *
 * @Annotation
 * @package    Zend_Form
 * @subpackage Annotation
 */
class Type extends AbstractStringAnnotation
{
    /**
     * Retrieve the class type
     *
     * @return null|string
     */
    public function getType()
    {
        return $this->value;
    }
}
