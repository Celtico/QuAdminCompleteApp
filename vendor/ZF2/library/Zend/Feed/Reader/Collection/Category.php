<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 * @package   Zend_Feed
 */

namespace Zend\Feed\Reader\Collection;

/**
* @category Zend
* @package Zend_Feed_Reader
*/
class Category extends AbstractCollection
{

    /**
     * Return a simple array of the most relevant slice of
     * the collection values. For example, feed categories contain
     * the category name, domain/URI, and other data. This method would
     * merely return the most useful data - i.e. the category names.
     *
     * @return array
     */
    public function getValues()
    {
        $categories = array();
        foreach ($this->getIterator() as $element) {
            if (isset($element['label']) && !empty($element['label'])) {
                $categories[] = $element['label'];
            } else {
                $categories[] = $element['term'];
            }
        }
        return array_unique($categories);
    }

}
