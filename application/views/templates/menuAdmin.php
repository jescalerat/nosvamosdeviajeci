<table>
		<tr>
			<td valign="top">
				<h2 class="text-center"><!--<? //$_SESSION['nombre'] ?>--></h2>
				<table>
					<tr>
						<th>
							Administracion
						</th>
					</tr>
					<tr>
						<td>
							&nbsp;
							<a href="<?= site_url('admin/bbdd') ?>">BBDD</a>
						</td>
					</tr>
					<tr>
						<td>
							&nbsp;
							<a href="<?= site_url('admin/visitasAdmin') ?>">Visitas</a>
						</td>
					</tr>
					<tr>
						<td>
							&nbsp;
							<a href="rutas.php">Rutas</a>
						</td>
					</tr>
					<tr>
						<td>
							&nbsp;
							<a href="comentarios.php">Comentarios</a>
						</td>
					</tr>
					<tr>
						<td>
							&nbsp;
							<a href="fotos.php">Fotos</a>
						</td>
					</tr>
					
					<tr>
						<th>
							Consultas
						</th>
					</tr>
					<tr>
						<td>
							&nbsp;
							<a href="<?= site_url('admin/comprobarVisitas') ?>">Comprobar visitas</a>
						</td>
					</tr>
					<tr>
						<td>
							&nbsp;
							<a href="<?= site_url('admin/comprobarPaginasVistas') ?>">Comprobar p&aacute;ginas vistas</a>
						</td>
					</tr>
					<tr>
						<td>
							&nbsp;
							<a href="<?= site_url('admin/comprobarCorreo') ?>">Comprobar correo</a>
						</td>
					</tr>
					<tr>
						<td>
							&nbsp;
							<a href="<?= site_url('admin/info') ?>">PHP Info</a>
						</td>
					</tr>
					
					<tr>
						<th>
							Privado
						</th>
					</tr>
					<tr>
						<td>
							&nbsp;
							<a href="<?= site_url('admin/cambioPass') ?>">Cambio contrase&ntilde;a</a>
						</td>
					</tr>
					<tr>
						<td>
							&nbsp;
							<a class="admin" href="<?= site_url('admin/salir') ?>">Salir</a>
						</td>
					</tr>
				</table>
			</td>
		</tr>
  </table>
  Contador: <?= $contador ?>