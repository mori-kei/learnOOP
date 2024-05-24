## **bで書いたコードに対して「より堅牢にするアイデア」があれば回答してください（既にbで思う限りの堅牢性が満たせている場合には「なし」でも構いません）**

- そもそも、PointCalculatorに渡される$resultsはPointクラスやNameクラスを作成し、インスタンスを入れるようにすると値が空だったり、予期せぬ値であることを防ぎ、堅牢性が高まるかもしれない。(DDDの値オブジェクトの考え方を参考にしました)
- 例えばPointクラスは以下のようにする（Nameクラスも実装する）

```php
class Point
{
    private $value;

    public function __construct($value)
    {
        // ポイントが負の値でないことを保証する
        if ($value < 0) {
            throw new InvalidArgumentException("ポイントが負の値です");
        }
        $this->value = $value;
    }
    public function getValue()
    {
        return $this->value;
    }
}

```

そして、このような形で作ると堅牢になるかなと思いました。

```php
$results = [
    ['name' => new Name("鈴木")->getValue(), 'point' => new Point(80)->getValue()], 
    ['name' => new Name("田中")->getValue(), 'point' => new Point(92)->getValue()], 
    ['name' => new Name("佐藤")->getValue(), 'point' => new Point(75)->getValue()] 
];
```