<!DOCTYPE html>
<html lang="en">
<?php
include_once "includes/head.php";
$_SESSION['title'] = '';
$_SESSION['slogan'] = '';
$_SESSION['news'] = '';
admin::CheckRank(13);
?>

<body>

    <?php
    include_once "includes/navi.php";
    include_once "includes/header.php";

    ?>


    <div class="main-panel">
        <div class="content-wrapper">
        <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Salas</h4>
                            <p class="card-description">Gestor de salas</p>
                            <?php admin::DeleteRooms(); ?>
                            <div class="table-responsive ">
                            <table class=" table-condensed table" id="tableprueba" style="background:#191c24">
   <thead>
                                <tr>
                                <th>ID</th>
                                <th>Nombre de la sala</th>
								<th style="width: 60%;">Room</th>
                                <th>Estado de la sala</th>
                                <th>Dueño</th>
                                <th>Eliminar</th>
                                </tr>

                            </thead>
								<tbody>
								

									<?php

										$getArticles = $dbh->prepare("SELECT * FROM rooms");
										$getArticles->execute();
										while($news = $getArticles->fetch()){
									?>	
											<tr">
											<td style="color:#6c7293; background:#191c24"> <?php echo $news["id"]; ?></td>
											<td style="color:#6c7293; background:#191c24"> <?php echo filter($news["caption"]); ?></td>
											<td style="color:#6c7293; background:#191c24"><?php echo $news["id"]; ?></td>
											<td style="width: 25%; background:#191c24"  "><?php echo $news["state"]; ?></td>
											<td style="color:#6c7293; background:#191c24"><?php echo $news["owner"]; ?></td>
											<td style="color:#6c7293; background:#191c24"><a type="button" class="btn btn-danger" href=' <?php echo  $config['hotelUrl'];?>/adminpan/rooms/delete/<?php echo $news["id"];?>'>Eliminar</a></td>
											</tr>
										<?php } ?>
								</tbody>
							</table>
				</div>
			</div>
            </div>
            </div>
		

            <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Tus salas</h4>
                            <p class="card-description">Gestor de salas propias</p>
                            <form class="forms-sample" form name="mygallery" action="" method="POST">
                            <?php admin::DeleteRooms(); ?>
                            <div class="table-responsive ">
                            <table class=" table-condensed table" id="tableprueba1" style="background:#191c24">
							   <thead>
								
									<strong>
									<tr><th style="width: 5%;">ID</th>
									<th>Nombre de la sala</th>
									<th>Sala ID</th>
									<th>Estado de la sala</th>
									<th>Modelo</th>
									<th>Eliminar</th>
									</tr>
																		   </thead>
																		   <tbody>
									<?php
									$iduser = User::userData('username');
										$getArticles = $dbh->prepare("SELECT * FROM rooms WHERE owner = '$iduser' ORDER BY id DESC ");
										$getArticles->execute();
										while($news2 = $getArticles->fetch()){
												?>
												
												<tr style="">
											<td style="color:#6c7293; background:#191c24"> <?php echo $news2["id"]; ?></td>
											<td style="color:#6c7293; background:#191c24"> <?php echo filter($news2["caption"]); ?></td>
											<td style="color:#6c7293; background:#191c24"><?php echo $news2["id"]; ?></td>
											<td style="width: 25%; background:#191c24"><?php echo $news2["state"]; ?></td>
											<td style="color:#6c7293; background:#191c24"><?php echo $news2["model_name"]; ?></td>
											<td style="color:#6c7293; background:#191c24"><a type="button" class="btn btn-danger" href=' <?php echo  $config['hotelUrl'];?>/adminpan/rooms/delete/<?php echo $news["id"];?>'>Eliminar</a></td>
											</tr>
										<?php } ?>

								</tbody>
							</table>
				</div>
			</div>
			</div>
		</div>
        </div>
        </div>



                    <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <?php
        include_once "includes/footer.php";
        ?>
        <!-- container-scroller -->

        <!-- End custom js for this page -->
        <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"/>
<script type="text/javascript" src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
    $('#tableprueba').DataTable();
            } );
</script>
 <script>
    $(document).ready(function() {
    $('#tableprueba1').DataTable();
            } );
</script>
</body>


</html>