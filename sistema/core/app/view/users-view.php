<section class="content">
	<div class="row">
		<div class="col-md-12">
			<h2><i class="fa fa-users"></i> Lista de Usuarios</h2>
			<a href='#' data-id="2" data-toggle='modal' data-target="#detail_product" class="btn btn-primary"><i class='glyphicon glyphicon-user'></i> Nuevo Usuario</a>
			<br><br>
			<?php $users = UserData::getAll();
			if(count($users)>0){ ?>
				<div class="box box-primary">
					<div class="box-body no-padding">
						<div class="box-body">
							<div class="box-body table-responsive">
								<table class="table table-bordered datatable table-hover">
									<thead>
										<th style="text-align: center; width: 30px;">N°</th>
										<th style="text-align: center; width: 30px;">Foto</th>
										<th style="text-align: center;">Nombre&nbsp;Completo</th>
										<th style="text-align: center;">Usuario</th>
										<th style="text-align: center;">Correo&nbsp;Electrónico</th>
										<th style="text-align: center;">Activo</th>
										<th style="text-align: center;">Tipo</th>
										<th style="text-align: center; width:150px;">Acción</th>
									</thead>
									<?php for ($number=0; $number<1; $number++);
									foreach($users as $user){ ?>
										<tr>
											<td style="text-align: center;"><?php echo $number; ?></td><?php $number++;?>
											<td style='text-align: center;'>
												<?php
												if($user->image!=""){
													$url = "storage/profiles/".$user->image;
													if(file_exists($url)){
														echo "<img src='$url' style='width:110px; height:120px;'>";
													}
												} ?></td>
												<td><?php echo $user->name." ".$user->lastname; ?></td>
												<td><?php echo $user->username; ?></td>
												<td><?php echo $user->email; ?></td>
												<td style="text-align: center;"><?php if($user->status==1):?>
												<i class="glyphicon glyphicon-ok"></i>
												<?php endif; ?></td>
												<td><?php switch ($user->kind) {
													case '1': echo "Administrador"; break;
													case '2': echo "Agente"; break;
													case '3': echo "Cliente"; break;
													default:
											# code...
													break;
												} ?></td>
												<td style="text-align: center;"><a href="index.php?view=user_edit&id=<?php echo $user->id;?>" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i> Editar</a>
													<a href="index.php?action=user_del&id=<?php echo $user->id;?>" onclick="return confirm('¿Está seguro de eliminar?')" class="btn btn-danger btn-xs"><i class="fa fa-edit"></i> Eliminar</a></td>
												</tr>
											<?php }	 echo "</table></div>";
										}else{ } ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
				<div class="modal fade" id="detail_product" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"><!--Inicio de ventana modal 2-->
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title" style="text-align: center;">Nuevo Usuario</h4>
							</div>
							<div class="modal-body">
								<form class="form-horizontal" enctype="multipart/form-data"  method="post" id="user_add" action="index.php?action=user_add" role="form">
									<div class="form-group">
										<label for="inputEmail1" class="col-lg-2 control-label">Foto&nbsp;JPG (400x400px)</label>
										<div class="col-md-9">
											<input type="file" name="image" id="image" placeholder="">
										</div>
									</div>
									<div class="form-group">
										<label for="inputEmail1" class="col-lg-2 control-label">Nombre*</label>
										<div class="col-md-9">
											<input type="text" name="name" class="form-control" id="name" placeholder="Nombre" required>
										</div>
									</div>
									<div class="form-group">
										<label for="inputEmail1" class="col-lg-2 control-label">Apellidos*</label>
										<div class="col-md-9">
											<input type="text" name="lastname" required class="form-control" id="lastname" placeholder="Apellidos">
										</div>
									</div>
									<div class="form-group">
										<label for="inputEmail1" class="col-lg-2 control-label">Correo Electrónico*</label>
										<div class="col-md-9">
											<input type="text" name="email" class="form-control" id="email" placeholder="Correo Electrónico">
										</div>
									</div>
									<div class="form-group">
										<label for="inputEmail1" class="col-lg-2 control-label">Teléfono*</label>
										<div class="col-md-9">
											<input type="text" name="phone" class="form-control" id="phone" placeholder="Número de teléfono">
										</div>
									</div>
									<div class="form-group">
										<label for="inputEmail1" class="col-lg-2 control-label">Contrase&ntilde;a*</label>
										<div class="col-md-9">
											<input type="text" name="password" class="form-control" id="password" required placeholder="Contraseña" >
										</div>
									</div>
									<div class="form-group">
										<label for="inputEmail1" class="col-lg-2 control-label">Tipo</label>
										<div class="col-md-9">
											<select name="kind" class="form-control" required>
												<option value="">-- SELECCIONAR --</option>
												<option value="2">Agente</option>
												<option value="3">Cliente</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<div class="col-lg-offset-2 col-lg-9">
											<p class="alert alert-info">* Campos obligatorios</p>
										</div>
									</div>
									<div class="form-group">
										<div class="col-lg-offset-2 col-lg-10">
											<button type="submit" class="btn btn-primary">Agregar Usuario</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>