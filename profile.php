<?php
session_start();
require_once 'header.php';
require_once 'class/DataBase.php';

$val = $_GET["id"];

$prosmotr = false;

if(!empty($val)){
    $works = DataBase::getMyWordks($val);
    $conferences = DataBase::getMyConferences($val);

    $prosmotr = true;
    $info= DataBase::getInfoUser($val);


    $photo = "";
    $surname = "";
    $name = "";
    $patronymic = "";
    $permission = "";

    $student_group = "";
    $number = "";
    $mail = "";

    foreach ($info as $value) {
        $photo = $value['photo'];
        $surname = $value["Фамилия"];
        $name = $value["Имя"];
        $patronymic = $value["Отчество"];
        $permission = $value["permission"];

        switch($permission){
            case "admin":
                $permission = "Админ";
                break;
            case "student":
                $permission =  "Студент";
                break;
            case "teacher":
                $permission =  "Преподаватель";
                break;
        }

        $student_group = $value["student_group"];
        $number = $value["number"];
        $mail = $value["mail"];
    }


}else{
    $check_login= $_SESSION['user']['login'];
    $check_password = $_SESSION['user']['password'];
    $check = false;
    if($check_login != "" and $check_password != ""){
        $u= DataBase::checkUser();
        foreach ($u as $value){
           if($value['login'] == $check_login AND $value['password'] == $check_password )
               $check = true;
        }
    }
    if(!$check)
        header('Location: /index.php');

    $works = DataBase::getMyWordks($_SESSION['user']['id']);
    $conferences = DataBase::getMyConferences($_SESSION['user']['id']);
}

?>

	<div class="profile_block_2">
		<div class="container">
			<div class="row justify-content-center">
				<h2>Карточка пользователя</h2>
			</div>
			<div class="row">
				<div class="col-md-6">
                    <?php
                        if($prosmotr){
                            echo '<img src="data:image;base64,'.$photo.'" alt="">';
                        }else{
                            echo '<img src="data:image;base64,'.$_SESSION['user']['photo'].'" alt="">';
                        }
                    ?>
				</div>
				<div class="col-md-6">
					<div class="profile_block_2_block">
						<div class="row">
							<div class="col-md-4">
								<p class="profile_block_2_block_p_left">ФИО:</p>
							</div>
							<div class="col-md-6 offset-md-2">
								<p class="profile_block_2_block_p_right">
                                    <?php
                                    if($prosmotr){
                                        echo $surname." ".$name." ".$patronymic;
                                    }else{
                                        echo $_SESSION['user']['surname']." ".$_SESSION['user']['name']." ".$_SESSION['user']['patronymic'];
                                    }
                                    ?>
                                </p>
							</div>
						</div>
					</div>

					<div class="profile_block_2_block">
						<div class="row">
							<div class="col-md-4">
								<p class="profile_block_2_block_p_left">Статус:</p>
							</div>
							<div class="col-md-6 offset-md-2">
								<p class="profile_block_2_block_p_right">
                                    <?php
                                    if ($prosmotr) {
                                        echo $permission;
                                    } else {
                                    switch($_SESSION['user']['permission']){
                                             case "admin":
                                                 echo ("Админ");
                                                 break;
                                             case "student":
                                                 echo ("Студент");
                                                 break;
                                             case "teacher":
                                                 echo ("Преподаватель");
                                                 break;
                                         }
                                    }
                                    ?>
                                </>
							</div>
						</div>
					</div>

					<div class="profile_block_2_block">
						<div class="row">
							<div class="col-md-4">
								<p class="profile_block_2_block_p_left">Группа:</p>
							</div>
							<div class="col-md-6 offset-md-2">
								<p class="profile_block_2_block_p_right">
                                    <?php
                                    if($prosmotr){
                                        echo $student_group;
                                    }else{
                                        echo $_SESSION['user']['student_group'];
                                    }
                                    ?>
                                </p>
							</div>
						</div>
					</div>
					
					<div class="profile_block_2_block">
						<div class="row">
							<div class="col-md-4">
								<p class="profile_block_2_block_p_left">Номер:</p>
							</div>
							<div class="col-md-6 offset-md-2">
								<p class="profile_block_2_block_p_right">
                                    <?php
                                    if($prosmotr){
                                        echo $number;
                                    }else{
                                        echo $_SESSION['user']['number'];
                                    }
                                    ?>
                                </p>
							</div>
						</div>
					</div>

					<div class="profile_block_2_block profile_block_2_block_last">
						<div class="row">
							<div class="col-md-4">
								<p class="profile_block_2_block_p_left">Почта:</p>
							</div>
							<div class="col-md-6 offset-md-2">
								<p class="profile_block_2_block_p_right">
                                    <?php
                                    if($prosmotr){
                                        echo $mail;
                                    }else{
                                        echo $_SESSION['user']['mail'];
                                    }
                                    ?>
                                </p>
							</div>
						</div>
					</div>


				</div>
			</div>
		</div>
	</div>
	<div class="line"></div>

	<div class="profile_block_3">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-4">
					<p class="heading_block_3">Мои научные работы</p>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-12">
					<div class="block-3_sliders">
                        <?php foreach ($works as $value){?>
                            <form action="watch.php" method="post" class="block-3_block ">
                                <img src="assets/img/photo.png" alt="">
                                <input type="text" name="id_doc" value="<?php echo($value['id_doc']);?>" hidden="hidden">
                                <input type="text" name="path" value="<?php echo($value['path']);?>" hidden="hidden">
                                <label name="fio" class="block-3_block_info">Автор: <?php echo($value['Фамилия']." ".$value['Имя']." ".$value['Отчество']);?></label>
                                <label name = "info" class="block-3_block_faculty"><?php echo($value['info']);?></label>
<!--                                <input type="submit" name="submit" value="Посмотреть" class="block-3_block_btn">-->
                                <a class = "block-3_block_btn" href="http://docs.google.com/gview?url=http://diplom2020.beget.tech/<?php echo($value['path']);?>">Посмотреть</a>
                            </form>
                        <?php };?>
					</div>
				</div>
			</div>
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="btn-ptof">
                        <a href="addwork.php" class="">Добавить</a>
                    </div>
                </div>
            </div>
		</div>
	</div>
	<div class="line"></div>

	<div class="profile_block_4">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<p class="heading_block_4">Мои конференции</p>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-12 p-0">
					<div class="block-4_sliders">
                        <?php foreach ($conferences as $value){?>
                            <div class="block-4_block">
                                <div class="block-4_info">
                                    <div class="row justify-content-center">
                                        <div class="col-md-12">
                                            <p class="block-4_block_text"><?php echo $value['info'];?></p>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="col-md-5">
                                            <div class="line-3"></div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="col-md-12">
                                            <p class="block-4_block_text"><?php echo $value['Фамилия']." ".$value['Имя'].", ".$value['name'];?></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form action="watchconf.php" class="block-4_block_form" method="post">
                                                <input type="text" name="id" hidden="hidden" value="<?php echo $value['id'];?>">
                                                <input type="text" name="path" hidden="hidden" value="<?php echo $value['path'];?>">
<!--                                                <input type="submit" name="submit" value="Посмотреть" class="block-3_block_btn">-->
                                                <a class = "block-3_block_btn" href="http://docs.google.com/gview?url=http://diplom2020.beget.tech/<?php echo($value['path']);?>">Посмотреть</a>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php };?>
					</div>
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="btn-ptof">
                                <a href="addconference.php" class="">Добавить</a>
                            </div>
                        </div>
                    </div>
				</div>
			</div>
		</div>
	</div>
	<div class="line"></div>

<?php require_once 'end.php'; ?>