<?php

class Counter {
  private $value;

  public function __construct() {
    $this->value = 0;
  }
  public function getValue(){
    return $this->value;
  }
  public function incrementValue(){
    $this->value ++;
  }
  public function decrimentValue(){
    $this->value --;
  }
}

$counter = new Counter; // 数値をカウントアップするクラス
$counter->incrementValue();
echo $counter-> getValue()  . "\n";
$counter->decrimentValue();
echo $counter-> getValue()  . "\n";