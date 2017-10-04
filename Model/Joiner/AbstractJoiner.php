<?php

namespace Mager\Joiner\Model\Joiner;

use Mager\Joiner\Model\JoinerInterface;
use Mager\Joiner\Exception\JoinerParamAlreadySetException;

abstract class AbstractJoiner implements JoinerInterface
{
    /**
     * @var $collection
     */
    protected $collection = null;

    /**
     * @var string $joinTablename
     */
    protected $joinTablename = null;

    /**
     * @var string $joinTableAlias
     */
    protected $joinTableAlias = null;

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
     * {@inheritdoc}
     */
    public function setCollection($collection)
    {
        if ($this->collection) {
            throw new JoinerParamAlreadySetException(JoinerParamAlreadySetException::COLLECTION);
        }
        $this->collection = $collection;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setJoinTablename($joinTablename)
    {
        // todo validate
        
        if ($this->joinTablename) {
            throw new JoinerParamAlreadySetException(JoinerParamAlreadySetException::JOIN_TABLE_NAME);
        }
        
        $this->joinTablename = $joinTablename;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setJoinTableAlias($joinTableAlias)
    {
        // todo validate
        
        if ($this->joinTableAlias) {
            throw new JoinerParamAlreadySetException(JoinerParamAlreadySetException::JOIN_TABLE_ALIAS);
        }
        
        $this->joinTableAlias = $joinTableAlias;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setJoinType($joinType)
    {
        // todo validate
        
        if ($this->joinType) {
            throw new JoinerParamAlreadySetException(JoinerParamAlreadySetException::JOIN_TYPE);
        }
        
        $this->joinType = $joinType;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setJoinOn($joinOn)
    {
        // todo validate
        
        if ($this->joinOn) {
            throw new JoinerParamAlreadySetException(JoinerParamAlreadySetException::JOIN_ON);
        }
        
        $this->joinOn = $joinOn;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setJoinWhere($joinWhere)
    {
        // todo validate
        
        if ($this->joinWhere) {
            throw new JoinerParamAlreadySetException(JoinerParamAlreadySetException::JOIN_WHERE);
        }
        
        $this->joinWhere = $joinWhere;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setJoinSelectFields($joinSelectFields)
    {
        // todo validate
        
        if ($this->joinSelectFields) {
            throw new JoinerParamAlreadySetException(JoinerParamAlreadySetException::JOIN_SELECT_FIELDS);
        }
        
        $this->joinSelectFields = $joinSelectFields;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    abstract function commit();

    /**
     * Reset joiner to initial state
     * @return AbstractJoiner
     */
    protected function reset()
    {
        // todo return collection instead of $this?
        
        $this->collection = null;
        $this->joinTablename = null;
        $this->joinTableAlias = null;
        $this->joinType = null;
        $this->joinOn = null;
        $this->joinWhere = null;
        $this->joinSelectFields = null;
        return $this;
    }
}