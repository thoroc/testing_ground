<?php
echo '<h3>show current file</h3>';

show_source( __FILE__ );

abstract class MyIter implements Iterator
{ // you can implement ArrayAccess and Countable interfaces too, this will make class MyIter behave like a "real" array
    private $position = 0; // an internal position of the current element
    // please note that $position has nothing common with $allValues!

    private function getTable()
    { // prepare a temporary "static" table of all objects in the class
        global $allValues;
        $result = array( ); // temporary variable
        foreach( $allValues as $obj )
        {
            if( $obj % 2 == 0 ) // check if the value is even
                $result[] = $obj; // if yes, I want it
        }
        return $result;
    }

    // the all below declared methods are public and belong to the Iterator interface
    public function rewind()
    { // a method to start iterating
        $this->position = 0; // just move to the beginning
    }

    public function current()
    { // retrieves the current element
        $table = $this->getTable(); // let us prepare a table
        return $table[$this->position]; // and return the current element
    }

    public function key()
    { // retrieves the current element's key
        return $this->position; // this is used by foreach(... as $key=>$value), not important here
    }

    public function next()
    { // move to next element
        ++$this->position;
    }

    public function valid()
    { // check if the current element is valid (ie. if it exists)
        return array_key_exists( $this->position, $this->getTable() );
    }
}
// end of class