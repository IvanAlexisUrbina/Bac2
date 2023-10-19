<div class="container table-responsive">
    <h1 class="tracking-in-expand">Clientes registrados</h1>
    <div class="d-flex justify-content-between mb-3">
        <span class="lead tracking-in-expand">Total de clientes: <b><?= count($users);?></b></span>
        <a class="btn btn-primary" href="<?= Helpers\generateUrl("Inbox","Inbox","viewInbox");?>">Nuevo cliente</a>
    </div>
    <table class="table DataTable text-center truncate align-middle table-hover slide-in-top">
        <thead>
            <tr>
                <th class="text-nowrap" scope="col">#</th>
                <th class="text-nowrap" scope="col">Empresa</th>
                <th class="text-nowrap" scope="col">NIT</th>
                <th class="text-nowrap" scope="col">Nombre representante</th>
                <th class="text-nowrap" scope="col">Estado</th>
                <th class="text-nowrap" scope="col">Acciones</th>
            </tr>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody class="table-light">
            <?php

foreach ($users as $q) {
    $empresa = $q['user'][0]; // Acceder al primer elemento del array de empresas
    
    $statusClass = $empresa['status_id'] == 1 ? 'text-success' : 'text-danger';

    echo '<tr>
        <td>' . $empresa['c_id'] . '</td>
        <td>' . $empresa['c_name'] . '</td>
        <td>' . $empresa['c_num_nit'] . '</td>
        <td>' . $q['u_name'] . ' ' . $q['u_lastname'] . '</td>
        <td class="' . $statusClass . '">' . $empresa['status_name'] . '</td>
        <td class="text-center btn-group">
            <button  data-id="' . $empresa['c_id'] . '" data-url="'.Helpers\generateUrl("Clients","Clients","ModalDocumentsCompany",[],"ajax").'" title="Visualizar Documentos" class="documentsCompany btn btn-outline-dark"><i class="fa-solid fa-eye"></i></button>
            <button data-id="' . $empresa['c_id'] . '" data-url="'.Helpers\generateUrl("Company","Company","UpdateInfoCompanyClients",[],"ajax").'" title="Editar Informacion empresa" class="updateInfoCompany btn btn-outline-warning"><i class="fa-solid fa-pencil"></i></button>
            <button data-id="' . $empresa['c_id'] . '" data-url="'.Helpers\generateUrl("Clients","Clients","CreateMethodsPayCompanies",[],"ajax").'" title="Asignar metodos de pago" class="createMethodsPay btn btn-outline-success"><i class="fa-solid fa-money-bill"></i></button>
            <button data-id="' . $empresa['c_id'] . '" data-url="'.Helpers\generateUrl("Clients","Clients","updateStatusCompanyAndUser",[],"ajax").'" title="Actualizar estado" class="updateStatusClient btn btn-outline-info"><i class="fa-solid fa-pencil"></i></button>
        </td>
    </tr>';
}


			?>
        </tbody>
    </table>
</div>