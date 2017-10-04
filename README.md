# Mager_Joiner

## Description
Wrapper functions for joining to collections in Magento 2.
Provides a set of function calls that are worded more closely to a SQL join,
which to me seem more intuitive than the parameter names provided by core Magento 2.

## Usage
~~~
try {
    /**
     * @var \Mager\Joiner\Model\Joiner $joiner
     */
    $joiner = $this->joinerFactory->create();
    
    $productCollection = $this->productCollectionFactory->create();
    
    // set an EAV or a non-EAV collection. 
    // it determines which Magento join call to make
    $joiner->setCollection($productCollection);
    
    // set the table name (does not take alias)
    $joiner->setJoinTablename('mager_joinertester_product');
    
    // set table alias
    $joiner->setJoinTableAlias('mager_product');
    
    // set join type (OPTIONAL)
    $joiner->setJoinType($joiner::LEFT);
    
    // set join where condition (OPTIONAL)
    $joiner->setJoinWhere
    
    // set the "join on" condition
    $joiner->setJoinOn('product_id = entity_id');
    
    // set the fields to select from the joined table
    $joiner->setJoinSelectFields(['needs_sync']);
    
    // do the join!
    $joiner->commit();
   
} catch (JoinerParamAlreadySetException $jpase) {
    echo "<b>ya done messed up by attempting to reset the " . $jpase->getMessage() . "</b>";
} catch (Exception $e) {
    echo "<b>ya done messed up: " . $e->getMessage() . "</b>";

}
~~~

- You can string function calls together, because each function returns $this
- e.g. 
~~~
$joiner->setCollection($collection)
       ->setJoinTablename($tablename)
       ->setJoinOn($on)
       ...
       ->commit();
~~~

- You can reuse the joiner
~~~
$joiner->setCollection($collection)
       ...
       ->commit();
       
$joiner->setCollection($collection2)
       ...
       ->commit();
~~~



Rob Simmons 2017