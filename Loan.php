<?php
class Loan
{
    public DateTime $loan_date;
    public DateTime $return_date;
    public DateTime $current_date;
    public $state;
    public $user_id;
    public $book_id;
    public static $loans = [];

    public function __construct(string $loan_date, string $return_date, string $current_date, $book_id, $user_id)
    {
        $this->loan_date = new DateTime($loan_date);
        $this->return_date = new DateTime($return_date);
        $this->current_date = new DateTime($current_date);
        $this->book_id = $book_id;
        $this->user_id = $user_id;
        $this->state = "Active";

        self::$loans[] = $this;
    }

    public static function cancel_loan($book_id, User $user, Library $library)
    {
        foreach (self::$loans as $loan) {
            if ($loan->book_id == $book_id && $loan->user_id == $user->user_id && $loan->state === "Active") {
                $loan->state = "Cancelled";
                $user->borrowed_books--;
                $library->update_book_status($book_id, false);
                echo "The loan for book with ID: $book_id is $loan->state. <br>";
                return;
            }
        }
        echo "The loan with userID: $user->user_id and bookID: $book_id wasn't found. <br>";
    }
    public function create_loan()
    {
        self::$loans[] = $this;
        echo "The loan for book with ID: $this->book_id and userID: $this->user_id is added. <br>";
    }
    public function is_book_late(): bool
    {
        if ($this->current_date > $this->return_date) {
            echo "The book borrowed is late. <br>";
            return true;
        } else {
            echo "Remember to return to book before the return date. <br>";
            return false;
        }
    }
}
