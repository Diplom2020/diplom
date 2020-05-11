<?php
session_start();

class DataBaseAdmin
{
    function connectdb(){
		
        $connect = mysqli_connect("127.0.0.1","root","","kafedra");
        if(!$connect){die('Error connect to DataBase');}
        return $connect;
    }

    function checkAdmin(){
        $connect = DataBaseAdmin::connectdb();
        $login = $_SESSION['user']['login'];
        $password= $_SESSION['user']['password'];
        $user =  mysqli_query($connect,"SELECT login,password,permission FROM `users` WHERE `login` = '$login' AND `password` = '$password'");
        return $user;
    }

    function getAllPermission(){
        $connect = DataBaseAdmin::connectdb();
        return mysqli_query($connect, "SELECT `название` FROM `permission`");
    }
    function getAlltype(){
        $connect = DataBaseAdmin::connectdb();
        return mysqli_query($connect, "SELECT `name` FROM `type`");
    }

    function getAllgroup(){
        $connect = DataBaseAdmin::connectdb();
        return mysqli_query($connect, "SELECT `название` FROM `groups`");
    }



    function addUser($login, $password,$Фамилия,$Имя,$Отчетво,$info,$permission,$cours,$group,$date,$phone,$email,$img){
        $connect = DataBaseAdmin::connectdb();
        mysqli_query($connect,"INSERT INTO `users`(`login`, `password`, `Фамилия`, `Имя`, `Отчество`, `info`, `permission`, `course`, `student_group`,`date`, `photo`, `number`, `mail`) VALUES('$login', '$password', '$Фамилия', '$Имя', '$Отчетво', '$info', '$permission', '$cours', '$group', '$date', '$img', '$phone', '$email')");
    }
    function addgroup($group){
        $connect = DataBaseAdmin::connectdb();
        mysqli_query($connect,"INSERT INTO `groups` (`название`) VALUES ('$group')");
    }

    function checkLogin($login){
        $connect = DataBaseAdmin::connectdb();
        return mysqli_query($connect, "SELECT `login` FROM `users` WHERE login = '$login' ");
    }

    function getAllUsers(){
        $connect = DataBaseAdmin::connectdb();
        return mysqli_query($connect, "SELECT * FROM `users` ");
    }

    function deleteUser($id){
        $connect = DataBaseAdmin::connectdb();
        return mysqli_query($connect, "DELETE FROM `users` WHERE `users`.`id` = $id");
    }

}