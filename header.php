<?php
require_once 'class/DataBase.php';
$groups = DataBase::getAllGroubs();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Главная</title>

    <link rel="stylesheet" href="../assets/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="../assets/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="../assets/slick/slick-theme.css">
    <link rel="stylesheet" href="../assets/slick/slick.css">
    <link rel="stylesheet" href="../assets/Magnific-Popup/magnific-popup.css">
    <link rel="stylesheet" href="../assets/css/main.css">
</head>
<body>

<header>
    <div class="container-fluid header">
        <div class="row">
            <div class="col-12">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-4">
                            <img src="../assets/img/Mtuci_logo 1.png" alt="МТУСИ">
                            <h2><a href="../index.php">Кафедра МКиИТ</a></h2>
                        </div>
                        <div class="col-md">
                            <nav class = "navigation">
                                <ul class="menu">
                                    <?php
                                    $login = $_SESSION['user']['login'];
                                    $password = $_SESSION['user']['password'];
                                    $check = false;
                                    $checkAdmin = false;
                                    $admin = DataBase::checkAdmin($login, $password);

                                    foreach ($admin as $value)
                                    	if($value['login'] == $login and $value['permission'] == "admin")
                                    		$checkAdmin = true;
                                    	
                                    if($checkAdmin)
                                    	echo "<li><a href=\"../admin/admin.php\">Админка</a></li>";



                                    if($login != NULL and $password != NULL ){
                                        $check = true;
                                        echo "<li><a href=\"../profile.php\">Моя страница</a></li>";
                                    }
                                    else
                                        $check = false;

                                    echo "<li><a href=\"../prepodovateli.php\">Преподаватели</a></li>";
                                    echo "<div class=\"dropdown\">";
                                    echo "<li><a href=\"#\">Студенты</a></li>";
                                        echo "<div class=\"dropdown-content\">";
                                            echo"<a href=\"#\">группы</a>";
                                            foreach ($groups as $value){
                                                echo "<a href=\"../students.php?groups=".$value['название']."\">".$value['название']."</a>";
                                            };
                                        echo "</div>";
                                     echo "</div>";

                                    echo "<li><a href=\"../nworks.php\">Работы</a></li>";
                                    if(!$check) {
                                        echo "<li><a class=\"pop-up\" href=\"#popup-form\">Войти</a></li>";
                                    }


                            		if($login != NULL and $password != NULL ){
                                         echo "<li><a href=\"../vendor/logout.php\">Выход</a></li>";
                                    }
                                    ?>

                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 p-0">
                <div class="line"></div>
            </div>
        </div>
    </div>
</header>