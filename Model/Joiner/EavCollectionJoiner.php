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
    protected $tablename;

    /**
     * @var string $tableAlias
     */
    protected $tableAlias;

    /**
     * @var string $joinType
     */
    protected $joinType;

    /**
     * @var array $joinOn
     */
    protected $joinOn;

    /**
     * @var array $joinSelectFields
     */
    protected $joinSelectFields;
    
    
    /**
     * Starting collection
     *
     * @param $eavCollection
     * @return mixed
     */
    public function startWith($eavCollection)
    {
        // todo put class on param
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
     * The "join on" array ['table1_joinfield' => 'table2_joinfield']
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
                $tableParam = [$this->tableAlias => $this->tablename];
            } else {
                $tableParam = $this->tablename;
            }
            return $tableParam;
        } else {
            throw new \Exception('Must set tablename with setTablename()');
        }
    }
    
    
    protected function getParamBind()
    {
        // todo
        
        return [];
    }


    protected function getParamFields()
    {
        // todo

        return [];
    }

    
    protected function getParamCond()
    {
        // todo

        return [];
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
}