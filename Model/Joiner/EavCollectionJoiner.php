<?php

namespace Mager\Joiner\Model\Joiner;

use Magento\Eav\Model\Entity\Collection\AbstractCollection;
use Exception;

class EavCollectionJoiner extends AbstractJoiner
{
    /**
     * Set the EAV collection
     * 
     * @param \Magento\Eav\Model\Entity\Collection\AbstractCollection $collection
     * @return $this
     * @throws Exception
     */
    public function setCollection($collection)
    {
        if (!$collection instanceof AbstractCollection) {
            throw new Exception('Collection must be instance of \Magento\Eav\Model\Entity\Collection\AbstractCollection');
        }
        
        parent::setCollection($collection);
        
        return $this;
    }
    
    /**
     * Do the join
     * 
     * @see \Magento\Eav\Model\Entity\Collection::joinTable
     */
    public function commit()
    {
        $table = $this->getParamTable();
        $bind = $this->getParamBind();
        $fields = $this->getParamFields();
        $cond = $this->getParamCond();
        $joinType = $this->getParamJoinType();
        
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
     * @throws \Exception
     */
    protected function getParamTable()
    {
        if (isset($this->joinTablename)) {
            if (isset($this->joinTableAlias)) {
                $tableParam = [$this->joinTableAlias => $this->joinTablename];  // todo or is it reverse?
            } else {
                $tableParam = $this->joinTablename;
            }
            return $tableParam;
        } else {
            throw new Exception('Mager_Joiner: Must set tablename with setTablename()');
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
            throw new Exception("Mager_Joiner: Must set on condition with joinOn()");
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
}