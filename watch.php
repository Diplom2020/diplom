<?php
require_once 'header.php';
$id_doc = $_POST["id_doc"];
$path = $_POST["path"];
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12 justify-content-center">
            <iframe style="width: 100%; height: 500px; border: none;" src="http://docs.google.com/gview?url=http://diplom2020.beget.tech/<?php echo $path ?>"></iframe>
        </div>
    </div>
</div>

<?php require_once 'end.php'; ?>


