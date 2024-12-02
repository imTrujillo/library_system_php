    <?php
    require_once "./People.php";
    class Librarian extends People
    {
        public function __construct($firstname, $lastname, $user, $password)
        {
            parent::__construct($firstname, $lastname, "Librarian",$user, $password);
        }

        public function lend_book(User $user, Library $library, $title, $loan_date, $return_date,$current_date )
        {
            $book = $library->search_book_by_title($title);
            if($book && !$book['borrowed'])
            {
                $user->borrowed_books++;
                $library->update_book_status($title, true);
                Loan::create_loan($loan_date, $return_date, $title, $user->user_id);
                echo "The librarian: $this->firstname $this->lastname just lent the book $title to $user->firstname $user->lastname. <br>";
                $loan = new Loan($loan_date, $return_date, $title, $user->user_id);
                $loan->is_book_late($current_date);
            }
            else
            {
                echo "The book: $title isn't available";
            }
        }
    }
    ?>
