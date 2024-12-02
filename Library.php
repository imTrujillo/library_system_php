    <?php
    include_once "./BooksManagement.php";
    include_once "./Author.php";
    include_once "./Librarian.php";
    include_once "./Loan.php";
    include_once "./People.php";
    include_once "./User.php";
    include_once "./UsersManagement.php";

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
                if ($book['title'] == $title && $book['borrowed'] == false) {
                    return $book;
                }
            }
            return null;
        }
        public function search_book_by_category($category)
        {
            $book_list_search = [];
            foreach ($this->books_list as $book) {
                if ($book['category'] == $category && $book['borrowed'] == false) {
                    $book_list_search[] = $book;
                }
            }
            if (!empty($book_list_search)) {
                return $book_list_search;
            }
            return "The books aren't available <br>";
        }

        public function update_book_status($title,$status)
        {
            foreach($this->books_list as &$book)
            {
                if ($book['title'] == $title)
                {
                    $book['borrowed'] = $status;
                    return true;
                }
            }
            return false;
        }
    }

    echo "<h2>Manage Books</h2> <br>";
    $library = new BooksManagement(); //create the books manager
    $library->add_book("El Principito", "Antoine d'Exupery", "Fantasy"); //add books
    $library->add_book("Fabulas de Esopo", "anonimo", "Fantasy");
    $library->add_book("Ensayo sobre la Ceguera", "Jose Saramago", "Philosophy");
    $library->add_book("Lazarillo de Tormes", "anónimo", "Novela Picaresca");
    $library->show_books(); //show all the books
    $library->update_book("Lazarillo de Tormes", "Lazarillo de Tormes", "anonymous", "Prose fiction"); //update a book
    $library->delete_book("Ensayo sobre la Ceguera"); //delete a book
    $library->show_books();

    echo "<h2>Manage users </h2><br>";
    $users = new UsersManagement(); //creater the users manager
    $pedro = new User(1234, "2006-04-26 00:00:00", 5, "Pedro", "Navaja", "pedro123", 123456); //create a user
    $users->add_user($pedro); //add a user to the user management
    $pedro->show_user(); //show user data
    $steven = new User(12345, "2007-08-06 00:00:00", 4, "Steven", "Trujillo", "steven123", 1234);
    $users->add_user($steven);
    $steven->show_user();
    $users->update_user(12345, "Josue", "Cuellar", "josue123", 123435); //update a user with his id
    $steven->show_user();
    $users->delete_user(12345); //delete a user with his id

    echo "<h2>Search and lend books</h2> <br>";
    print_r($book = $library->search_book_by_title('Fabulas de Esopo') ); //search a book by title
    echo "<br>";
    print_r($book2 = $library->search_book_by_title('El Principito') );
    echo "<br>";
    print_r($books_result = $library->search_book_by_category("Fantasy")) ; //search a book by category
    echo "<br>";

    echo "<h2>Librarian and Manage Loans</h2> <br>";
    $librarian = new Librarian("Maybelline", "Chávez", "may1234", 12345); //create a librarian
    $librarian->show_user(); //show the librarian data
    $librarian->lend_book($pedro,$library,$book['title'],"2024-12-01 8:00:00", "2024-12-15 8:00:00","2024-12-16 8:00:00"); //the librarian lends the book to the user
    $librarian->lend_book($pedro, $library, $book2['title'],"2024-12-01 8:00:00", "2024-12-15 8:00:00", "2024-12-16 8:00:00");
    $pedro->show_user();
    $library->show_books();
    Loan::cancel_loan($book['title'], $pedro); //cancel the user loan
    $pedro->show_user();

    echo "<h2>See Author Details</h2> <br>";
    $mario = new Author("Mario Aven", ["Mente del León", "Sé tu Mejor Versión"]); //create an author
    $mario->show_details_author(); //show author data
    ?>