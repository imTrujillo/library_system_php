<?php
class People
{
    public $firstname;
    public $lastname;
    public $roll;
    public $user;
    protected $password;

    public function __construct($firstname,$lastname,$roll,$user,$password)
    {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->roll = $roll;
        $this->user = $user;
        $this->password =$password;
    }
    public function get_password()
    {
        return $this->password;
    }
    public function set_password($password)
    {
        $this->password = $password;
    }

    public function show_user()
    {
        echo "FirstName: $this->firstname <br> LastName: $this->lastname <br> Roll: $this->roll <br> User: $this->user <br>";
    }
}
?>