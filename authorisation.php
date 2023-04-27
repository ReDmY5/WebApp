<?php

include_once "config.php";
session_start();

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   $user_type = $_POST['user_type'];

   $select = " SELECT * FROM user WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $row = mysqli_fetch_array($result);

      if($row['user_type'] == 'admin'){

         $_SESSION['admin_name'] = $row['name'];
         header('location:admin_page');

      }elseif($row['user_type'] == 'user'){

         $_SESSION['user_name'] = $row['name'];
         header('location:homepage');

      }
     
   }else{
      $error[] = 'Не вірний email або пароль!';
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
      <h3>Авторизуватись</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="email" name="email" required placeholder="Ваш Email">
      <input type="password" name="password" required placeholder="Пароль">
      <input type="submit" name="submit" value="Ввійти" class="form-btn">
      <p>Не маєте аккаунту? <a href="registration">Зареєструватись</a></p>
   </form>

</div>




<?php
include_once "footer.php";
?>
  
</body>
</html>