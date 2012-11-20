<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 * @package   Zend_Debug.php
 */

namespace Zend\Debug;

use Zend\Escaper\Escaper;

/**
 * Concrete class for generating debug dumps related to the output source.
 *
 * @category   Zend
 * @package    Zend_Debug
 */
class Debug
{
    /**
     * @var Escaper
     */
    protected static $escaper = null;

    /**
     * @var string
     */
    protected static $sapi = null;

    /**
     * Get the current value of the debug output environment.
     * This defaults to the value of PHP_SAPI.
     *
     * @return string;
     */
    public static function getSapi()
    {
        if (self::$sapi === null) {
            self::$sapi = PHP_SAPI;
        }
        return self::$sapi;
    }

    /**
     * Set the debug output environment.
     * Setting a value of null causes Zend_Debug to use PHP_SAPI.
     *
     * @param string $sapi
     * @return void;
     */
    public static function setSapi($sapi)
    {
        self::$sapi = $sapi;
    }

    /**
     * Set Escaper instance
     *
     * @param  Escaper $escaper
     */
    public static function setEscaper(Escaper $escaper)
    {
        static::$escaper = $escaper;
    }

    /**
     * Get Escaper instance
     *
     * Lazy loads an instance if none provided.
     *
     * @return Escaper
     */
    public static function getEscaper()
    {
        if (null === static::$escaper) {
            static::setEscaper(new Escaper());
        }
        return static::$escaper;
    }

    /**
     * Debug helper function.  This is a wrapper for var_dump() that adds
     * the <pre /> tags, cleans up newlines and indents, and runs
     * htmlentities() before output.
     *
     * @param  mixed  $var   The variable to dump.
     * @param  string $label OPTIONAL Label to prepend to output.
     * @param  bool   $echo  OPTIONAL Echo output if true.
     * @return string
     */
    public static function dump($var, $label=null, $echo=true)
    {
        // format the label
        $label = ($label===null) ? '' : rtrim($label) . ' ';

        // var_dump the variable into a buffer and keep the output
        ob_start();
        var_dump($var);
        $output = ob_get_clean();

        // neaten the newlines and indents
        $output = preg_replace("/\]\=\>\n(\s+)/m", "] => ", $output);
        if (self::getSapi() == 'cli') {
            $output = PHP_EOL . $label
                    . PHP_EOL . $output
                    . PHP_EOL;
        } else {
            if (!extension_loaded('xdebug')) {
                $output = static::getEscaper()->escapeHtml($output);
            }

            $output = '<pre>'
                    . $label
                    . $output
                    . '</pre>';
        }

        if ($echo) {
            echo $output;
        }
        return $output;
    }

}
