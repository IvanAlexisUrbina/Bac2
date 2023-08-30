<div class="container table-responsive">
    <h1 class="tracking-in-expand">Vendedores</h1>
    <div class="d-flex justify-content-between mb-3">
        <span class="lead tracking-in-expand">Total de vendedores: <b><?= count($sellers);?></b></span>
        <button id="createSeller" class="btn btn-outline-primary" data-url="<?= Helpers\generateUrl("Clients","Clients","CreateSeller",[],"ajax")?>">Crear vendedores</button>    
    </div>

    <table class="table DataTable table-hover slide-in-top table-dark table-stripe">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Email</th>
                <th scope="col">Numero de telefono</th>
                <th scope="col">Codigo</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody class="table-light">
            <?php
				foreach ($sellers as $s) {
					echo '<tr>
					<td>'.$s['u_id'].'</td>
					<td>'.$s['u_name'].'</td>
					<td>'.$s['u_email'].'</td>
					<td>'.$s['u_phone'].'</td>
					<td>'.$s['u_codeSeller'].'</td>
					<td class="text-center">
					<button title="Asignar cliente" class="btn btn-outline-dark" data-id='.$s['u_id'].' id="CompanyAndSeller" data-url='.Helpers\generateUrl("Clients","Clients","SellerAndCompanyModal",[],"ajax").'><i class="fa-solid fa-building"></i></button>
					<button class="btn btn-outline-warning" data-id='.$s['u_id'].' id="UpdateSeller" data-url='.Helpers\generateUrl("Clients","Clients","SellerUpdateModal",[],"ajax").'><i class="fa-solid fa-pencil"></i></button>
					</td>
					</tr>';
				}
			?>
        </tbody>
    </table>
</div>