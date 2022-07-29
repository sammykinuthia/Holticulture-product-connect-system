<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'horticulture');
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
if($conn === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./style/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container mn-vh-100" style="min-height:85vh">
    <?php require("./components/navbar.php");?>
    
<?php
session_start();
if(!isset($_SESSION['login']) || $_SESSION['login'] != TRUE){
    header("location: login.php");
    exit;
}
if(isset($_POST['view'])){
    $_SESSION['productId'] = $_POST['product'];
    // echo $_POST['product'];
}
$sql = "SELECT product.name as name, producer.name as producer,product.description as description,product.price as price, producer.contact as contact, producer.email as email, producer.address as address, product.image as image FROM product, producer WHERE product.id = '{$_POST['product']}' AND producer.id = product.producerId";
$result = mysqli_query($conn,$sql);

$row = mysqli_num_rows($result);
$item = mysqli_fetch_assoc($result);
  
?>
<?php
if($row <1){
    echo "no records";
    // echo $_SESSION["producerId"];
    exit;
}
?>
    <div class="product row">
        <?php echo "<img class='img col-md-4 col-sm-10' src='data:image/jpg;base64,".base64_encode($item['image'])."' class='img-fluid rounded-start'>"?>
        
        <div class="product-detail col-md-4 col-sm-10">
            <div class="card-body">
                <div>
               <p class="h3 mt-0 pt-0 text-capitalize card-title text-primary"><?php echo $item['name'] ?></p>
               <hr>
                <p class="card-text"><?php echo $item['description']?></p>
                <b><p class="card-text">Ksh: <?php echo $item['price']?></p></b>
                </div>
                <form action="remove.php" method="post">
                <input type="hidden" name="remove" value="<?php  $_SESSION['productId']?>" >
                <?php
                if($_SESSION["membership"] == "producer"){
                }
                ?>
                <button name='remove' class='btn btn-primary my-5' type='submit'>Remove</button>
                <form>
            </div>
        </div>
        <div class="producer col-md-4 col-sm-10">
            <h3 class="pt-2 text-capitalize text-primary"><?php echo $item['producer']?></h3>
            <hr>
                <a class="d-block" href="mailto:<?php echo $item['email'] ?>" target='_blank' class="btn text-primary"><i class="bi text-primary bi-envelop"></i> <?php echo $item['email'] ?></a>
                <a href="<?php echo $item['contact']?>" class="d-block"><i class="bi text-primary bi-telephone"></i><?php echo $item['contact']?> </a>
            
                <p class=""><i class="bi text-primary bi-geo-alt"></i> <?php echo $item['address']?></p>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <label class="form-label" for="mail">Connect with the Seller</label>
                <input type="text" name="mail" id="mail" class="form-control">
                <button name="send" class="btn btn-light text-primary h3" type="submit"><i class="bi bi-send-fill"></i>send</button>
                
            </form>

        </div>
    </div>

    </div>
   <?php
   if(isset($_POST['name'])){
       $text = $_POST['mail'];
       mail($item['email'],$item['name'],$text);
       echo "<h3 class='text-success bg-warning p-2'>Thanks for reaching out</h3>";
   }
//    echo $_SESSION["productId"];
    require("./components/footer.php") ;?>
  
</body>
</html>