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
        <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Eventos:</h4>
                                <p class="card-description"> Todos los eventos </p>
                                <?php admin::Deleteventos(); ?>
                                <div class="table-responsive ">
                                    <table class="table table-hover">
                                    <tbody>
									<?php
									
									
									
									$getArticles = $dbh->prepare("SELECT * FROM cms_events ORDER BY id DESC");
									$getArticles->execute();
										
										while($news = $getArticles->fetch())
										{
										
									$getto = $dbh->prepare("SELECT * FROM users WHERE id=".$news["user"]);								
									$getto->execute();
									$geto = $getto->fetch();
											echo'<tr>
											<td>'.$news["id"].'</td>
											<td>'.$news["title"].'</td>
											<td>'.$geto["username"].'</td>
											<td>'.$news["hora"].'</td>
											<td>'.$news["fecha"].'</td>
											
											<td><a type="button" class="btn btn-danger" href='.$config['hotelUrl'].'/adminpan/eventos/delete/'.$news["id"].'>Eliminar</center></a></td>
											</tr>';
										}
									?>
									
									
									
									
								</tbody>
							</table>


     </div>
                </div>
                </div>
                </div>
            
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Publicar Evento</h4>
                            <p class="card-description"> Crea un nuevo evento </p>
                <section class="panel" >
					<header class="panel-heading">
						<br>
						<form class="forms-sample" form name="mygallery" action="" method="POST">
					
						<div class="panel-body">
							<?php admin::Posteventos(); ?>
							<div class="form-group">
								<label for="exampleInputEmail1">Titulo del evento</label>
									<input type="text" name="title"class="form-control" >
							</div>	
							<div class="form-group">
								<label for="exampleInputEmail1">Hora de el evento</label>
									<input type="text" name="hora"class="form-control" placeholder="08:30 o 20:00">
								</div>
							<div class="form-group">
								<label class=for="exampleInputEmail1">Fecha del evento</label>
									<input type="text" name="fecha"class="form-control" placeholder="dd/mm/aaaa">
                                    </div>
									
								
							<button name="posteventos" type="submit" class="btn btn-primary mr-2">Crear evento</button>
						</div>
					</section>
				</div>
			</form>
		
</div></div></div>


               
                
                    <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <?php
        include_once "includes/footer.php";
        ?>
        <!-- container-scroller -->

        <!-- End custom js for this page -->
</body>


</html>