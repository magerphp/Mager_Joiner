<?php

namespace Mager\Joiner\Model\Joiner;

use Mager\Joiner\Model\JoinerInterface;

class NonEavCollectionJoiner implements JoinerInterface
{
    /**
     * todo type?
     * 
     * @var $nonEavCollection
     */
    protected $nonEavCollection = null;

    /**
     * @var string $tablename
     */
    protected $tablename = null;

    /**
     * @var string $tableAlias
     */
    protected $tableAlias = null;

    /**
     * @var string $joinType
     */
    protected $joinType = null;

    /**
     * @var string $joinOn
     */
    protected $joinOn = null;

    /**
     * @var string $joinWhere
     */
    protected $joinWhere = null;

    /**
     * @var array $joinSelectFields
     */
    protected $joinSelectFields = null;
    
    
    /**
     * Starting collection
     *
     * @param $nonEavCollection
     * @return mixed
     */
    public function startWith($nonEavCollection)
    {
        // todo validate
        $this->nonEavCollection = $nonEavCollection;
        return $this;
    }

    /**
     * Whether this join has a starting point
     *
     * @throws \Exception
     */
    protected function verifyStart()
    {
        $isStarted = $this->nonEavCollection !== null;
        if (!$isStarted) {
            throw new \Exception('Mager_Joiner: Must set non-eav collection with startWith() before calling ' . __FUNCTION__);
        }
    }

    /**
     * The table to join to
     *
     * @param string $tablename
     * @return mixed
     */
    public function joinTablename($tablename)
    {
        // todo validate
        $this->verifyStart();
        $this->tablename = $tablename;
        return $this;
    }

    /**
     * The alias for the table to join to
     *
     * @param string $alias
     * @return mixed
     */
    public function joinTableAlias($alias)
    {
        // todo validate
        $this->verifyStart();
        $this->tableAlias = $alias;
        return $this;
    }

    /**
     * The join direction: left, right, inner
     *
     * @param $type
     * @return mixed
     */
    public function joinType($type)
    {
        // todo validate
        $this->verifyStart();
        $this->joinType = $type;
        return $this;
    }

    /**
     * The "join on" string 'table1_joinfield = table2_joinfield'
     *
     * @param $on
     * @return mixed
     */
    public function joinOn($on)
    {
        // todo validate
        $this->verifyStart();
        $this->joinOn = $on;
        return $this;
    }

    /**
     * Additional "join on"(?) 
     * passed to $cond param of \Magento\Eav\Model\Entity\Collection\AbstractCollection::joinTable()
     * 
     * @see \Magento\Eav\Model\Entity\Collection\AbstractCollection::joinTable()
     * @param $where
     * @return mixed
     */
    public function joinWhere($where)
    {
        // todo validate
        $this->verifyStart();
        $this->joinWhere = $where;
        return $this;
    }

    /**
     * Array of fields to select from the joined table
     *
     * @param $selectFields
     * @return mixed
     */
    public function joinSelectFields($selectFields)
    {
        // todo validate
        $this->verifyStart();
        $this->joinSelectFields = $selectFields;
        return $this;
    }

    /**
     * Do the join
     */
    public function call()
    {
        $this->verifyStart();
        
        /**
         * @var \Magento\Framework\DB\Select $select
         */
        $select = $this->nonEavCollection->getSelect();
        
        $name = $this->getParamName();
        $cond = $this->getParamCond();
        $cols = $this->getParamCols();
        
        switch ($this->joinType) {
            case self::LEFT:
                $select->joinLeft($name, $cond, $cols);
                break;
                
            case self::RIGHT:
                $select->joinRight($name, $cond, $cols);
                break;
                
            default:
                $select->join($name, $cond, $cols);
        }
        
        $this->reset();
    }

    /**
     * Get the $name param for joinLeft / joinRight / join
     */
    protected function getParamName()
    {
        if (isset($this->tablename)) {
            if (isset($this->tableAlias)) {
                $nameParam = [$this->tableAlias => $this->tablename];
            } else {
                $nameParam = $this->tablename;
            }
            
            return $nameParam;
        } else {
            throw new \Exception('Mager_Joiner: must set table');
        }
    }

    /**
     * Get the $cond param for joinLeft / joinRight / join
     */
    protected function getParamCond()
    {
        if (isset($this->joinOn)) {
            return $this->joinOn;
        } else {
            throw new \Exception('Mager_Joiner: must set join condition with joinOn()');
        }
    }

    /**
     * Get the $cols param for joinLeft / joinRight / join
     */
    protected function getParamCols()
    {
        $cols = '*';
        
        // todo is joinSelectFields formatted properly for join?
        if ($this->joinSelectFields) {
            $cols = $this->joinSelectFields;
        }
        
        return $cols;
    }
    
    /**
     * Reset joiner to initial state
     */
    protected function reset()
    {
        $this->nonEavCollection = null;
        $this->tablename = null;
        $this->tableAlias = null;
        $this->joinType = null;
        $this->joinOn = null;
        $this->joinWhere = null;
        $this->joinSelectFields = null;
    }
}