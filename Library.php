    <?php
    include_once "./BooksManagement.php";
    include_once "./Author.php";
    include_once "./Librarian.php";
    include_once "./Loan.php";
    include_once "./People.php";
    include_once "./User.php";
    include_once "./UsersManagement.php";
    include_once "./Book.php";

    class Library
    {
        public $books_list = [];

        public function __construct($books_list = [])
        {
            $this->books_list = $books_list;
        }

        public function search_book_by_title($title)
        {
            foreach ($this->books_list as &$book) {
                if ($book->title == $title && $book->borrowed == false) {
                    return $book;
                }
            }
            return null;
        }
        public function search_book_by_id($book_id)
        {
            foreach ($this->books_list as &$book) {
                if ($book->book_id == $book_id && $book->borrowed == false) {
                    return $book;
                }
            }
            return null;
        }
        public function search_book_by_category($category)
        {
            $book_list_search = [];
            foreach ($this->books_list as $book) {
                if ($book->category == $category && $book->borrowed == false) {
                    $book_list_search[] = $book;
                }
            }
            if (!empty($book_list_search)) {
                return $book_list_search;
            }
            return "The books aren't available <br>";
        }

        public function update_book_status($book_id,$status)
        {
            foreach($this->books_list as &$book)
            {
                if ($book->book_id == $book_id)
                {
                    $book->borrowed = $status;
                    return true;
                }
            }
            return false;
        }
    }



    echo "<h2>Manage Books and manage authors</h2> <br>";
    $jose = new Author("Jose Saramago"); //create an author
    $antonio  = new Author("Antoine d'Exupery");
    $anonimo = new Author("Anonimo");
    $book = new Book(1,"El Principito", $antonio, "Fantasy", "255-000-123-24", "1943");//create a book
    $book2 = new Book(2,"Fabulas de Esopo", $anonimo, "Fantasy", "255-034-234-123", "-4000aC.");
    $book3 = new Book(3,"Ensayo sobre la Ceguera", $jose, "Philosophy", "123-434-234-234", "1995");
    $book4 = new Book(4,"Lazarrrrillo de Tormes", $anonimo, "Novela Picaresca", "234-432-657-234", "1554");
    echo "<br>";

    $library = new BooksManagement(); //create the library
    $library->add_book($book); //add books
    $library->add_book($book2);
    $library->add_book($book3);
    $library->add_book($book4);
    echo "<br>";
    $library->show_books(); //show all the books
    echo "<br>";
    $library->update_book("Lazarrrrillo de Tormes",4, "Lazarillo de Tormes", "anonimo", "Novela Picaresca"); //update a book
    echo "<br>";
    $library->delete_book(3); //delete a book
    echo "<br>";
    $library->show_books();
    echo "<br>";
    $jose->show_details_author(); //show author data
    echo "<br>";


    echo "<h2>Manage users </h2><br>";
    $users = new UsersManagement(); //creater the users manager
    $pedro = new User(1234, 5, "Pedro", "Navaja", "pedro123", 123456); //create a user
    $users->add_user($pedro); //add a user to the database
    $pedro->show_user(); //show user data
    echo "<br>";
    $steven = new User(12345, 4, "Steven", "Trujillo", "steven123", 1234);
    $users->add_user($steven);
    $steven->show_user();
    echo "<br>";
    $users->update_user(12345, "Josue", "Cuellar", "josue123", 123435); //update a user with his id
    echo "<br>";
    $steven->show_user();
    echo "<br>";
    $users->delete_user(12345); //delete a user with his id
    echo "<br>";


    echo "<h2>Search and lend books</h2> <br>";
    print_r($library->search_book_by_title('Fabulas de Esopo') ); //search a book by title
    echo "<br>";
    print_r($library->search_book_by_title('El Principito') );
    echo "<br>";
    print_r($library->search_book_by_id(2) );
    echo "<br>";
    print_r($library->search_book_by_category("Fantasy")) ; //search a book by category
    echo "<br>";

    
    echo "<h2>Librarian and Manage Loans</h2> <br>";
    $librarian = new Librarian("Maybelline", "Chávez", "may1234", 12345); //create a librarian
    echo "<br>";
    $librarian->show_user(); //show the librarian data
    echo "<br>";
    $librarian->lend_book($pedro,$library,$book->book_id,"2024-12-01 8:00:00", "2024-12-15 8:00:00","2024-12-16 8:00:00", ); //the librarian lends the book to the user
    echo "<br>";
    $librarian->lend_book($pedro, $library, $book2->book_id,"2024-12-01 8:00:00", "2024-12-15 8:00:00", "2024-12-16 8:00:00");
    echo "<br>";
    $pedro->show_user();
    echo "<br>";
    $librarian->cancel_loan(2,$pedro,$library);//cancel the user loan
    echo "<br>";
    $library->show_books();
    echo "<br>";
    $pedro->show_user();
    echo "<br>";
    ?>