<div class="container table-responsive">
    <h1 class="tracking-in-expand">Pedidos</h1>
    <div class="d-flex justify-content-between mb-3">
        <span class="lead tracking-in-expand">Total de pedidos: <b><?= count($orders);?></b></span>
    </div>
    <div class="table-responsive">

        <table class="DataTable  text-center truncate table align-middle slide-in-top table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Empresa</th>
                    <th scope="col">Cotizante</th>
                    <th scope="col">Fecha del documento</th>
                    <th scope="col">Estado del documento</th>
                    <th scope="col">Valor</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody class="table-light">
                <?php
				foreach ($orders as $q) {
					echo '<tr>
					<td>'.$q['order_id'].'</td>
					<td>'.$q['c_name'].'</td>
					<td>'.$q['order_name'].'</td>
					<td>'.$q['order_date'].'</td>
					<td>'.$q['state_name_es'].'</td>
					<td>'.number_format($q['order_total'], 2, ',', '.').'</td>
					<td class="text-center">
					<button data-url="'.$q['order_url_document'].'" title="Visualizar cotizacion" class="pdfModalLink btn btn-outline-warning"><i class="fa-solid fa-eye"></i></button>
					<button data-company="'.$q['c_id'].'"data-id="'.$q['order_id'].'"  data-url="'.Helpers\generateUrl("Order","Order","modalStatusOrder",[],"ajax").'" title="Aceptar documento" class="ModalAcceptDocumentOrder btn btn-outline-primary"><i class="fa-solid fa-circle-check"></i></button>
					</td>
					</tr>';
				}
			?>


            </tbody>
        </table>
    </div>
</div>