<?php

namespace Mager\Joiner\Model;

use \Magento\Eav\Model\Entity\Collection\AbstractCollection;
use \Exception;

class EavCollectionJoiner extends AbstractJoiner
{
    /**
     * Starting collection
     *
     * @param AbstractCollection $collection
     * @return EavCollectionJoiner
     * @throws Exception
     */
    public function setCollection($collection)
    {
        if (!$collection instanceof AbstractCollection) {
            throw new Exception('Must pass EAV collection to EavCollectionJoiner');
        }
        $this->collection = $collection;
        return $this;
    }
    
    /**
     * Do the join
     */
    public function commit()
    {
        $this->verifyStart(__FUNCTION__);
        
        $table = $this->getTable();
        $bind = $this->getBind();
        $fields = $this->getFields();
        $cond = $this->getCond();
        $joinType = $this->getJoinType();
        
        $this->collection->joinTable(
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
     * @throws Exception
     */
    protected function getTable()
    {
        if (isset($this->joinTablename)) {
            if (isset($this->joinTableAlias)) {
                $tableParam = [$this->joinTableAlias => $this->joinTablename];  // todo or is it reverse?
            } else {
                $tableParam = $this->joinTablename;
            }
            return $tableParam;
        } else {
            throw new Exception('Mager_Joiner: Must set tablename with setJoinTablename()');
        }
    }

    /**
     * Get the $bind param for joinTable
     * 
     * @return array
     * @throws Exception
     */
    protected function getBind()
    {
        if (isset($this->joinOn)) {
            return $this->joinOn;
        } else {
            throw new Exception("Mager_Joiner: Must set on condition with setJoinOn()");
        }
    }

    /**
     * Get the $fields param for joinTable
     * 
     * @return array
     * @throws \Exception
     */
    protected function getFields()
    {
        return $this->joinSelectFields;
    }

    /**
     * Get the $cond param for joinTable
     * 
     * @return string
     */
    protected function getCond()
    {
        return $this->joinWhere;
    }

    /**
     * Get the $joinType param for joinTable
     * 
     * @return string
     */
    protected function getJoinType()
    {
        if (isset($this->joinType)) {
            return $this->joinType;
        } else {
            return self::INNER;
        }
    }
}
