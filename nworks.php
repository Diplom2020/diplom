<?php
session_start();
require_once 'header.php';
require_once 'class/DataBase.php';

if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}

$notesOnPage = 4;
$from = ($page - 1) * $notesOnPage;

$works = DataBase::getAllWordksPage($from , $notesOnPage);
$rows = mysqli_num_rows($works);
$count = DataBase::countWordks();
$pagesCount = ceil($count / $notesOnPage);

?>


<div class="spisok">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Научные работы<h1>
            </div>
        </div>
<?php foreach ($works as $value){?>
        <div class="block-work">
            <div class="row">
                <div class="col-md-12">

                    <form action="../watch.php" method="post" class="block-3_block ">
                        <div class="row">
                            <div class="col-md-6">
                                <img src="assets/img/photo.png" alt="">
                            </div>

                            <div class="col-md-6">

                                <div class="row">
                                    <div class="col-md-12">
                                        <label type="text" name="block-3_block_info"><?php echo($value['name']);?></label>
                                        <input type="text" name="id_doc" value="<?php echo($value['id_doc']);?>" hidden="hidden">
                                        <input type="text" name="path" value="<?php echo($value['path']);?>" hidden="hidden">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <label name="fio" class="block-3_block_info">Автор: <?php echo($value['Фамилия']." ".$value['Имя']." ".$value['Отчество']);?></label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <label name = "info" class="block-3_block_faculty"><?php echo($value['info']);?></label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-5">
<!--                                        <input type="submit" name="submit" value="Посмотреть" class="block-3_block_btn">-->
                                        <a class = "block-3_block_btn" href="http://docs.google.com/gview?url=http://diplom2020.beget.tech/<?php echo($value['path']);?>">Посмотреть</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    <?php };?>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-12">
            <nav aria-label="...">
                <ul class="pagination">

                    <?php
                    $prev = $page - 1;
                    $class = ($prev == 0) ? 'disabled' : '';

                    echo "<li class=\"page-item page-link-arrow $class\"><a class=\"page-link\" href=\"?page=$prev\" tabindex=\"-1\"><img src=\"assets/img/prev.png\" alt=\"\"></a></li>";
                    for ($i = 1; $i <= $pagesCount; $i++) {
                        if ($page == $i) {
                            $class = 'active';
                        } else {
                            $class = '';
                        }
                        echo "<li class=\"page-item $class\"><a href=\"?page=$i\"class=\"page-link\" >$i</a></li>";
                    };

                    $next = $page + 1;
                    $class = ($next > $pagesCount) ? 'disabled' : '';

                    echo "<li class=\"page-item page-link-arrow $class\"><a class=\"page-link\" href=\"?page=$next\" ><img src=\"assets/img/next.png\" alt=\"\"></a></li>";
                    ?>


                </ul>
            </nav>
        </div>
    </div>
</div>

<?php require_once 'end.php'; ?>