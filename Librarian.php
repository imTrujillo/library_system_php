    <?php
    require_once "./People.php"; 
    class Librarian extends People
    {
        public function __construct($firstname, $lastname, $user, $password)
        {
            parent::__construct($firstname, $lastname, "Librarian", $user, $password);
        }

        public function show_user()
        {
            echo "FirstName: $this->firstname <br> LastName: $this->lastname <br> Roll: $this->roll <br> User: $this->user <br>";
        }

        public function lend_book(User $user, Library $library, $book_id, $loan_date, $return_date, $current_date)
        {
            $book = $library->search_book_by_id($book_id);
            if ($book && !$book->borrowed) {
                $user->borrowed_books++;
                $library->update_book_status($book_id, true);

                $loan = new Loan($loan_date, $return_date, $current_date, $book_id, $user->user_id);
                $loan->create_loan();
                echo "The librarian: '$this->firstname $this->lastname' just lent the book with ID: '$book_id' to '$user->firstname $user->lastname'. <br>";

                $loan->is_book_late();
            } else {
                echo "The book with ID: $book_id isn't available. <br>";
            }
        }


        public function cancel_loan($book_id, User $user, Library $library)
        {
            Loan::cancel_loan($book_id, $user, $library);
        }
    }
    ?>
