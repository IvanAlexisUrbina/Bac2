<div class="container table-responsive">
    <h1 class="tracking-in-expand">Clientes registrados</h1>
    <div class="d-flex justify-content-between mb-3">
        <span class="lead tracking-in-expand">Total de clientes: <b><?= count($users);?></b></span>
        <a class="btn btn-primary" href="<?= Helpers\generateUrl("Inbox","Inbox","viewInbox");?>">Nuevo cliente</a>
    </div>
    <table class="table DataTable table-hover slide-in-top table-dark table-stripe">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Empresa</th>
                <th scope="col">NIT</th>
                <th scope="col">Nombre representante</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody class="table-light">
            <?php

foreach ($users as $q) {
    $empresa = $q['user'][0]; // Acceder al primer elemento del array de empresas
    
    echo '<tr>
        <td>' . $empresa['c_id'] . '</td>
        <td>' . $empresa['c_name'] . '</td>
        <td>' . $empresa['c_num_nit'] . '</td>
        <td>' . $q['u_name'] . ' ' . $q['u_lastname'] . '</td>
        <td class="text-center">
            <button  data-id="' . $empresa['c_id'] . '" data-url="'.Helpers\generateUrl("Clients","Clients","ModalDocumentsCompany",[],"ajax").'" title="Visualizar Documentos" class="documentsCompany btn btn-outline-dark"><i class="fa-solid fa-eye"></i></button>
            <button data-id="' . $empresa['c_id'] . '" data-url="'.Helpers\generateUrl("Company","Company","UpdateInfoCompanyClients",[],"ajax").'" title="Editar Informacion empresa" class="updateInfoCompany btn btn-outline-warning"><i class="fa-solid fa-pencil"></i></button>
            <button data-id="' . $empresa['c_id'] . '" data-url="'.Helpers\generateUrl("Clients","Clients","CreateMethodsPayCompanies",[],"ajax").'" title="Asignar metodos de pago" class="createMethodsPay btn btn-outline-success"><i class="fa-solid fa-money-bill"></i></button>
        </td>
    </tr>';
}

			?>
        </tbody>
    </table>
</div>