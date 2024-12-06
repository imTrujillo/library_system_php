<?php 
class Author 
{
    public $name;
    public $bibliography = [];

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function add_book(Book $book)
    {
        $this->bibliography[] = $book->title; 
    }

    public function show_details_author():void
    {
        $bibliography_string = implode (', ', $this->bibliography); 
        echo "Author: $this->name <br> Bibliography: $bibliography_string.";
    }
}
?>