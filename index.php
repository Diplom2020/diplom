<?php
session_start();
require_once 'header.php';
require_once 'class/DataBase.php';
$allPrepodovateli= DataBase::getAllPrepodovateli();
$works = DataBase::getAllWordks();
$conferences = DataBase::getAllConferences();
?>

	<div class="block-1">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-3">
					<img src="assets/img/Mtuci_logo 2.png" alt="">
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-1 p-0">
					<div class="line-2"></div>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-7 p-0">
					<p>Кафедра Математической</p>
					<p>Кибернетики и Информационных</p>
					<p>Технологий</p>
				</div>
			</div>
		</div>
	</div>
	<div class="line"></div>


	<div class="block-2">
		<div class="container">
			<div class="row justify-content-center">
				<div class="row-12">
					<p class="heading_block_2" id="prepodovateli">Преподаватели</p>
				</div>
			</div>

			<div class="row">
                <?php foreach($allPrepodovateli as $value){?>
				<div class="col-4">
					<div class="info_block">
						<div class="row align-items-center">
							<div class="col-md-6">
                                <?php
                                    echo '<img src="data:image;base64,'.$value['photo'].'" alt="">';
                                ?>
							</div>
							<div class="col-md-6">
								<p class="info_block_name"><?php echo($value['Фамилия'] . " ". $value['Имя']. " ".$value['Отчество']); ?></p>
								<p class="info_block_info"><?php echo($value['info']);?></p>
								<p class="info_block_date"><?php echo($value['date']);?></p>
							</div>
						</div>
					</div>
				</div>
                <?php };?>
			</div>

			<div class="row">
				<div class="col-12">
					<p>Профессорский состав кафедры насчитывает 15 человек, среди которых 3 доктора технических наук и 4 кандидатов технических наук.</p>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<p>Кафедра является выпускающей и готовит бакалавров и магистров.</p>
				</div>
			</div>

		</div>
	</div>
	<div class="line"></div>

	<div class="block-3">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-4">
					<p class="heading_block_3" id="works">Работы преподавателей и студентов</p>
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
<!--                            <input type="submit" name="submit" value="Посмотреть" class="block-3_block_btn">-->
                            <a class = "block-3_block_btn" href="http://docs.google.com/gview?url=http://diplom2020.beget.tech/<?php echo($value['path']);?>">Посмотреть</a>
                        </form>
                        <?php };?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="line"></div>

	<div class="block-4">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<p class="heading_block_4" id="conferences">Конференции</p>
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
										<p class="block-4_block_text"><?php echo $value['info']; ?></p>
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
<!--                                            <input type="submit" name="submit" value="Посмотреть" class="block-3_block_btn">-->
                                            <a class = "block-3_block_btn" href="http://docs.google.com/gview?url=http://diplom2020.beget.tech/<?php echo($value['path']);?>">Посмотреть</a>
                                        </form>
                                    </div>
                                </div>
							</div>
						</div>
                        <?php };?>


						
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="line"></div>

    <?php require_once 'footer.php'; ?>
    <?php require_once 'end.php'; ?>



