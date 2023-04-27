

<?php
session_start();

include_once "config.php";

if(isset($_POST['send-text'])){
    
    $name = $_POST['name'];
    $email = $_POST['email'];
    $textc = $_POST['textс'];

    

    if($name!=''&&$email!=''&&$textc!=''){
    $insert_query = mysqli_query($conn , "INSERT INTO textcl VALUES(NULL, '$name','$email','$textc')") or die('query failed');
    header("Location:contacts");}
    else{
        $error[] = 'Заповніть всі поля!';
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




<section class="contact" id="contact">

    <h1 class="heading"> Зв'язатись з нами</h1>

    <div class="row">

        <form action="" method="POST">
        <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg1">'.$error.'</span>';
         };
      };
      ?>
            <input type="text" name="name" placeholder="Ваше ім'я" class="box">
            <input type="email" name="email" placeholder="Ваш email" class="box">
            <textarea name="textс" class="box" placeholder="Ваше повідомлення" cols="30" rows="10"></textarea>
            <input type="submit" value="Відправити" name="send-text" class="btn3" id='btn_contacts'>
        </form>

    </div>

</section>


<?php
include_once "footer.php";
?>


</body>
</html>
