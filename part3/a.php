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

class RejectedBocchanBookshelf extends Bookshelf {
    public function canAddBook($book){
        return $book->getTitle() !== "坊ちゃん";
    }
}

$book = new Book("坊ちゃん",520);
$book2 = new Book("こころ",876);

$bookshelf = new RejectedBocchanBookshelf;
echo (int)$bookshelf->addBook($book). "\n"; // 0 が出力される
echo (int)$bookshelf->addBook($book2). "\n"; // 1 が出力される

//動作確認用
$foundBook = $bookshelf->findBookByTitle("坊ちゃん");
if ($foundBook !== null) {
    echo "「坊ちゃん」が見つかりました。". "\n";
} else {
    echo "「坊ちゃん」は見つかりませんでした。". "\n";
}//「坊ちゃん」は見つかりませんでしたと出力される

$foundBook = $bookshelf->findBookByTitle("こころ");
if ($foundBook !== null) {
    echo "「こころ」が見つかりました。". "\n";
} else {
    echo "「こころ」は見つかりませんでした。". "\n";
}//「こころ」が見つかりました。と出力される