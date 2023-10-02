<div class="container table-responsive">
		<h1 class="tracking-in-expand">Cotizaciones</h1>
		<div class="d-flex justify-content-between mb-3">
		<span class="lead tracking-in-expand">Total de cotizaciones: <b><?= count($quotes);?></b></span>
	</div>
		<table class="DataTable  text-center truncate table align-middle slide-in-top table-hover">
			<thead>
				<tr>
				<th scope="col">Cod_#</th>
				<th scope="col">Empresa</th>
				<th scope="col">Cotizante</th>
				<th scope="col">Fecha del documento</th>
				<th scope="col">Valor</th>
				<th scope="col">Acciones</th>
				</tr>
			</thead>
			<tbody class="table-light">
			<?php
				foreach ($quotes as $q) {
					echo '<tr>
					<td>'.$q['quo_id'].'</td>
					<td>'.$q['c_name'].'</td>
					<td>'.$q['quo_name'].'</td>
					<td>'.$q['quo_date'].'</td>
					<td>'.number_format($q['quo_total'], 2, ',', '.').'</td>
					<td class="text-center">
					<button data-url="'.$q['quo_url_document'].'" title="Visualizar cotizacion" class="pdfModalLink btn btn-outline-warning"><i class="fa-solid fa-eye"></i></button>
					</td>
					</tr>';
				}
			?>
				

			</tbody>
		</table>
	</div>