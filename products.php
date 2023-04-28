<?php
session_start();
?>
<?php
include_once "config.php";

if(isset($_SESSION['admin_name'])){
    $user_name = $_SESSION['admin_name'];
}
elseif(isset($_SESSION['user_name'])){
    $user_name = $_SESSION['user_name'];
}

if((isset($_SESSION['admin_name']))||(isset($_SESSION['user_name']))){

$check_table_query = mysqli_query($conn, "SHOW TABLES LIKE 'cart_$user_name'");
    if(mysqli_num_rows($check_table_query) == 0) {
        $create_table_query = mysqli_query($conn, "CREATE TABLE `cart_$user_name` (
           id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
           name VARCHAR(30) NOT NULL,
           price VARCHAR(100) NOT NULL,
           image VARCHAR(100) NOT NULL,
           quantity INT(4) NOT NULL
        )");
      }
}

if(isset($_POST['add_to_cart'])){
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = 1;
    $insert_product_query = mysqli_query($conn, "INSERT INTO `cart_$user_name` (name, price, image, quantity)
  VALUES ('$product_name', '$product_price', '$product_image', '$product_quantity')");
    header("Location:cart");
 }
 if(isset($_POST['go_auth'])){
    header("Location:authorisation");
 }
?>

<?php
include_once "head.php";
?>

<body>

<?php
include_once "header.php";
?>

<div class="prod">

<div class="container23">
      <?php
      $select_products = mysqli_query($conn, "SELECT * FROM `products`");
      if(mysqli_num_rows($select_products) > 0){
         while($fetch_product = mysqli_fetch_assoc($select_products)){
      ?>

        <form action="" method="post">
         <div class="box_product">
            <img src="uploaded_img/<?php echo $fetch_product['image']; ?>" alt="">
            <h3><?php echo $fetch_product['name']; ?></h3>
            <h5><?php echo $fetch_product['opis']; ?></h5>
            <div class="price"><?php echo $fetch_product['price']; ?>₴</div>

            <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
            <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
            <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
   
    <?php
if((isset($_SESSION['admin_name']))||(isset($_SESSION['user_name']))):
?>
<input type="submit" value="Додати до корзини" class="btn1" name="add_to_cart">

<?php else: ?>
    <input type="submit" value="Додати до корзини" class="btn1" name="go_auth">
<?php endif; ?>
         </div>
      </form>
      <?php
         };
      };
      ?>
    </div>
    </div>
<?php
include_once "footer.php";
?> 
</body>
</html>
