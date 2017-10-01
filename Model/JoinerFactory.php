<?php

namespace Mager\Joiner\Model;

use Magento\Framework\App\ObjectManager;

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
     * @param ObjectManager $objectManager
     */
    public function __construct
    (
        ObjectManager $objectManager
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