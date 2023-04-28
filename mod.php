<?php
session_start();

include_once "config.php";
if(!isset($_SESSION['admin_name'])){
    header('location:authorisation');
 }
$id = $_GET['id'];
$req = mysqli_query($conn , "SELECT * FROM products WHERE id = $id");
$row = mysqli_fetch_assoc($req);

if(isset($_POST['button'])){
    $name = $_POST['name'];
    $opis = $_POST['opis'];
    $price = $_POST['price'];
    $current_image = $_POST['current_image'];
    if(isset($_FILES['image']['name']) && $_FILES['image']['name']!="") {

        $imagef = $_FILES['image']['name'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_folder = 'uploaded_img/'.$imagef;
        move_uploaded_file($image_tmp_name, $image_folder);
        $image = $imagef;
    } else {
        $image = $current_image;
    }
    $update_query = mysqli_query($conn , "UPDATE products SET name='$name', opis='$opis', price='$price', image='$image' WHERE id='$id'") or die('query failed');

    if($update_query){
        header('location:admin_page');
    }else {
        $message = "Не вдалося оновити запис";
    }
}
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
        <h2>Оновити : <?=$row['name']?> </h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <label>Назва</label>
            <input type="text" name="name" value="<?=$row['name']?>">
            <label>Опис</label>
            <input type="text" name="opis" value="<?=$row['opis']?>">
            <label>Ціна</label>
            <input type="number" name="price" value="<?=$row['price']?>">
            <label>Фото</label>
            <input type="hidden" name="current_image" value="<?=$row['image']?>">
            <img style="height: 100px; width:100px; border-radius:25px; " src="uploaded_img/<?=$row['image']?>">
            <input type="file" name="image" accept="image/png, image/jpg, image/jpeg" class="box1" > 
            <input type="submit" value="Оновити" name="button">
        </form>
    </div>
</div>
<?php
include_once "footer.php";
?>
</body>
</html>
