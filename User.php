<?php
require_once "./People.php";
class User extends People
{
    public int $user_id;
    public int $borrowed_books;

    function __construct($user_id,$borrowed_books, $firstname,$lastname,$user,$password)
    {
        parent::__construct($firstname,$lastname,"User",$user,$password);
        $this->user_id = $user_id;
        $this->borrowed_books = $borrowed_books;
    }

    public function show_user()
    {
        echo "FirstName: $this->firstname <br> LastName: $this->lastname <br> Roll: $this->roll <br> User: $this->user <br> Borrowed books: $this->borrowed_books. <br> ";
    }
    
}
?>