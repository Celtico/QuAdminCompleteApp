<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 * @package   Zend_Ldap
 */

namespace Zend\Ldap\Node;

use Zend\Ldap;

/**
 * Zend\Ldap\Node\Collection provides a collection of nodes.
 *
 * @category   Zend
 * @package    Zend_Ldap
 * @subpackage Node
 */
class Collection extends Ldap\Collection
{
    /**
     * Creates the data structure for the given entry data
     *
     * @param  array $data
     * @return \Zend\Ldap\Node
     */
    protected function createEntry(array $data)
    {
        $node = Ldap\Node::fromArray($data, true);
        $node->attachLDAP($this->iterator->getLDAP());
        return $node;
    }

    /**
     * Return the child key (DN).
     * Implements Iterator and RecursiveIterator
     *
     * @return string
     */
    public function key()
    {
        return $this->iterator->key();
    }
}
