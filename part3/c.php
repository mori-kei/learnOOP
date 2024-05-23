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

class LimitedBookShelf extends Bookshelf {
    protected $rejectedCount = 0;
    public function getRejectedCount(){
        return $this->rejectedCount;
    }
    //getRejectedCount動作確認のため、canAddBookを20ページ未満の本しか追加する事ができないようにオーバーライド(課題2を転用)
    public function canAddBook($book){
        $canAdd = $book->getPageSize() < 20;
        if (!$canAdd) {
            $this->rejectedCount++;
        }
        return $canAdd;
    }
}

$book = new Book("坊ちゃん",520);
$book2 = new Book("こころ",19);
//動作確認用
$bookshelf = new LimitedBookShelf;
$bookshelf->addBook($book); //拒否される
$bookshelf->addBook($book2); //拒否されない
echo "Rejected Count: " . $bookshelf->getRejectedCount(). "\n";//１が出力される
$bookshelf->addBook($book);//拒否される
echo "Rejected Count: " . $bookshelf->getRejectedCount(). "\n";//2が出力される



