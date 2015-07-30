<?php
class Acceptform{
public $fname;

public function __construct(){
$this->fname = $_POST['fname'];


}
}

class Max extends Acceptform{ 
public function reveal(){
 echo $this->fname;


}
}


?>