<div class="container table-responsive">
    <h1 class="tracking-in-expand">Limite de creditó</h1>
    <div class="d-flex justify-content-between mb-3">
        <span class="lead tracking-in-expand">Total de clientes: <b><?= count($users);?></b></span>
        <!-- <a class="btn btn-primary" href="">Nuevo cupo</a> -->
    </div>
    <table class="table DataTable table-hover slide-in-top table-secondary table-stripe">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Empresa</th>
                <th scope="col">NIT</th>
                <th scope="col">Nombre representante</th>
                <th scope="col">Limite de credito</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody class="table-light">
            <?php

        foreach ($users as $q) {
            $empresa = $q['user'][0]; // Acceder al primer elemento del array de empresas
            $limit = $q['credit'][0]['credit_limit'] ?? null; 
            
            echo '<tr>
                <td>' . $empresa['c_id'] . '</td>
                <td>' . $empresa['c_name'] . '</td>
                <td>' . $empresa['c_num_nit'] . '</td>
                <td>' . $q['u_name'] . ' ' . $q['u_lastname'] . '</td>
                <td>';

            // Verificar si existe el límite de crédito
            if (isset($limit['credit_limit'])) {
                echo $limit['credit_limit'];
            } else {
                echo 'Aún no tiene asignado un límite crediticio';
            }

            echo '</td>
                <td class="text-center">
                    <button data-id="' . $empresa['c_id'] . '" data-url="'.Helpers\generateUrl("Clients","Clients","updateCreditLimitModal",[],"ajax").'" title="Editar crédito" class="updateCreditLimit btn btn-outline-warning"><i class="fa-solid fa-credit-card"></i></button>
                </td>
            </tr>';
        }


			?>
        </tbody>
    </table>
</div>