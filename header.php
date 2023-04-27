
<header>

    <input type="checkbox" name="" id="toggler">
    <label for="toggler" class="fas fa-bars"></label>

    <a href="homepage" class="logo">MyGuitar</a>

    <nav class="navbar">
    <a href="homepage">Головна</a>
        <a href="products">Продукти</a>
        <a href="contacts">Контакти</a>
    </nav>

    <div class="icons">

    <?php
if(isset($_SESSION['admin_name'])):
?>
 <a href="admin_page" class="btn">Адмінка</a>
        <a href="cart" class="fas fa-shopping-cart"></a>
 <a href="logout" class="btn">Вийти</a>


<?php
elseif(isset($_SESSION['user_name'])):
?>
        <a href="cart" class="fas fa-shopping-cart"></a>
<a href="logout" class="btn">Вийти</a>

<?php else: ?>

  
    <a href="authorisation" class="btn">Ввійти</a>

<?php endif; ?>




    </div>

</header>