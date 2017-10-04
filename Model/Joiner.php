<?php

namespace Mager\Joiner\Model;

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
        $isEavCollection = $collection instanceof \Magento\Eav\Model\Entity\Collection\AbstractCollection;
        $isNonEavCollection = $collection instanceof \Magento\Framework\Data\Collection\AbstractDb;
        
        if ($isEavCollection) {
            $this->chosenJoiner = $this->eavCollectionJoiner;
        } else if ($isNonEavCollection) {
            $this->chosenJoiner = $this->nonEavCollectionJoiner;
        } else {
            throw new \Exception('Mager_Joiner: Must start with a collection in startWith()');
        }
        
        $this->chosenJoiner->setCollection($collection);
        return $this;
    }

    /**
     * Whether this join has a starting point
     * 
     * @throws \Exception
     */
    protected function verifyStart()
    {
        $isStarted = $this->chosenJoiner !== null;
        if (!$isStarted) {
            throw new \Exception('Mager_Joiner: Must set starting point with startWith() before calling ' . __FUNCTION__);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function setJoinTablename($joinTablename)
    {
        $this->verifyStart();
        $this->chosenJoiner->setJoinTablename($joinTablename);
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setJoinTableAlias($joinTableAlias)
    {
        $this->verifyStart();
        $this->chosenJoiner->setJoinTableAlias($joinTableAlias);
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setJoinType($joinType)
    {
        $this->verifyStart();
        $this->chosenJoiner->setJoinType($joinType);
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setJoinOn($joinOn)
    {
        $this->verifyStart();
        $this->chosenJoiner->setJoinOn($joinOn);
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setJoinWhere($joinWhere)
    {
        $this->verifyStart();
        $this->chosenJoiner->setJoinWhere($joinWhere);
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setJoinSelectFields($joinSelectFields)
    {
        $this->verifyStart();
        $this->chosenJoiner->setJoinSelectFields($joinSelectFields);
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function commit()
    {
        $this->verifyStart();
        $this->chosenJoiner->commit();
        
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