<?php
class Book
{
    public $book_id;
    public $isbn;
    public $title;
    public $year_of_publication;
    public $category;
    public $author;
    public $borrowed;

    public function __construct($book_id, $title, Author $author, $category, $isbn, $year_of_publication)
    {
        $this->book_id = $book_id;
        $this->title = $title;
        $this->author = $author;
        $this->category = $category;
        $this->isbn = $isbn;
        $this->year_of_publication = $year_of_publication;

        $this->author->add_book($this);
    }

}
?>