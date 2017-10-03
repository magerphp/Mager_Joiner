<?php

namespace Mager\Joiner\Model;

use \Magento\Framework\Data\Collection\AbstractDb;
use \Exception;

class NonEavCollectionJoiner extends AbstractJoiner
{
    /**
     * Starting collection
     *
     * @param AbstractDb $collection
     * @return NonEavCollectionJoiner
     * @throws Exception
     */
    public function setCollection($collection)
    {
        if (!$collection instanceof AbstractDb) {
            throw new Exception('Must pass collection to NonEavCollectionJoiner');
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
        
        /**
         * @var \Magento\Framework\DB\Select $select
         */
        $select = $this->collection->getSelect();
        
        $name = $this->getName();
        $cond = $this->getCond();
        $cols = $this->getCols();
        
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
    protected function getName()
    {
        if (isset($this->tablename)) {
            if (isset($this->tableAlias)) {
                $nameParam = [$this->tableAlias => $this->tablename];
            } else {
                $nameParam = $this->tablename;
            }
            
            return $nameParam;
        } else {
            throw new Exception('Mager_Joiner: must set table');
        }
    }

    /**
     * Get the $cond param for joinLeft / joinRight / join
     */
    protected function getCond()
    {
        if (isset($this->joinOn)) {
            
            // todo use $this->joinWhere
            
            return $this->joinOn;
        } else {
            throw new Exception('Mager_Joiner: must set join condition with joinOn()');
        }
    }

    /**
     * Get the $cols param for joinLeft / joinRight / join
     */
    protected function getCols()
    {
        $cols = '*';
        
        // todo is joinSelectFields formatted properly for join?
        if ($this->joinSelectFields) {
            $cols = $this->joinSelectFields;
        }
        
        return $cols;
    }
}
