<?php
session_start();
if(isset($_SESSION['admin_name'])){
    $user_name = $_SESSION['admin_name'];
}
elseif(isset($_SESSION['user_name'])){
    $user_name = $_SESSION['user_name'];
}

include_once "config.php";

if(isset($_GET['delete'])){
   $id= $_GET['delete'];
  $req = mysqli_query($conn , "DELETE FROM cart_$user_name WHERE id = $id");
  header("Location:cart");
};

if(isset($_GET['delete_all'])){
   mysqli_query($conn, "DELETE FROM `cart_$user_name`");
   header('location:cart');
}
      
if(isset($_GET['buy'])){
   mysqli_query($conn, "DROP TABLE `cart_$user_name`");
   header('location:ordertoserv');

}   
    
if(isset($_GET['add'])){
   $id = $_GET['add'];
   mysqli_query($conn, "UPDATE `cart_$user_name` SET `quantity` = `quantity` + 1 WHERE `id` = $id");
   header('location:cart');
}

if(isset($_GET['vidnyati'])){
   $id = $_GET['vidnyati'];
   $result = mysqli_query($conn, "SELECT quantity FROM `cart_$user_name` WHERE `id` = $id");
   $row = mysqli_fetch_assoc($result);
   $quantity = $row['quantity'];
   if($quantity > 1) {
       mysqli_query($conn, "UPDATE `cart_$user_name` SET `quantity` = `quantity` - 1 WHERE `id` = $id");
   }
   header('location:cart');
}

$grand_total = 0;
?>

<?php
include_once "head.php";
?>

<body>

<?php
include_once "header.php";
?>

<div class="korzuna">
<div class="table-scroll">
    <table>
        <thead>
            <h1 style="margin-left:40%; margin-bottom:40px;">Корзина</h1>
            <tr>
                <th>Фото</th>
                <th>Назва</th>
                <th>Кількість</th>
                <th>Ціна</th>
                <th>Видалити?</th>

            </tr>
        </thead>
    </table>   
    <div class="table-scroll-body">
        <table>
            <tbody>
                
                <?php 

                
                
                $req = mysqli_query($conn , "SELECT * FROM  cart_$user_name")or die('Не було обрано товару!');
            
                if(mysqli_num_rows($req) == 0 ){

                    echo "" ;
                    
                }else {
                    while($row=mysqli_fetch_assoc($req)){
                        ?>

                        <tr>
                           <td><img src="uploaded_img/<?=$row['image']?>"></td>
                            <td><?=$row['name']?></td>
                            <td><?php echo $row['quantity'] ?> <a  href="cart?add=<?=$row['id']?>" ><img class="knopka" src="images/pluss.png"></a> <a href="cart?vidnyati=<?=$row['id']?>" ><img class="knopka" src="images/minus.png"></a> </td>
                            <td><?php echo $sub_total=$row['price'] * $row['quantity']; ?> ₴</td>   
                            <td><a href="cart?delete=<?=$row['id']?>"> <img src="images/mus.png"> </a></td>

                        </tr>
                        <?php
                         $grand_total += $sub_total;   
                    }  
                }
            ?>
            
            </tbody>
        </table>
    </div> 
    
    
    <table>
        <thead>
            
            <tr>
                <th>Сума  : <?php echo   $grand_total; ?>  ₴</th>
                <th><a href="cart.php?buy" class="back_btn"><img src="images/buy.png"> Купити</a></th>
                <th><a href="cart.php?delete_all" class="back_btn" onclick="return confirm('Очистити всю корзину?');"  ><img src="images/trash.png"> Очистити корзину </a></th>
           
            </tr>
        </thead>
    </table>  
</div>
</div>
   
<?php
include_once "footer.php";
?>
 
</body>
</html>
