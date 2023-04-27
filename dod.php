<?php
session_start();

if(!isset($_SESSION['admin_name'])){
    header('location:authorisation');
 }


 include_once "config.php";


if(isset($_POST['button'])){
   $p_name = $_POST['name'];
   $opis = $_POST['opis'];
   $price = $_POST['price'];
   $imagef = $_FILES['image']['name'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/'.$imagef;

   $insert_query = mysqli_query($conn , "INSERT INTO Products VALUES(NULL, '$p_name', '$opis','$price','$imagef')") or die('query failed');

   if($insert_query){
      move_uploaded_file($image_tmp_name, $image_folder);
       header("location:admin_page");
   }else{
       header("location:dod");
   }
};


    ?>

<?php
include_once "head.php";
?>

<body>

<?php
include_once "header.php";
?>

<div class="form_for_dod">
<div class="form23">
        <a href="admin_page" class="back_btn"><img src="images/back.png"> Назад</a>
        <h2>Додати</h2>
 
        <form action="" method="POST" enctype="multipart/form-data">
            <label>Назва товару</label>
            <input type="text" name="name"  required>
            <label>Опис</label>
            <input type="text" name="opis"  required>
            <label>Ціна</label>
            <input type="number" name="price" min="0"  required>
            <label>Фото</label>
            <input type="file" name="image" accept="image/png, image/jpg, image/jpeg"  required>
            
            <input type="submit" value="Додати" name="button">
        </form>
    </div>
</div>

<?php
include_once "footer.php";
?>
 
</body>
</html>
