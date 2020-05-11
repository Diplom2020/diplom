<?php
session_start();

require_once '../class/DataBaseAdmin.php';
$checkUser = DataBaseAdmin::checkAdmin();
$checkAdmin = false;
foreach ($checkUser as $u){
    if($u['login'] == $_SESSION['user']['login'] AND  $u['password'] == $_SESSION['user']['password'] AND $u['permission'] == "admin"){
        $checkAdmin = true;
    }
}
if(!$checkAdmin)
    header('Location: ../index.php');
require_once '../header.php';
require_once "../admin/menu.php";
$permission = DataBaseAdmin::getAllPermission();
$type = DataBaseAdmin::getAlltype();
$grops = DataBaseAdmin::getAllgroup();




?>


        <div class="col-9 p-b">
            <form action="../vendor/adduser.php" method="post" enctype="multipart/form-data">
                <div class="row justify-content-center">
                    <div class="col-8">
                        <label class="adm_label">Логин</label>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-8">
                        <input type="text" class="adm_input" name="login">
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-8">
                        <label class="adm_label">Пароль</label>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-8">
                        <input type="password" class="adm_input" name="password">
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-8">
                        <label class="adm_label">Повтор пароля</label>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-8">
                        <input type="password" class="adm_input" name="confirm_password">
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-8">
                        <label class="adm_label">Фамилия</label>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-8">
                        <input type="text" class="adm_input" name="Фамилия">
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-8">
                        <label class="adm_label">Имя</label>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-8">
                        <input type="text" class="adm_input" name="Имя">
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-8">
                        <label class="adm_label">Отчество</label>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-8">
                        <input type="text" class="adm_input" name="Отчетво">
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-8">
                        <label class="adm_label">Информация</label>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-8">
                        <input type="textarea" class="adm_input" name="info">
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-8">
                        <label class="adm_label">Права доступа</label>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-8">
                        <select name="permission" class="adm_input">
                            <?php
                            echo ("<option value=\"NULL\" hidden>NULL</option>");
                            foreach ($permission as $p){
                                echo ("<option value=\"".$p["название"]."\">".$p["название"]."</option>");
                            };
							?>
                        </select>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-8">
                        <label class="adm_label">Курс</label>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-8">
                        <select name="cours" class="adm_input">
                            <?php
                            echo ("<option value=\"NULL\">NULL</option>");
                            for($i = 1; $i<= 4;$i++){
                                echo "<option value=\"$i\">$i</option>";
                            }; ?>
                        </select>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-8">
                        <label class="adm_label">Группа</label>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-8">
                        <select name="group" class="adm_input">
                            <?php
                            echo ("<option value=\"NULL\">NULL</option>");
                            foreach ($grops as $p){
                                echo ("<option value=\"".$p["название"]."\">".$p["название"]."</option>");
                            };?>
                        </select>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-8">
                        <label class="adm_label">Дата рождения</label>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-8">
                        <input type="date" class="adm_input" name="data">
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-8">
                        <label class="adm_label">Номер телефона</label>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-8">
                        <input type="tel" class="adm_input" name="phone">
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-8">
                        <label class="adm_label">Почта</label>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-8">
                        <input type="text" class="adm_input" name="email">
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-8">
                        <label class="adm_label">Фото</label>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-8">
                        <input type="file" name="image" class="adm_btn">
                    </div>
                </div>

                <input type="submit" class="adm_btn" >
            </form>
        </div>
    </div>
</div>



<?php require_once '../end.php';?>
