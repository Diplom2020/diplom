<?php
session_start();
require_once "../class/DataBaseAdmin.php";

$login = $_POST["login"];
$password = $_POST["password"];
$confirm_password = $_POST["confirm_password"];
$Фамилия = $_POST["Фамилия"];
$Имя = $_POST["Имя"];
$Отчетво = $_POST["Отчетво"];
$info = $_POST["info"];
$permission = $_POST["permission"];
$cours = $_POST["cours"];
$group = $_POST["group"];
$phone = $_POST["phone"];
$date = $_POST["data"];
$email = $_POST["email"];
$img = "";

$Logins = DataBaseAdmin::checkLogin($login);
$checkLogin = true;

foreach ($Logins as $l){
    if($l['login'] == $login)
        $checkLogin = false;
}
if(!$checkLogin)
    header('Location: ../admin/AddUser.php');
if($password != $confirm_password)
    header('Location: ../admin/AddUser.php');

if(getimagesize($_FILES['image']['tmp_name'])==FALSE)
{
    header('Location: ../admin/AddUser.php');
}
else
{
    $image = addslashes($_FILES['image']['tmp_name']);
    $image = file_get_contents($image);
    $image = base64_encode($image);
    $img = $image;
}

$password = md5($password);
DataBaseAdmin::addUser($login, $password,$Фамилия,$Имя,$Отчетво,$info,$permission,$cours,$group,$date,$phone,$email,$img);
header('Location: ../admin/admin.php');
