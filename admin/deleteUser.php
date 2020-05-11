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

$users = DataBaseAdmin::getAllUsers();

?>

        <div class="col-9">
            <?php
            foreach($users as $user){?>
                <div class="row">
                    <div class="col">
                        <p>id: <?php echo $user['id']?></p>
                    </div>
                    <div class="col">
                        <p><?php echo $user['Фамилия']?></p>
                    </div>
                    <div class="col">
                        <p><?php echo $user['Имя']?></p>
                    </div>
                    <div class="col">
                        <p><?php echo $user['Отчество']?></p>
                    </div>
                    <div class="col">
                        <form action="deleteUser.php" method="post">
                            <input type="text" name="id" hidden value="<?php echo $user['id']?>">
                            <input type="submit" value="Удалить">
                        </form>
                    </div>
                </div>
            <?php }; ?>
        </div>
    </div>
</div>


<?
$id = $_POST['id'];
DataBaseAdmin::deleteUser($id);

require_once '../end.php';?>