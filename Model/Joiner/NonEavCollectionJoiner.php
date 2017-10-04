<?php

namespace Mager\Joiner\Model\Joiner;

use Magento\Framework\Data\Collection\AbstractDb;
use Exception;

class NonEavCollectionJoiner extends AbstractJoiner
{
    /**
     * Set the Non-EAV collection
     *
     * @param  $collection
     * @return $this
     * @throws Exception
     */
    public function setCollection($collection)
    {
        if (!$collection instanceof AbstractDb) {
            throw new Exception('Collection must be instance of \Magento\Framework\Data\Collection\AbstractDb');
        }

        return $this;
    }
    
    /**
     * Do the join
     * 
     * @see 
     */
    public function commit()
    {
        /**
         * @var \Magento\Framework\DB\Select $select
         */
        $select = $this->collection->getSelect();
        
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
        if (isset($this->joinTablename)) {
            if (isset($this->joinTableAlias)) {
                $nameParam = [$this->joinTableAlias => $this->joinTablename];
            } else {
                $nameParam = $this->joinTablename;
            }
            
            return $nameParam;
        } else {
            throw new Exception('Mager_Joiner: must set table with setJoinTablename()');
        }
    }

    /**
     * Get the $cond param for joinLeft / joinRight / join
     */
    protected function getParamCond()
    {
        if (isset($this->joinOn)) {
            
            // todo use $this->joinWhere
            
            return $this->joinOn;
        } else {
            throw new \Exception('Mager_Joiner: must set join condition with setJoinOn()');
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
}