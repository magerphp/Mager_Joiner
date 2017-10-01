# joiner

## Usage
$collection = $this->someCollectionFactory->create();
$tablename = 'my_custom_table';
$alias = 'my_table';
$on = ['maintable_joinfield' => 'jointable_joinfield'];

$selectFields = [
    'jointable_field1' => 'jointable_field1_alias',  // or is it reverse?
    'jointable_field2' => 'jointable_field2_alias',
];
// or
// $selectFields = ['jointable_field1', 'jointable_field2'];
// or
// $selectFields = 'jointable_field1';


// or is it $joiner = $this->joinerFactory->create($collection);

$this->joiner->startWith($collection)
             ->joinTablename($tablename)
             ->joinType($this->joiner::JOIN_LEFT)   // optional
             ->as($alias)                           // optional
             ->on($on)
             ->selectFields($selectFields)
             ->call();
             
// at this point your $collection is joined to $tablename with $selectFields added to the collection