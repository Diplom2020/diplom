<?php
session_start();
require_once '../class/DataBase.php';
$connect = DataBase::connectdb();

$login = $_POST['login'];
$password = $_POST['password'];

$password = md5($password);
$chek_user = mysqli_query($connect, "SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$password'");

if(mysqli_num_rows($chek_user) > 0){
    $user = mysqli_fetch_assoc($chek_user);
    $_SESSION['user'] = [
        "id" => $user['id'],
        "login" =>$user['login'],
        "password" =>$user['password'],
        "surname" => $user['Фамилия'],
        "name" => $user['Имя'],
        "patronymic" => $user['Отчество'],
        "info" => $user['info'],
        "permission" => $user['permission'],
        "student_group" =>$user['student_group'],
        "photo" =>$user['photo'],
        "number" =>$user['number'],
        "mail" =>$user['mail']
    ];
    header('Location: /index.php');
}else{
    $_SESSION['message'] = 'Неверный логин или пароль';
}