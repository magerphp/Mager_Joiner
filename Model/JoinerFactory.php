<?php

namespace Mager\Joiner\Model;

class JoinerFactory
{
    /**
     * The thing to build!
     */
    const OBJECT_CLASS = 'Mager\Joiner\Model\Joiner';
    
    
    /**
     * @var ObjectManager $objectManager
     */
    protected $objectManager;


    /**
     * JoinerFactory constructor.
     * 
     * @param \Magento\Framework\ObjectManagerInterface $objectManager
     */
    public function __construct
    (
        \Magento\Framework\ObjectManagerInterface $objectManager
    )
    {
        $this->objectManager = $objectManager;
    }

    /**
     * Create our joiner, potentially from a starting point
     * 
     * @param mixed $startingPoint
     * @return Joiner
     */
    public function create($startingPoint = false)
    {
        // todo have factory return Eav/Non-Eav joiner, and skip Model/Joiner.php all together?
        // todo change startWith to setCollection
        
        /**
         * @var \Mager\Joiner\Model\Joiner $joiner
         */
        $joiner = $this->objectManager->create(self::OBJECT_CLASS);
        if ($startingPoint) {
            $joiner->startWith($startingPoint);
        }
        return $joiner;
    }
}