<?php
require_once "./Library.php";
class BooksManagement extends Library
{

    public function add_book($title,$author,$category)
    {
        $this->books_list[] = 
        ['title' => $title, 'author'=> $author, 'category'=>$category, 'borrowed'=>false] ;
        echo "The book: $title was added. <br>";
    }
    public function delete_book($title)
    {
        foreach ($this->books_list as $key => $book)
        {
            if ($book['title'] == $title)
            {
                unset($this->books_list[$key]);
                echo "The book: $title is deleted. <br>";
                return;
            }
        }
        echo "The book: $title wasn't found. <br>";
    }
    public function update_book($title, $new_title = null, $new_author= null, $new_category = null)
    {
        foreach ($this->books_list as &$book)
        {
            if ($book['title'] == $title)
            {
                if ($new_title) $book['title'] = $new_title;
                if ($new_author) $book['author'] = $new_author;
                if ($new_category) $book['category'] = $new_category;
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
            $display_borrowed = $book['borrowed'] ? "yes" : "no";
            echo "Title: {$book['title']}, Author: {$book['author']}, Category: {$book['category']}, Borrowed: $display_borrowed. <br>";
        }
    }
}
?>