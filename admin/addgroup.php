<?php
session_start();

require_once '../class/DataBaseAdmin.php';
$checkUser = DataBaseAdmin::checkAdmin();
$checkAdmin = false;
foreach ($checkUser as $u)
    if($u['login'] == $_SESSION['user']['login'] AND  $u['password'] == $_SESSION['user']['password'] AND $u['permission'] == "admin")
        $checkAdmin = true;
    
if(!$checkAdmin)
    header('Location: ../index.php');

if($_POST['group'])
	DataBaseAdmin::addgroup($_POST['group']);

require_once '../header.php';
require_once "../admin/menu.php";



?>



	   	<div class="col-md-9">
	   		<form action="../admin/addgroup.php" method="post">
		        <div class="row justify-content-center">
		        	<div class="col-md-4 text-center">
		        		<label for="">Группа: <input type="text" name="group"></label>
		        	</div>
		        	<div class="col-md-4">
		        		<input type="submit" value="Добавить">
		        	</div>
		        </div>
	    	</form>
	   	</div>

             
    </div>
</div>



<?php 






require_once '../end.php';?>
