<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 * @package   Zend_Text
 */

namespace Zend\Text\Table;

use Zend\Text;

/**
 * Column class for Zend\Text\Table\Row
 *
 * @category  Zend
 * @package   Zend_Text_Table
 */
class Column
{
    /**
     * Aligns for columns
     */
    const ALIGN_LEFT   = 'left';
    const ALIGN_CENTER = 'center';
    const ALIGN_RIGHT  = 'right';

    /**
     * Content of the column
     *
     * @var string
     */
    protected $content = '';

    /**
     * Align of the column
     *
     * @var string
     */
    protected $align = self::ALIGN_LEFT;

    /**
     * Colspan of the column
     *
     * @var integer
     */
    protected $colSpan = 1;

    /**
     * Allowed align parameters
     *
     * @var array
     */
    protected $allowedAligns = array(self::ALIGN_LEFT, self::ALIGN_CENTER, self::ALIGN_RIGHT);

    /**
     * Create a column for a Zend\Text\Table\Row object.
     *
     * @param string  $content  The content of the column
     * @param string  $align    The align of the content
     * @param integer $colSpan  The colspan of the column
     * @param string  $charset  The encoding of the content
     */
    public function __construct($content = null, $align = null, $colSpan = null, $charset = null)
    {
        if ($content !== null) {
            $this->setContent($content, $charset);
        }

        if ($align !== null) {
            $this->setAlign($align);
        }

        if ($colSpan !== null) {
            $this->setColSpan($colSpan);
        }
    }

    /**
     * Set the content.
     *
     * If $charset is not defined, it is assumed that $content is encoded in
     * the charset defined via Zend\Text\Table::setInputCharset() (defaults
     * to utf-8).
     *
     * @param  string $content  Content of the column
     * @param  string $charset  The charset of the content
     * @throws Exception\InvalidArgumentException When $content is not a string
     * @return Column
     */
    public function setContent($content, $charset = null)
    {
        if (is_string($content) === false) {
            throw new Exception\InvalidArgumentException('$content must be a string');
        }

        if ($charset === null) {
            $inputCharset = Table::getInputCharset();
        } else {
            $inputCharset = strtolower($charset);
        }

        $outputCharset = Table::getOutputCharset();

        if ($inputCharset !== $outputCharset) {
            if (PHP_OS !== 'AIX') {
                // AIX does not understand these character sets
                $content = iconv($inputCharset, $outputCharset, $content);
            }

        }

        $this->content = $content;

        return $this;
    }

    /**
     * Set the align
     *
     * @param  string $align Align of the column
     * @throws Exception\OutOfBoundsException When supplied align is invalid
     * @return Column
     */
    public function setAlign($align)
    {
        if (in_array($align, $this->allowedAligns) === false) {
            throw new Exception\OutOfBoundsException('Invalid align supplied');
        }

        $this->align = $align;

        return $this;
    }

    /**
     * Set the colspan
     *
     * @param  int $colSpan
     * @throws Exception\InvalidArgumentException When $colSpan is smaller than 1
     * @return Column
     */
    public function setColSpan($colSpan)
    {
        if (is_int($colSpan) === false or $colSpan < 1) {
            throw new Exception\InvalidArgumentException('$colSpan must be an integer and greater than 0');
        }

        $this->colSpan = $colSpan;

        return $this;
    }

    /**
     * Get the colspan
     *
     * @return integer
     */
    public function getColSpan()
    {
        return $this->colSpan;
    }

    /**
     * Render the column width the given column width
     *
     * @param  integer $columnWidth The width of the column
     * @param  integer $padding     The padding for the column
     * @throws Exception\InvalidArgumentException When $columnWidth is lower than 1
     * @throws Exception\OutOfBoundsException When padding is greater than columnWidth
     * @return string
     */
    public function render($columnWidth, $padding = 0)
    {
        if (is_int($columnWidth) === false or $columnWidth < 1) {
            throw new Exception\InvalidArgumentException('$columnWidth must be an integer and greater than 0');
        }

        $columnWidth -= ($padding * 2);

        if ($columnWidth < 1) {
            throw new Exception\OutOfBoundsException('Padding (' . $padding . ') is greater than column width');
        }

        switch ($this->align) {
            case self::ALIGN_LEFT:
                $padMode = STR_PAD_RIGHT;
                break;

            case self::ALIGN_CENTER:
                $padMode = STR_PAD_BOTH;
                break;

            case self::ALIGN_RIGHT:
                $padMode = STR_PAD_LEFT;
                break;

            default:
                // This can never happen, but the CS tells I have to have it ...
                break;
        }

        $outputCharset = Table::getOutputCharset();
        $lines         = explode("\n", Text\MultiByte::wordWrap($this->content, $columnWidth, "\n", true, $outputCharset));
        $paddedLines   = array();

        foreach ($lines AS $line) {
            $paddedLines[] = str_repeat(' ', $padding)
                           . Text\MultiByte::strPad($line, $columnWidth, ' ', $padMode, $outputCharset)
                           . str_repeat(' ', $padding);
        }

        $result = implode("\n", $paddedLines);

        return $result;
    }
}
