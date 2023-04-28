<?php
include_once "config.php";
session_start();
if(!isset($_SESSION['admin_name'])){
   header('location:authorisation');
}

if(isset($_GET['delete'])){
   $id= $_GET['delete'];
  $req = mysqli_query($conn , "DELETE FROM products WHERE id = $id");
  header("Location:admin_page");
};
?>

<?php
include_once "head.php";
?>

<body>

<?php
include_once "header.php";
?>

<div class="container2">
   <div class="content1">
      <h1>Вітаю,<?php echo $_SESSION['admin_name'] ?></h1>
   </div>
</div>

<div class="tablucya_crud">   
<div class="table-scroll">
    <table>
        <thead>
            <a href="dod" class="Btn_add">Додати</a>
            <tr>
                <th>Назва</th>
                <th>Опис</th>
                <th>Ціна</th>
                <th>Фото</th>
                <th>Модифікувати</th>
                <th>Видалити</th>
            </tr>
        </thead>
    </table>   
    <div class="table-scroll-body">
        <table>
            <tbody>
                
                <?php 

                $req = mysqli_query($conn , "SELECT * FROM products");
            
                if(mysqli_num_rows($req) == 0){

                    echo "" ;
                    
                }else {
                    while($row=mysqli_fetch_assoc($req)){
                        ?>
                        <tr>
                            <td><?=$row['name']?></td>
                            <td><?=$row['opis']?></td>
                            <td><?=$row['price']?> ₴</td>
                            <td><img src="uploaded_img/<?=$row['image']?>"></td>

                           
                            <td><a href="mod?id=<?=$row['id']?>" ><img src="images/1827951.png"></a></td>
                            <td><a href="admin_page?delete=<?=$row['id']?>"> <img src="images/mus.png"> </a></td>
                        </tr>
                        <?php
                    }  
                }
            ?>
            
            </tbody>
        </table>
    </div> 
</div>
</div>

<?php
include_once "footer.php";
?>

</body>
</html>
