<?php
class Loan
{
    public DateTime $loan_date;
    public DateTime $return_date;
    public $state;
    public $user_id;
    public $book_title;
    public static $loans = [];

    public function __construct(string $loan_date, string $return_date, $book_title, $user_id)
    {
        $this->loan_date = new DateTime($loan_date);
        $this->return_date = new DateTime($return_date);
        $this->book_title = $book_title;
        $this->user_id = $user_id;
        $this->state = "Active";
    }

    public static function cancel_loan($book_title, User $user):void
    {
        foreach (self::$loans as $loan) {
            if ($loan->book_title == $book_title && $loan->user_id == $user->user_id) {
                $loan->state = "Cancelled";
                $user->borrowed_books--;
                $book['borrowed'] = false;
                echo "The loan for book: $book_title is cancelled. <br>";
                return;
            }
        }
        echo "The loan with userID: $user->user_id and book: $book_title wasn't found. <br>";
    }
    public static function create_loan($loan_date, $return_date, $book_title, $user_id):void
    {
        $loan = new Loan($loan_date, $return_date, $book_title, $user_id);
        self::$loans[] = $loan;
        echo "The loan for book: $book_title and userID: $user_id is added. <br>";
    }
    public function is_book_late($current_date): bool
    {
        $current_date_datetime = new DateTime($current_date);
        if ($current_date_datetime > $this->return_date) {
            echo "The book borrowed is late. <br>";
            return true;
        } else {
            echo "Remember to return to book before the return date. <br>";
            return false;
        }
    }
}
