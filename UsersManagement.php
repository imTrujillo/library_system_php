<?php
class UsersManagement
{
    public $users = [];

    public function add_user(User $user)
    {
        $this->users[] = $user;
        echo "The user: $user->firstname $user->lastname with ID: $user->user_id is added. <br>";
    }
    public function delete_user($user_id)
    {
        foreach ($this->users as $key => $user)
        {
            if ($user->user_id == $user_id)
            {
                unset($this->users[$key]);
                echo "The user: $user->firstname $user->lastname with ID: $user->user_id is deleted. <br>";
                return;
            }
        }
        echo "The user: $user->firstname $user->lastname with ID: $user->user_id isn't found. <br>";
    }
    public function update_user($user_id, $new_firstname = null, $new_lastname = null, $new_user = null, $new_password = null)
    {
        foreach ($this->users as $user)
        {
            if ($user->user_id == $user_id)
            {
                if ($new_firstname) $user->firstname = $new_firstname;
                if ($new_lastname) $user->lastname = $new_lastname;
                if ($new_user) $user->user = $new_user;
                if ($new_password) $user->set_password($new_password);
                echo "The user: $new_firstname $new_lastname with ID: $user->user_id is updated. <br>";
                return;
            }
        }
        return "The user: $new_firstname $new_lastname with ID: $user->user_id wasn't found. <br>";
    }
    public function show_user()
    {
        foreach ($this->users as $user)
        {
            echo $user->show_user() . "<br>";
        }
    }
}
?>