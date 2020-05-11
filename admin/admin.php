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
    header('Location: /index.php');

require_once '../header.php';
require_once "../admin/menu.php";
?>


        <div class="col-9">

        </div>
    </div>
</div>



<?php require_once '../end.php';?>
