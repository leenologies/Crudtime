<?php
//PARENT CLASS
class Crud{
     //VARIABLE TO STORE PDO OBJECT
     public $db;
     
     public function __construct(){
     $this->db = $db;
    }
    
    //FUNCTION CONNECTS TO THE DATABASE
    public function ConnectDB(){
    $dsn = 'mysql:host=localhost;dbname=theShop';
    $user = 'root';
    $password = 'portmore38';
    
    try{
    //ASSIGNMENT OF $db TO OBJECT PDO
    $this->db = new PDO($dsn,$user,$password);
    //echo 'Connection Successfull';
    $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    }catch(PDOException $e){
       echo 'Error is : '.$e->getMessage();    
    }
  }
}

//CHILD CLASS OF CRUD
class InsertRec extends Crud{
   public $fname;
   public $email;
   public $address;
   public $city;
   public $zip;
   public $id;
   public $searchkey;   


public function __construct(){
$this->searchkey = $_POST['searchIt'];
$this->searchEdkey = $_POST['editIt'];
$this->fname=$_POST['fname'];
$this->email=$_POST['email'];
$this->address=$_POST['address'];
$this->city=$_POST['city'];
$this->zip=$_POST['zip'];
$this->id =rand(100000000,999999999);
}



//FUNCTION FOR CREATING NEW CUSTOMER RECORDS
public function insertRec(){

$this->ConnectDB();

$sql = 'INSERT INTO shopCustomer(cust_id,cust_name,cust_email,cust_address,cust_city,cust_zip)
         VALUES(:cust_id,:cust_name,:cust_email,:cust_address,:cust_city,:cust_zip)';
$stm = $this->db->prepare($sql);
$stm->execute(array(':cust_id'=>$this->id,
                    ':cust_name'=>$this->fname,
                    ':cust_email'=>$this->email,
                     ':cust_address'=>$this->address,
                      ':cust_city'=>$this->city,
                      ':cust_zip'=>$this->zip
                      ));
                      
                      }


//FUNCTION FOR SANITIZING INPUT FROM SEARCH FIELDS
public function cleanUp(){

if(empty($this->searchkey)){
   echo "field is required";
}else{
$keysearch = filter_var($this->searchkey,FILTER_SANITIZE_MAGIC_QUOTES);
}
return $keysearch;

}

//FUNCTION TO USE CUSTOMER ID TO SEARCH FOR RECORD AND TO DISPLAY RECORD
public function toQuery(){
$this->ConnectDB();
$keysearch=$this->cleanUp();

//QUERY TO DATABASE TO SEARCH FOR  A MATCH WITH USER INPUT KEYSEARCH
$sql="SELECT * FROM shopCustomer WHERE cust_id='$keysearch'";
         
         
 //var_dump($this->db);
         
foreach($this->db->query($sql) as $row){
  
  
  //CHECKS IF THE INPUT FROM CUSTOMER INPUT MATCHES AN ID IN DATABASE
  if($keysearch==$row['cust_id']){
  //DISPLAY FOR RECORDS FOUND BY SEARCH WITH CUSTOMER ID
  $id = $row['cust_id'];
  $name = $row['cust_name'];
  $email = $row['cust_email'];
  $address = $row['cust_address'];
  $city = $row['cust_city'];
  $zip = $row['cust_zip'];
  
  echo "<h1>Customer Record</h1><br>";
  echo '<strong>Customer ID:</strong> '.$row['cust_id'].'<br>';
  echo '<strong>Customer Name:</strong> '.$row['cust_name'].'<br>';
  echo '<strong>Customer Email:</strong> '.$row['cust_email'].'<br>';
  echo '<strong>Customer Address:</strong> '.$row['cust_address'].'<br>';
  echo '<strong>Customer City:</strong> '.$row['cust_city'].'<br>';
  echo  '<strong>Customer Zipcode:</strong> '.$row['cust_zip'].'<br>';
  echo '<button type="button"  name="edit_btn">Edit Record</button>';
  echo '<button type="button"  name="delete_btn">Delete Record</button>';
  
     
  }else {
   echo 'Butta Bread';
  
  }
}
}
}
 
//EDITS A RECORD BY SEARCH CUST_ID 
class EditRec extends Crud{

public function edit_rec(){
$this->ConnectDB();
echo $searchEdkey;
//$keysearch=$this->cleanUp();

//QUERY TO DATABASE TO SEARCH FOR  A MATCH WITH USER INPUT KEYSEARCH
$sql="SELECT * FROM shopCustomer WHERE cust_id='$keysearch'";
         
foreach($this->db->query($sql) as $row){
  
  
  //CHECKS IF THE INPUT FROM CUSTOMER INPUT MATCHES AN ID IN DATABASE
  if($keysearch==$row['cust_id']){
  //DISPLAY FOR RECORDS FOUND BY SEARCH WITH CUSTOMER ID
  echo '<h1>Edit Record</h1><br>';
  echo '<form action="Crud.php" method="POST" />';
  echo 'Name: <input type="text" name="fname" value="$name" />';
  echo 'Email: <input type="text" name="email" value="$email" />';
  echo 'Address: <input type="text" name="address" value="$address" />';
  echo 'City: <input type="text" name="city" value="$city" />';
  echo 'Zipcode: <input type="text" name="zip" value="$zip" />';
  echo  '<input type="submit" value="Save" onclick="<?php $a->new Crud;
  $b = new InsertRec();
  $b-SendBase() ?>"/>';
  echo '</form>';
  
  $this->fsname = $_POST['fname'];
  $this->fsemail = $_POST['email'];
  $this->fsaddress = $_POST['address'];
  $this->fscity = $_POST['fscity'];
  $this->fszip = $_POST['fszip'];
     
  }else {
   echo 'Butta Bread';
  
  }
}
}

public function SendBase(){
$this->edit_rec();
$this->ConnectDB();
$keysearch=$this->cleanUp();

$sql= 'UPDATE shopCustomer
SET cust_name="$this->fsname",
    cust_email="$this->fsemail",
    cust_address="$this->fsaddress",
    cust_city="$this->fscity",
    cust_zip="$this->fszip",
WHERE cust_id = "$$this->keysearch"';
     
     
}


}




$a = new Crud();
//$a->ConnectDB();
$b = new InsertRec();
$c = new EditRec();
$c->edit_rec();
?>