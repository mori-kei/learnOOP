<?php

class Counter{
    private $count;
    public function __construct()
    {
        $this->count = 0;
    }
    public function getValue(){
        return $this->count;
    }
    public function up() {
        $this->count += 1;
    }
    public function down(){
        $this->count -= 1 ;
    }
    public function resetValue(){
        $this->count = 0;
    }
}

$counter = new Counter;
$counter->up();

echo $counter->getValue(); // => 1と表示される
echo "\n";

$counter->down();

echo $counter->getValue(); // => 0と表示される
echo "\n";

$counter->up();

echo $counter->getValue(); // => 1と表示される
echo "\n";

$counter->resetValue();

echo $counter->getValue(); // => 0と表示される
echo "\n";