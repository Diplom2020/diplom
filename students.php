<?php
session_start();
require_once 'header.php';
require_once 'class/DataBase.php';

$val = $_GET["groups"];
$allStudents= DataBase::getStudentsFromGroup($val);



?>

<div class="spisok">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Список студентов<h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tab">
                    <table border="1" cellpadding="5">
                        <tr>
                            <th class="table_header">ФИО</th>
                            <th class="table_header">Должность</th>
                        </tr>
                        <?php foreach($allStudents as $value){?>

                            <tr>
                                <th><a href="../profile.php?id=<?php echo($value['id']);?>"><?php echo($value['Фамилия'] . " ". $value['Имя']. " ".$value['Отчество']); ?></a></th>
                                <th><?php echo($value['info']);?></th>
                            </tr>
                        <?php }; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'end.php'; ?>