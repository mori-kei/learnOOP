<?php

class Book
{
    private $title;
    private $page_size;
    public function __construct($title, $page_size)
    {
        $this->title = $title;
        $this->page_size = $page_size;
    }
    public function getTitle()
    {
        return $this->title;
    }
    public function setTitle($value)
    {
        $this->title = $value;
    }
    public function getPageSize()
    {
        return $this->page_size;
    }
    public function setPageSize($value)
    {
        $this->page_size = $value;
    } 
}

class Bookshelf
{
    protected $books = [];
    
    public function addBook($book)
    {
        if (!$this->canAddBook($book)) return false;
        array_push($this->books, $book);
        return true;
    }

    public function findBookByTitle($title)
    {
        foreach ($this->books as $book) {
        if ($book->getTitle() === $title) return $book;
        }
        return null;
    }

    public function sumPageSize()
    {
        $size = 0;
        foreach ($this->books as $book) {
        $size += $book->getPageSize();
        }
        return $size;
    }

    public function size()
    {
        return count($this->books);
    }

    public function canAddBook($book)
    {
        return true; 
    }
}

class RentalBookshelf extends Bookshelf{
    private $rentedBooks = [];
    // isRented(book) 指定の本が貸出中か調べる。貸出中なら真。さもなくば疑。
    public function isRented($book) {
        return in_array($book, $this->rentedBooks);
    }
    // rentBook(book) 指定の本を借りる
    public function rentBook($book){
        if (!$this->findBookByTitle($book->getTitle())) {
            echo "この本は本棚にありません。\n";
            return;
        }
        if($this->isRented($book)){
            echo "既に貸し出されています。\n";
        }else{
            $this->rentedBooks[] = $book;
            echo $book->getTitle() . "を借りことができました". "\n";
        }
    }
    // returnBook(book) 指定の本を返す
    public function returnBook($book) {
        $index = array_search($book, $this->rentedBooks);
        if ($index !== false) {
            unset($this->rentedBooks[$index]);
            echo "返却しました。\n";
        } else {
            echo "この書棚から借りられた本ではないです。\n";
        }
    }
    // listRentedBooks() 貸し出されている本の一覧を取得する
    public function listRentedBooks() {
        // 貸し出されている本の一覧を表示する処理
        if (empty($this->rentedBooks)) {
            echo "貸し出し中の本はないです\n";
        } else {
            echo "貸し出し中の本:\n";
            foreach ($this->rentedBooks as $book) {
                echo $book->getTitle() . "\n";
            }
        }
    }
}

$book1 = new Book("坊ちゃん", 520);
$book2 = new Book("我輩は猫である", 454);
$book3 = new Book("こころ", 876);

$bookshelf = new RentalBookshelf();
$bookshelf->addBook($book1);
$bookshelf->addBook($book2);

//動作確認
$bookshelf->listRentedBooks(); // 「貸出中の本はないです」と出力される
$bookshelf->rentBook($book1); // 「坊ちゃんを借りることができました」と出力される
$bookshelf->rentBook($book1); // 「既に貸し出されています。」と出力される
$bookshelf->returnBook($book1); // 「返却しました。」と出力される
$bookshelf->returnBook($book1); // 「この書棚から借りられた本ではないです」と出力される
$bookshelf->rentBook($book1); // 「坊ちゃんを借りることができました」と出力される
$bookshelf->rentBook($book2); // 「我輩は猫であるを借りることができました」と出力される
$bookshelf->rentBook($book3); // 「この本は本棚にありません。」と出力される
$bookshelf->listRentedBooks(); //貸し出し中の本: 坊ちゃん 我輩は猫である 