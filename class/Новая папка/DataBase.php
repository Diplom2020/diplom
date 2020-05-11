<?php
session_start();


class DataBase
{

    function connectdb(){
		
        $connect = mysqli_connect("localhost","diplom2020_mkiit","123456Qq","diplom2020_mkiit");
        if(!$connect){die('Error connect to DataBase');}
        return $connect;
    }

    function checkAdmin($login, $password){
        $connect = DataBase::connectdb();
        $user =  mysqli_query($connect,"SELECT login, permission FROM `users` WHERE `login` = '$login' AND `password` = '$password'");
        return $user;
    }

    function getInfoUser($id){
        $connect = DataBase::connectdb();
        $info =  mysqli_query($connect, "SELECT * FROM `users`WHERE `id` = $id");
        return $info;
    }

    function getAllPrepodovateli(){
        $connect = DataBase::connectdb();
		
        $user =  mysqli_query($connect, "SELECT * FROM `users` WHERE `permission` = 'teacher' OR `permission` = 'admin'");
        return $user;
    }
    function getAllStudents(){
        $connect = DataBase::connectdb();
        $user =  mysqli_query($connect, "SELECT * FROM `users` WHERE `permission` = 'student'");
        return $user;
    }
    function getStudentsFromGroup($group){
        $connect = DataBase::connectdb();
        $user =  mysqli_query($connect, "SELECT * FROM `users` WHERE `permission` = 'student' AND `student_group`= '$group'");
        return $user;
    }
    function getAllGroubs(){
        $connect = DataBase::connectdb();
        $groups =  mysqli_query($connect, "SELECT * FROM `groups`");
        return $groups;
    }
    public function countWordks(){
        $connect = DataBase::connectdb();
        $count = mysqli_query($connect, "SELECT COUNT(*) as 'count' FROM `uploads`");
        return  mysqli_fetch_assoc($count)['count'];
    }
    function getAllWordksPage($from , $notesOnPage){
        $connect = DataBase::connectdb();
        $works =  mysqli_query($connect, "SELECT `users`.*,`uploads`.`id` as 'id_doc',`uploads`.`path`,`uploads`.`author`,`uploads`.`name`,`uploads`.`author_id` FROM `users`,`uploads` WHERE `uploads`.`author_id` = `users`.`id` LIMIT $from,$notesOnPage");
        return $works;
    }





    function getAllWordks(){
        $connect = DataBase::connectdb();
        $works =  mysqli_query($connect, "SELECT `users`.*,`uploads`.`id` as 'id_doc',`uploads`.`path`,`uploads`.`author`,`uploads`.`name`,`uploads`.`author_id` FROM `users`,`uploads` WHERE `uploads`.`author_id` = `users`.`id`");
        return $works;
    }
    function getAllConferences(){
        $connect = DataBase::connectdb();
        $conferences =  mysqli_query($connect, "SELECT `conferences`.*, `users`.`Имя`,`users`.`Фамилия` FROM `conferences`,`users` WHERE `conferences`.`author_id` = `users`.`id`");
        return $conferences;
    }



    function getMyWordks($id){
        $connect = DataBase::connectdb();
        $works =  mysqli_query($connect, "SELECT `users`.*,`uploads`.`id` as 'id_doc',`uploads`.`path`,`uploads`.`author`,`uploads`.`name`,`uploads`.`author_id` FROM `users`,`uploads` WHERE `users`.`id` = $id AND `uploads`.`author_id` = $id");
        return $works;
    }
    function getMyConferences($id){
        $connect = DataBase::connectdb();
        $conferences =  mysqli_query($connect, "SELECT `conferences`.*, `users`.`Имя`,`users`.`Фамилия` FROM `conferences`,`users` WHERE `conferences`.`author_id` = $id AND `users`.`id`= $id");
        return $conferences;
    }

    function checkUser(){
        $connect = DataBase::connectdb();
        $login = $_SESSION['user']['login'];
        $password= $_SESSION['user']['password'];
        $user =  mysqli_query($connect,"SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$password'");
        return $user;

    }

    function addWork($fullpath,$author,$name,$uid){
        $connect = DataBase::connectdb();
        mysqli_query($connect, "INSERT INTO `uploads` (`path`, `author`, `name`, `author_id`) VALUES ('$fullpath', '$author', '$name', '$uid')");
    }
    function addConference($fullpath,$name,$uid,$info){
        $connect = DataBase::connectdb();
        mysqli_query($connect, "INSERT INTO `conferences` (`path`, `author_id`,`name`,`info`) VALUES ('$fullpath', '$uid', '$name', '$info')");
    }
}
