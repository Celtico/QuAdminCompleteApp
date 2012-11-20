<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 * @package   Zend_Barcode
 */

namespace Zend\Barcode\Object;

/**
 * Class for generate Barcode
 *
 * @category   Zend
 * @package    Zend_Barcode
 */
class Error extends AbstractObject
{
    /**
     * All texts are accepted
     * @param string $value
     * @return boolean
     */
    public function validateText($value)
    {
        return true;
    }

    /**
     * Height is forced
     * @param bool $recalculate
     * @return integer
     */
    public function getHeight($recalculate = false)
    {
        return 40;
    }

    /**
     * Width is forced
     * @param bool $recalculate
     * @return integer
     */
    public function getWidth($recalculate = false)
    {
        return 400;
    }

    /**
     * Reset precedent instructions
     * and draw the error message
     * @return array
     */
    public function draw()
    {
        $this->instructions = array();
        $this->addText('ERROR:', 10, array(5 , 18), $this->font, 0, 'left');
        $this->addText($this->text, 10, array(5 , 32), $this->font, 0, 'left');
        return $this->instructions;
    }

    /**
     * For compatibility reason
     * @return void
     */
    protected function prepareBarcode()
    {
    }

    /**
     * For compatibility reason
     * @return void
     */
    protected function checkSpecificParams()
    {
    }

    /**
     * For compatibility reason
     * @return void
     */
    protected function calculateBarcodeWidth()
    {
    }
}
