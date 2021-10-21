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
                            <h4 class="card-title">catalogo home:</h4>
                            <p class="card-description"> Subir furnis al catalogo home </p>
                            <?php
$letras=substr(str_shuffle("QWERTYUIOPASDFGHJKLZXCVBNM"), 0, 9);
$cont=$config['badgescont'];
$codigo='FUR' . $letras . $cont;

if (isset($_POST['submit']))
{
	$filename = $_FILES["file"]["name"];
	$file_basename = substr($filename, 0, strripos($filename, '.')); // get file extention
	$file_ext = substr($filename, strripos($filename, '.')); // get file name
	$filesize = $_FILES["file"]["size"];
	$allowed_file_types = array('.png');	

	if (in_array($file_ext,$allowed_file_types) && ($filesize < 200000))
	{	
		// Rename file
		$newfilename = $codigo . $file_ext;
		if (file_exists("catalogue/" . $newfilename))
		{
			// file already exists error
			echo "Alparecer hubo un error con el codigo generado";
		}
		else
		{		
			move_uploaded_file($_FILES["file"]["tmp_name"], "catalogue/" . $newfilename);
				$postpublics = $dbh->prepare("
					INSERT INTO cms_furnis(nombre,diamantes,creditos,thrones,codigo,autor)
					VALUES
					(
					:nombre,
					:diamantes,
					:creditos, 
					:thrones, 
					:codigo,
					:autor)");
						$postpublics->bindParam(':nombre', $_POST['nombre']);
						$postpublics->bindParam(':diamantes', $_POST['diamantes']);
						$postpublics->bindParam(':creditos', $_POST['creditos']);
						$postpublics->bindParam(':thrones', $_POST['thrones']);
						$postpublics->bindParam(':codigo', $codigo);
						$postpublics->bindParam(':autor', User::userData('username'));
						$postpublics->execute();		
		
		}
	}
	elseif (empty($file_basename))
	{	
		// file selection error
		echo "Por favor seleccione un furni para cargar.";
	} 
	elseif ($filesize > 200000)
	{	
		// file size error
		echo "El tamaño del furni que estas intentando cargar es demasiado grande.";
	}
	else
	{
		// file type error
		echo "Solo estos tipos de archivos están permitidos para cargar: " . implode(', ',$allowed_file_types);
		unlink($_FILES["file"]["tmp_name"]);
	}
}

?>
				<?php admin::DeleteFurni(); ?>


                <section class='member-data' >
            
								
							
							
<form class="forms-sample" action="" enctype="multipart/form-data" method="post" ><br>
				<label class="exampleInputEmail1">Nombre del rare</label>
									<div class="form-group">
										<input type="text" value="" name="nombre" class="form-control" maxlength="15" required>
										</div>
				<label class="exampleInputEmail1" style=" color: #616161; ">Costo de Creditos (RECUERDA SOLO ELEGIR 1-2 TIPOS DE MONEDAS PARA EL RARE) - SI DEJAS EN 0 LA MONEDA NO SE TOMARA EN CUENTA</label>
									<div class="form-group">
										<input type="text" value="0" name="creditos" class="form-control" maxlength="5" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
										</div>
				<label class="cexampleInputEmail1" style=" color: #616161; ">Costo de Diamantes (RECUERDA SOLO ELEGIR 1-2 TIPOS DE MONEDAS PARA EL RARE) - SI DEJAS EN 0 LA MONEDA NO SE TOMARA EN CUENTA</label>
									<div class="form-group">
										<input type="text" value="0" name="diamantes" class="form-control" maxlength="5" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
										</div>
				<label class="exampleInputEmail1" style=" color: #616161; ">Costo de Thrones (RECUERDA SOLO ELEGIR 1-2 TIPOS DE MONEDAS PARA EL RARE) - SI DEJAS EN 0 LA MONEDA NO SE TOMARA EN CUENTA</label>
									<div class="form-group">
										<input type="text" value="0" name="thrones" class="form-control" maxlength="5" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
										</div>


                                        <div class="form-group">
<label  class="exampleInputEmail1">Subir image</label>
                        <input id="my-file" type="file" name="file" class="file-upload-default" required />
                        <div class="input-group col-xs-12">
                          <input type="text" class="form-control file-upload-info" disabled placeholder="Subir Imagen">
                          <span class="input-group-append">
                            <button class="file-upload-browse btn btn-info" type="button">Selecionar</button>
                          </span>
                          </div>
                          </div>

<input id="Submit" name="submit" type="submit" value="Subir" class="btn btn-primary mr-2"/>
</form>

                               
                             
                                <div class="table-responsive ">
                                    <table class="table table-hover">
							<div><br>
							      <h5 class='member-data__name'>Lista de furnis</h5>
						
								<?php
									$getArticles = $dbh->prepare("SELECT * FROM cms_furnis");
									$getArticles->execute();
										echo'
                                        <tbody>
                                        <tr>
										<th><b>Nombre</b></th>
										<th><b>Creditos</b></th>
										<th><b>Diamantes</b></th>
										<th><b>Thrones</b></th>
										<th><b>Subido por</b></th>
										<th><b>Eliminar</b></th>
										</tr>
										';
									while($news = $getArticles->fetch())
									{
										echo'<tr>
										<td>'.$news["nombre"].'</td>
										<td>'.$news["creditos"].'</td>
										<td>'.$news["diamantes"].'</td>
										<td>'.$news["thrones"].'</td>
										<td>'.$news["autor"].'</td>
										<td><a type="button" class="btn btn-danger" href='.$config["hotelUrl"].'/adminpan/catalogme/delete/'.$news["id"].'>'.$lang["Hkreporttema5"].'</center></a></td></td>
										</tr>
										';
									}			
								?>
                                   </tbody>
								</table>
								</div>
					</div>
				</section>
  </main>
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
</body>


</html>