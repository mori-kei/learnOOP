<?php
class EvenCounter{
    private $count;
    private $evenCount;
    public function __construct()
    {
        $this->count = 0;
    }
    public function getValue(){
        return $this->count;
    }
    public function up() {
        $this->evenCount += 1;
        if($this->evenCount %2 ==0){
            $this->count += 1;
        }
    }
}

$counter = new EvenCounter;
$counter->up(); // => ここではアップしない
$counter->up(); // => ここでアップ

echo $counter->getValue(); // => 1と表示される
echo "\n";

$counter->up(); // => ここではアップしない
$counter->up(); // => ここでアップ

echo $counter->getValue(); // => 2と表示される
echo "\n";