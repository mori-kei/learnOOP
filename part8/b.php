<?php

class Item{
    private $price;
    private $productName;
    
    public function __construct($productName,$price)
    {
        if ($price < 0) {
            throw new InvalidArgumentException("価格は0以上にしてください");
        }
        if (empty($productName)) {
            throw new InvalidArgumentException("商品名は空にできません。");
        }
        
        $this->price = $price;
        $this->productName = $productName;
    }
    
    public function getPrice()
    {
        return $this->price;
    }
    
    public function getProductName()
    {
        return $this->productName;
    }
}

class VendingMachine {
    private $items = [];

    public function addItem(Item $item,int $count){
        for($i =0; $i < $count;$i++){
            array_push($this->items,$item);
        }
    }
    public function buy($productName,$cash){
        if (!$this->canBuy($productName)) {
            throw new InvalidArgumentException("在庫がありません");
        }
        $item = $this->findItemByProductName($productName);
        if ($item->getPrice() > $cash) {
            throw new InvalidArgumentException("金額が不足しています");
        }
        unset($this->items[array_search($item, $this->items)]);
        return $item;
    }
    
    public function canBuy($productName): bool{
        //あとでPHPの配列関数に書き直す
        foreach ($this->items as $item) {
            if ($item->getProductName() === $productName) {
                return true;
            }
        }
        return false;
    }

    public function findItemByProductName($productName){
        foreach($this->items as $item){
            if($item->getProductName() ===$productName)return $item;
        }
        return null;
    }

    public function getItems()
    {
        return $this->items;
    }
}


$item1 = new Item("コカコーラ",120);
$item2 = new Item("綾鷹",100);
$item3 = new Item("ウーロン茶",500);

$vendingMachine = new VendingMachine();

//商品（Item）を複数入れる事ができる。
$vendingMachine->addItem($item1,3);
$vendingMachine->addItem($item2,1);
$vendingMachine->addItem($item3,1);
echo var_dump($vendingMachine->getItems()); //コカコーラが3件、綾鷹,ウーロン茶が１件ずつ返ってくる

//商品を購入
$vendingMachine->buy("コカコーラ",120); //(正常系)
$vendingMachine->buy("綾鷹",110); //(正常系)
$vendingMachine->buy("コカコーラ",119); //(異常系)　cashがItemの価格を下回る場合
$vendingMachine->buy("綾鷹",110); //(異常系)　在庫が0件