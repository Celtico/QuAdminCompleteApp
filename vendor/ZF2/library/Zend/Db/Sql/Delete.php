<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 * @package   Zend_Db
 */

namespace Zend\Db\Sql;

use Zend\Db\Adapter\Adapter;
use Zend\Db\Adapter\StatementContainerInterface;
use Zend\Db\Adapter\ParameterContainer;
use Zend\Db\Adapter\Platform\PlatformInterface;
use Zend\Db\Adapter\Platform\Sql92;

/**
 * @category   Zend
 * @package    Zend_Db
 * @subpackage Sql
 *
 * @property Where $where
 */
class Delete extends AbstractSql implements SqlInterface, PreparableSqlInterface
{
    /**@#+
     * @const
     */
    const SPECIFICATION_DELETE = 'delete';
    const SPECIFICATION_WHERE = 'where';
    /**@#-*/

    /**
     * @var array Specifications
     */
    protected $specifications = array(
        self::SPECIFICATION_DELETE => 'DELETE FROM %1$s',
        self::SPECIFICATION_WHERE => 'WHERE %1$s'
    );

    /**
     * @var string
     */
    protected $table = '';

    /**
     * @var bool
     */
    protected $emptyWhereProtection = true;

    /**
     * @var array
     */
    protected $set = array();

    /**
     * @var null|string|Where
     */
    protected $where = null;

    /**
     * Constructor
     *
     * @param  null|string $table
     */
    public function __construct($table = null)
    {
        if ($table) {
            $this->from($table);
        }
        $this->where = new Where();
    }

    /**
     * Create from statement
     *
     * @param  string $table
     * @return Delete
     */
    public function from($table)
    {
        $this->table = $table;
        return $this;
    }

    public function getRawState($key = null)
    {
        $rawState = array(
            'emptyWhereProtection' => $this->emptyWhereProtection,
            'table' => $this->table,
            'set' => $this->set,
            'where' => $this->where
        );
        return (isset($key) && array_key_exists($key, $rawState)) ? $rawState[$key] : $rawState;
    }

    /**
     * Create where clause
     *
     * @param  Where|\Closure|string|array $predicate
     * @param  string $combination One of the OP_* constants from Predicate\PredicateSet
     * @return Delete
     */
    public function where($predicate, $combination = Predicate\PredicateSet::OP_AND)
    {
        if ($predicate instanceof Where) {
            $this->where = $predicate;
        } elseif ($predicate instanceof \Closure) {
            $predicate($this->where);
        } else {

            if (is_string($predicate)) {
                // String $predicate should be passed as an expression
                $predicate = new Predicate\Expression($predicate);
                $this->where->addPredicate($predicate, $combination);
            } elseif (is_array($predicate)) {

                foreach ($predicate as $pkey => $pvalue) {
                    // loop through predicates

                    if (is_string($pkey) && strpos($pkey, '?') !== false) {
                        // First, process strings that the abstraction replacement character ?
                        // as an Expression predicate
                        $predicate = new Predicate\Expression($pkey, $pvalue);

                    } elseif (is_string($pkey)) {
                        // Otherwise, if still a string, do something intelligent with the PHP type provided

                        if (is_null($pvalue)) {
                            // map PHP null to SQL IS NULL expression
                            $predicate = new Predicate\IsNull($pkey, $pvalue);
                        } elseif (is_array($pvalue)) {
                            // if the value is an array, assume IN() is desired
                            $predicate = new Predicate\In($pkey, $pvalue);
                        } else {
                            // otherwise assume that array('foo' => 'bar') means "foo" = 'bar'
                            $predicate = new Predicate\Operator($pkey, Predicate\Operator::OP_EQ, $pvalue);
                        }
                    } elseif ($pvalue instanceof Predicate\PredicateInterface) {
                        // Predicate type is ok
                        $predicate = $pvalue;
                    } else {
                        // must be an array of expressions (with int-indexed array)
                        $predicate = new Predicate\Expression($pvalue);
                    }
                    $this->where->addPredicate($predicate, $combination);
                }
            }
        }
        return $this;
    }

    /**
     * Prepare the delete statement
     *
     * @param  Adapter $adapter
     * @param  StatementContainerInterface $statementContainer
     * @return void
     */
    public function prepareStatement(Adapter $adapter, StatementContainerInterface $statementContainer)
    {
        $platform = $adapter->getPlatform();
        $parameterContainer = $statementContainer->getParameterContainer();

        if (!$parameterContainer instanceof ParameterContainer) {
            $parameterContainer = new ParameterContainer();
            $statementContainer->setParameterContainer($parameterContainer);
        }

        $table = $platform->quoteIdentifier($this->table);

        $sql = sprintf($this->specifications[self::SPECIFICATION_DELETE], $table);

        // process where
        if ($this->where->count() > 0) {
            $whereParts = $this->processExpression($this->where, $platform, $adapter, 'where');
            $parameterContainer->merge($whereParts->getParameterContainer());
            $sql .= ' ' . sprintf($this->specifications[self::SPECIFICATION_WHERE], $whereParts->getSql());
        }
        $statementContainer->setSql($sql);
    }

    /**
     * Get the SQL string, based on the platform
     *
     * Platform defaults to Sql92 if none provided
     *
     * @param  null|PlatformInterface $adapterPlatform
     * @return string
     */
    public function getSqlString(PlatformInterface $adapterPlatform = null)
    {
        $adapterPlatform = ($adapterPlatform) ?: new Sql92;
        $table = $adapterPlatform->quoteIdentifier($this->table);

//        if ($this->schema != '') {
//            $table = $platform->quoteIdentifier($this->schema) . $platform->getIdentifierSeparator() . $table;
//        }

        $sql = sprintf($this->specifications[self::SPECIFICATION_DELETE], $table);

        if ($this->where->count() > 0) {
            $whereParts = $this->processExpression($this->where, $adapterPlatform, null, 'where');
            $sql .= ' ' . sprintf($this->specifications[self::SPECIFICATION_WHERE], $whereParts->getSql());
        }

        return $sql;
    }

    /**
     * Property overloading
     *
     * Overloads "where" only.
     *
     * @param  string $name
     * @return mixed
     */
    public function __get($name)
    {
        switch (strtolower($name)) {
            case 'where':
                return $this->where;
        }
    }
}
