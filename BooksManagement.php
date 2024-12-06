<?php
require_once "./Library.php";
class BooksManagement extends Library
{

    public function add_book(Book $book)
    {
        $this->books_list[] = $book;
        $book->borrowed = false;
        echo "The book: '$book->title' with ID: '$book->book_id' was added. <br>";
    }
    public function delete_book($book_id)
    {
        foreach ($this->books_list as $key => $book)
        {
            if ($book->book_id == $book_id)
            {
                unset($this->books_list[$key]);
                echo "The book with ID: '$book_id' is deleted. <br>";
                return;
            }
        }
        echo "The book with ID: '$book_id' wasn't found. <br>";
    }
    public function update_book($title,$new_book_id = null, $new_title = null, $new_author= null, $new_category = null, $new_isbn = null, $new_year_of_publication = null)
    {
        foreach ($this->books_list as &$book)
        {
            if ($book->title == $title)
            {
                if ($new_book_id) $book->book_id = $new_book_id;
                if ($new_title) $book->title = $new_title;
                if ($new_author) $book->author->name = $new_author;
                if ($new_category) $book->category = $new_category;
                if ($new_isbn) $book->isbn=$new_isbn;
                if ($new_year_of_publication) $book->year_of_publication = $new_year_of_publication;
                echo "The book: $title is updated. <br>";
                return;
            }
        }
        return "The book: $title wasn't found.";
    }
    public function show_books()
    {
        foreach ($this->books_list as $book)
        {
            $display_borrowed = $book->borrowed ? "yes" : "no";
            echo "Title: {$book->title}, ID: {$book->book_id}, Author: {$book->author->name}, Category: {$book->category}, ISBN: {$book->isbn}, Year of Publication: {$book->year_of_publication} Borrowed: $display_borrowed. <br>";
        }
    }
}
?>