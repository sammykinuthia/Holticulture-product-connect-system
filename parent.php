<!DOCTYPE html>
<html lang="en">
<head>
    
</head>
<body>
    

<?php

$host = 'localhost:3306';  
$user = 'root';  
$pass = '';  
$conn = mysqli_connect($host, $user, $pass,"demo");  
if(! $conn )  
{  
  die('Could not connect: ' . mysqli_error());  
} 



class Product{
   public $id;
   public $name;
   public $price;
   public $category;
   public $image;
   public $producerId;
   public $description;

   function product(){
     $sql = "CREATE TABLE IF NOT EXISTS product(id INT AUTO_INCREMENT, name VARCHAR(50), price INT,category VARCHAR(50), image BLOB,producerId INT, description TEXT,PRIMARY KEY (id)";
     if(!mysqli_query($conn,$sql)){
        echo ' product create error';
     }
   }
}
class Producer{
   public $id;
   public $name;
   public $address;
   public $email;
   public $contact;
   public $username;
   public $password;

   }

    function addProduct($name,$price,$category,$userId,$image){
        $sql = "INSERT INTO product (name,price, category,producerId,image) VALUES ($name, $price,$category,$userId, $image);";

        if(mysqli_query($conn,$sql)){
            echo "record added";
        }
        else{
            echo "record add failed";
        }
    
    function producer(){
     $sql = "CREATE TABLE IF NOT EXISTS producer(id INT AUTO_INCREMENT, name VARCHAR(50), address VARCHAR(100),email VARCHAR(50),contact VARCHAR(50), username VARCHAR(50), password VARCHAR(50), UNIQUE (username),PRIMARY KEY (id)";
     if(!mysqli_query($conn,$sql)){
        echo ' product create error';
     }
   }

}
class Consumer{
  public  $id;
  public  $name;
  public  $address;
  public  $email;
  public  $contact;
  public  $username;
  public  $password;

  public function createOrder($products, $consumerId){
    $sql = "INSERT INTO orders (consumerId, products) VALUES ($consumerId,$products);";
    if(mysqli_query($conn,$sql)){
        echo "Order insert success";
    }
    else{
        echo "order insert failed";
    }


  }
  function consumer(){
     $sql = "CREATE TABLE IF NOT EXISTS consumer(id INT AUTO_INCREMENT, name VARCHAR(50), address VARCHAR(100),email VARCHAR(50),contact VARCHAR(50), username VARCHAR(50), password VARCHAR(50), UNIQUE (username),PRIMARY KEY (id)";
     if(!mysqli_query($conn,$sql)){
        echo ' product create error';
     }
   }
    
}
$product = new Product();
$producer = new Producer();
$consumer = new Consumer();
mysqli_close($conn);  
?>
</body>
</html>