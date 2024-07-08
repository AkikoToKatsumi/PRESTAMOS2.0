			<!-- Page header -->
			<div class="full-box page-header">
				<h3 class="text-left">
					<i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE CLIENTES
				</h3>
				<p class="text-justify">
Aqui podrás visualizar la lista de los clientes que ya hay registrados en el software, en este apartado puedes eliminar o actualizar los datos del cliente que selecciones.				</p>
			</div>

			<div class="container-fluid">
				<ul class="full-box list-unstyled page-nav-tabs">
					<li>
						<a href="<?php echo SERVERURL; ?>client-new/"><i class="fas fa-plus fa-fw"></i> &nbsp; AGREGAR CLIENTE</a>
					</li>
					<li>
						<a class="active" href="<?php echo SERVERURL; ?>client-list/"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE CLIENTES</a>
					</li>
					<li>
						<a href="<?php echo SERVERURL; ?>client-search/"><i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR CLIENTE</a>
					</li>
				</ul>	
			</div>
			<section class="section">
			<div class="row" id="table-responsive">
            <div class="card">
			<!-- Content here-->
			<div class="card-content">
		
			<?php
		require_once "./controladores/clienteControlador.php";
		$ins_cliente = new clienteControlador();

		echo $ins_cliente->paginador_cliente_controlador($pagina[1],15,
		$_SESSION['privilegio_spm'],$pagina[0],"");
	?>
			</div>
			</div>
		</div>
		</section>