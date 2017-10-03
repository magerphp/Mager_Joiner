<?php

namespace Mager\Joiner\Model;

use \Magento\Framework\ObjectManagerInterface;
use \Exception;

class JoinerFactory
{
    /**
     * @var ObjectManagerInterface $objectManager
     */
    protected $objectManager;

    /**
     * @var EavCollectionJoinerFactory $eavCollectionJoinerFactory
     */
    protected $eavCollectionJoinerFactory;

    /**
     * @var NonEavCollectionJoinerFactory $nonEavCollectionJoinerFactory
     */
    protected $nonEavCollectionJoinerFactory;


    /**
     * JoinerFactory constructor.
     * 
     * @param ObjectManagerInterface $objectManager
     * @param EavCollectionJoinerFactory $eavCollectionJoinerFactory
     * @param NonEavCollectionJoinerFactory $nonEavCollectionJoinerFactory
     */
    public function __construct
    (
        ObjectManagerInterface $objectManager,
        EavCollectionJoinerFactory $eavCollectionJoinerFactory,
        NonEavCollectionJoinerFactory $nonEavCollectionJoinerFactory
    )
    {
        $this->objectManager = $objectManager;
        $this->eavCollectionJoinerFactory = $eavCollectionJoinerFactory;
        $this->nonEavCollectionJoinerFactory = $nonEavCollectionJoinerFactory;
    }

    /**
     * Create our joiner
     * 
     * @param \Magento\Framework\Data\Collection\AbstractDb|\Magento\Eav\Model\Entity\Collection\AbstractCollection $collection   
     * @return \Mager\Joiner\Model\AbstractJoiner
     * @throws \Exception
     */
    public function create($collection)
    {
        $isEavCollection = $collection instanceof \Magento\Eav\Model\Entity\Collection\AbstractCollection;
        
        // todo \Magento\Framework\Data\Collection\AbstractDb?
        // todo or \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection?
        $isNonEavCollection = $collection instanceof \Magento\Framework\Data\Collection\AbstractDb;

        
        // todo reindex?
        // todo need to create these factories? maybe factories are only auto-created for crud-models?
        
        if ($isEavCollection) {
            $joiner = $this->eavCollectionJoinerFactory->create();
        } else if ($isNonEavCollection) {
            $joiner = $this->nonEavCollectionJoinerFactory->create();
        } else {
            throw new Exception('Mager_Joiner: Must set a collection');
        }

        /**
         * @var \Mager\Joiner\Model\AbstractJoiner $joiner
         */
        $joiner->setCollection($collection);
        
        return $joiner;
    }
}