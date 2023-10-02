<div class="container table-responsive">
    <h1 class="tracking-in-expand">Mis pedidos</h1>
    <div class="d-flex justify-content-between mb-3">
        <span class="lead tracking-in-expand">Total de pedidos: <b><?= count($orders);?></b></span>
        <a class="btn btn-primary" href="<?= Helpers\generateUrl("Order","Order","ViewCreateOrder");?>">Nuevo pedido</a>
    </div>
    <table class="DataTable  text-center truncate table align-middle slide-in-top table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Cliente</th>
                <th scope="col">Fecha del documento</th>
                <th scope="col">Valor</th>
                <th scope="col">Estado del pedido</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody class="table-light">
            <?php
				foreach ($orders as $o) {
					echo '<tr>
					<td>'.$o['order_id'].'</td>
					<td>'.$o['order_name'].'</td>
					<td>'.$o['order_date'].'</td>
					<td>'.number_format($o['order_total'], 2, ',', '.').'</td>
					<td>'.$o['state_name_es'].'</td>
					<td class="text-center">
					<button data-url="'.$o['order_url_document'].'" title="Visualizar pedido" class="pdfModalLink btn btn-outline-warning"><i class="fa-solid fa-eye"></i></button>
					<button data-url="'.$o['order_url_document'].'" title="Pagar pedido" class="pdfModalLink btn btn-outline-success"><i class="fa-solid fa-money-bill"></i></button>
					</td>
					</tr>';
				}


			?>


        </tbody>
    </table>
</div>