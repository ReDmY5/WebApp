<?php
session_start();
if(isset($_SESSION['admin_name'])){
    $user_name = $_SESSION['admin_name'];
}
elseif(isset($_SESSION['user_name'])){
    $user_name = $_SESSION['user_name'];
}
?>
<?php
include_once "head.php";
?>
<body>
<?php
include_once "header.php";
?>
<div class="text_aft_buy">
<div>
<h1>
    Дякуємо за покупку, <span><?php echo $user_name ?>!</span>   
</h1>
<a style="margin-left:60px;" href="homepage" class="btn">На головну?</a>
</div>
</div>

<?php
include_once "footer.php";
?>
</body>
</html>
