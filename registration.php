<?php

include_once "config.php";

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   $user_type = 'user';

   $select = " SELECT * FROM user WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $error[] = 'Користувач вже зареєстрований!';

   }else{

      if($pass != $cpass){
         $error[] = 'Не вірний пароль!';
      }else{
         $insert = "INSERT INTO user(name, email, password, user_type) VALUES('$name','$email','$pass','$user_type')";
         mysqli_query($conn, $insert);
         header('location:authorisation');
      }
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




<div class="form-container">

   <form action="" method="post">
      <h3>Зареєструватись</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="text" name="name" pattern="[a-zA-Z]+" required placeholder="Введіть ваше ім'я (тільки ENG букви)">
      <input type="email" name="email" required placeholder="Введіть ваш Email">
      <input type="password" name="password" required placeholder="Введіть ваш пароль">
      <input type="password" name="cpassword" required placeholder="Повторіть ваш пароль">
      <input type="submit" name="submit" value="Зареєструватись" class="form-btn">
      <p>Вже зареєстровані? <a href="authorisation">Ввійти</a></p>
   </form>

</div>



<?php
include_once "footer.php";
?>
  
</body>
</html>
