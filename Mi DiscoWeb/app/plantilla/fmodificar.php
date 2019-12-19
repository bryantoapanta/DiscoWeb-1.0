<?php

// Guardo la salida en un buffer(en memoria)
// No se envia al navegador
ob_start();
// FORMULARIO DE ALTA DE USUARIOS
?>
<div id='aviso'>
	<b><?= (isset($msg))?$msg:"" ?></b>
</div>
<center>
	<h1>MODIFICAR USUARIO <?= $user ?> </h1>
	<form name='modificar' method="POST" action="index.php?orden=Modificar" >
		<!-- COMPLETAR -->
		<table id="fmodificar">

			<tr>
				<td>Identificador</td>
				<td><input type="text" name="iduser" value="<?= $user ?>" readonly length></td>

			</tr>

			<tr>
				<td>Nombre</td>
				<td><input type="text" name="nombre" value="<?= $nombre ?>"></td>

			</tr>

			<tr>
				<td>Correo Electronico</td>
				<td><input type="email" name="email" value="<?= $mail ?>"></td>

			</tr>

			<tr>
				<td>Contrasena</td>
				<td><input type="password" name="clave1" value="<?= $clave ?>"></td>

			</tr>

			<tr>
				<td>Plan</td>
				<td><select name="plan">
						<option value="0">Básico</option>
						<option value="1">Profesional</option>
						<option value="2">Premium</option>
				</select></td>

			</tr>

			<tr>
				<td>Estado</td>
				<td><select name="estado">
						<option value="A">Activo</option>
						<option value="I">Inactivo</option>
						<option value="B">Bloqueado</option>

				</select></td>

			</tr>

		</table>

		<p><input type='button' name="orden" value='Volver'
			onclick="verUsuarios()"> <input type='submit' value='Modificar'>
			</p>
	</form>
</center>
<?php
// Vacio el bufer y lo copio a contenido
// Para que se muestre en div de contenido
$contenido = ob_get_clean();
include_once "principal.php";

?>