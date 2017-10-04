<?php

namespace Mager\Joiner\Model;

use \Magento\Eav\Model\Entity\Collection\AbstractCollection as EavCollection;
use \Magento\Framework\Data\Collection\AbstractDb as NonEavCollection;

class Joiner implements JoinerInterface
{
    /**
     * @var Joiner\EavCollectionJoiner $eavCollectionJoiner
     */
    protected $eavCollectionJoiner;

    /**
     * @var Joiner\NonEavCollectionJoiner $nonEavCollectionJoiner
     */
    protected $nonEavCollectionJoiner;

    /**
     * @var JoinerInterface $chosenJoiner
     */
    protected $chosenJoiner = null;


    /**
     * Joiner constructor.
     * 
     * @param Joiner\EavCollectionJoiner $eavCollectionJoiner
     * @param Joiner\NonEavCollectionJoiner $nonEavCollectionJoiner
     */
    public function __construct
    (
        Joiner\EavCollectionJoiner $eavCollectionJoiner,
        Joiner\NonEavCollectionJoiner $nonEavCollectionJoiner
    )
    {
        $this->eavCollectionJoiner = $eavCollectionJoiner;
        $this->nonEavCollectionJoiner = $nonEavCollectionJoiner;
    }

    /**
     * {@inheritdoc}
     */
    public function setCollection($collection)
    {
        $isEavCollection = $collection instanceof EavCollection;
        $isNonEavCollection = $collection instanceof NonEavCollection;
        
        if ($isEavCollection) {
            $this->chosenJoiner = $this->eavCollectionJoiner;
        } else if ($isNonEavCollection) {
            $this->chosenJoiner = $this->nonEavCollectionJoiner;
        } else {
            throw new \Exception('Mager_Joiner: Must pass a collection to setCollection()');
        }
        
        $this->chosenJoiner->setCollection($collection);
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setJoinTablename($joinTablename)
    {
        $this->chosenJoiner->setJoinTablename($joinTablename);
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setJoinTableAlias($joinTableAlias)
    {
        $this->chosenJoiner->setJoinTableAlias($joinTableAlias);
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setJoinType($joinType)
    {
        $this->chosenJoiner->setJoinType($joinType);
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setJoinOn($joinOn)
    {
        $this->chosenJoiner->setJoinOn($joinOn);
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setJoinWhere($joinWhere)
    {
        $this->chosenJoiner->setJoinWhere($joinWhere);
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setJoinSelectFields($joinSelectFields)
    {
        $this->chosenJoiner->setJoinSelectFields($joinSelectFields);
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function join()
    {
        $this->chosenJoiner->join();
        $this->reset();
    }

    /**
     * Reset joiner back to init state
     */
    protected function reset()
    {
        $this->chosenJoiner = null;
    }
}