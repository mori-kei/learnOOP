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
            return false;
        }
        if($this->isRented($book)){
            return false;
        }else{
            $this->rentedBooks[] = $book;
            return true;
        }
    }
    // returnBook(book) 指定の本を返す
    public function returnBook($book) {
        $index = array_search($book, $this->rentedBooks);
        if ($index !== false) {
            unset($this->rentedBooks[$index]);
            return true;
        } else {
            return false;
        }
    }

    // listRentedBooks() 貸し出されている本の一覧を取得する
    public function listRentedBooks() {
        // 貸し出されている本の一覧を表示する処理
        if (empty($this->rentedBooks)) {
            return false;
        } else {
            $rentedBooks = [];
            foreach ($this->rentedBooks as $book) {
                $rentedBooks[] = $book;
            }
            return $rentedBooks;
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
$rentedBooks = $bookshelf->listRentedBooks();
if ($rentedBooks) {
    echo "貸し出し中の本: " . implode(", ", $rentedBooks) . "\n";
} else {
    echo "貸し出し中の本はないです。\n";
}// 「貸出中の本はないです」と出力される

if ($bookshelf->rentBook($book1)) {
    echo "坊ちゃんを借りることができました。\n";
} else {
    echo "坊ちゃんはすでに貸し出されています。\n";
}//「坊ちゃんを借りることができました」と出力される

if ($bookshelf->rentBook($book1)) {
    echo "坊ちゃんを借りることができました。\n";
} else {
    echo "坊ちゃんはすでに貸し出されています。\n";
}//「坊ちゃんはすでに貸し出されています。」と出力される

if ($bookshelf->returnBook($book1)) {
    echo "坊ちゃんを返却しました。\n";
} else {
    echo "坊ちゃんは貸し出されていません。\n";
}// 「坊ちゃんを返却しました。」と出力される

if ($bookshelf->returnBook($book1)) {
    echo "坊ちゃんを返却しました。\n";
} else {
    echo "坊ちゃんは貸し出されていません。\n";
}// 「坊ちゃんは貸し出されていません。」と出力される

if ($bookshelf->rentBook($book1)) {
    echo "坊ちゃんを借りることができました。\n";
} else {
    echo "坊ちゃんはすでに貸し出されています。\n";
}//「坊ちゃんを借りることができました。」と出力される

if ($bookshelf->rentBook($book2)) {
    echo "我輩は猫であるを借りることができました。\n";
} else {
    echo "我輩は猫であるはすでに貸し出されています。\n";
}//「我輩は猫であるを借りることができました。」と出力される

if ($bookshelf->rentBook($book3)) {
    echo "こころを借りることができました\n";
} else {
    echo "この本は本棚にありません。\n";
}//「この本は本棚にありません。」と出力される

$rentedBooks = $bookshelf->listRentedBooks();
if ($rentedBooks) {
    echo "貸し出し中の本:\n";
    foreach ($rentedBooks as $book) {
        echo $book->getTitle() . "\n";
    }
} else {
    echo "貸し出し中の本はありません。\n";
}//「貸し出し中の本:坊ちゃん　我輩は猫である」と出力される