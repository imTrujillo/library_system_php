<?php 
class Author 
{
    public $name;
    public $bibliography = [];

    public function __construct($name,$bibliography)
    {
        $this->name = $name;
        $this->bibliography = $bibliography;
    }

    public function show_details_author():void
    {
        $bibliography_string = implode (', ', $this->bibliography); 
        echo "Author: $this->name <br> Bibliography: $bibliography_string.";
    }
}
?>