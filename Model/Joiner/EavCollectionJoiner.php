<?php

namespace Mager\Joiner\Model\Joiner;

use Mager\Joiner\Model\JoinerInterface;

class EavCollectionJoiner implements JoinerInterface
{
    /**
     * todo type?
     * 
     * @var $eavCollection
     */
    protected $eavCollection = null;

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
     * @param $eavCollection
     * @return mixed
     */
    public function startWith($eavCollection)
    {
        // todo validate
        $this->eavCollection = $eavCollection;
        return $this;
    }

    /**
     * Whether this join has a starting point
     *
     * @throws \Exception
     */
    protected function verifyStart()
    {
        $isStarted = $this->eavCollection !== null;
        if (!$isStarted) {
            throw new \Exception('Mager_Joiner: Must set eav collection with startWith() before calling ' . __FUNCTION__);
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
        
        $table = $this->getParamTable();
        $bind = $this->getParamBind();
        $fields = $this->getParamFields();
        $cond = $this->getParamCond();
        $joinType = $this->getParamJoinType();
        
        $this->eavCollection->joinTable(
            $table,
            $bind,
            $fields,
            $cond,
            $joinType
        );
        
        $this->reset();
    }

    /**
     * Get the $table param for joinTable
     * 
     * @return array|string
     * @throws \Exception
     */
    protected function getParamTable()
    {
        if (isset($this->tablename)) {
            if (isset($this->tableAlias)) {
                $tableParam = [$this->tableAlias => $this->tablename];  // todo or is it reverse?
            } else {
                $tableParam = $this->tablename;
            }
            return $tableParam;
        } else {
            throw new \Exception('Mager_Joiner: Must set tablename with setTablename()');
        }
    }

    /**
     * Get the $bind param for joinTable
     * 
     * @return array
     * @throws \Exception
     */
    protected function getParamBind()
    {
        if (isset($this->joinOn)) {
            return $this->joinOn;
        } else {
            throw new \Exception("Mager_Joiner: Must set on condition with joinOn()");
        }
    }

    /**
     * Get the $fields param for joinTable
     * 
     * @return array
     * @throws \Exception
     */
    protected function getParamFields()
    {
        return $this->joinSelectFields;
    }

    /**
     * Get the $cond param for joinTable
     * 
     * @return string
     */
    protected function getParamCond()
    {
        return $this->joinWhere;
    }

    /**
     * Get the $joinType param for joinTable
     * 
     * @return string
     */
    protected function getParamJoinType()
    {
        if (isset($this->joinType)) {
            return $this->joinType;
        } else {
            return self::INNER;
        }
    }

    /**
     * Reset joiner to initial state
     */
    protected function reset()
    {
        $this->eavCollection = null;
        $this->tablename = null;
        $this->tableAlias = null;
        $this->joinType = null;
        $this->joinOn = null;
        $this->joinWhere = null;
        $this->joinSelectFields = null;
    }
}