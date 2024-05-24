<?php

class PointCalculator {
    private $results = [];
    public function __construct($results)
    {
        $this->results = $results;
    }
    public function getTotalPoint(){
        $total = 0;
        foreach($this->results as $result){
            $total += $result['point'];
        }
        return $total;
    }
    public function getAvaragePoint(){
        $total = $this->getTotalPoint();
        $count = count($this->results);
        if ($count === 0) {
            return 0; 
        }
        return $total / $count;
    }
    public function findMaxPointName(){
        $maxPoint = 0;
        $maxName = '';
        foreach ($this->results as $result) {
            if ($result['point'] > $maxPoint) {
                $maxPoint = $result['point'];
                $maxName = $result['name'];
            }
        }
        return $maxName;
    }
    public function addResult($result){
        $this->results[] = $result;
    }
}

$results = [
    ['name' => '鈴木', 'point' => 80], 
    ['name' => '田中', 'point' => 92], 
    ['name' => '佐藤', 'point' => 75] 
];

$calculator = new PointCalculator($results);

// 全員のpointの合計を求める
$total = $calculator->getTotalPoint();
echo "全員のポイントの合計: " . $total . "\n";

// 全員のpointの平均を求める
$average = $calculator->getAvaragePoint();
echo "全員のポイントの平均: " . $average . "\n";

// 最高得点の人を検索してnameを得る
$maxName = $calculator->findMaxPointName();
echo "最高得点の人: " . $maxName . "\n";

// 新たな結果を追加して上記を改めて計算する
$newResult = ['name' => '阿部', 'point' => 95];
$calculator->addResult($newResult);

// 再度計算
$total = $calculator->getTotalPoint();
echo "全員のポイントの合計: " . $total . "\n";

$average = $calculator->getAvaragePoint();
echo "全員のポイントの平均: " . $average . "\n";

$maxName = $calculator->findMaxPointName();
echo "最高得点の人: " . $maxName . "\n";