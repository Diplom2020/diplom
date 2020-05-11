<form id="popup-form" class="white-popup-block mfp-hide" action="">
    <label>Войти в личный кабинет</label>
    <input id="login"  type="login" placeholder="Введите логин" name="login" class="popup-form-input">
    <input id="password" type="password" placeholder="Введите пароль" name="password" class="popup-form-input">
    <button id="btn" type="submit" class="popup-form-btn">Войти</button>
    <?php
    if($_SESSION['message']){
        echo '<p class="msg">'. $_SESSION['message'] .'</p>';
        unset($_SESSION['message']);
    }
    ?>
</form>


<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script>window.jQuery || document.write('<script src="assets/js/jquery-3.4.1.min.js"><\/script>')</script>
<script src="assets/slick/slick.js"></script>
<script src="assets/Magnific-Popup/jquery.magnific-popup.min.js"></script>
<script src="assets/js/main.js"></script>
</body>
</html>