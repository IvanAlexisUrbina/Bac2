<div class="container table-responsive">
    <h1>Actividades</h1>

    <table class="DataTable  text-center truncate table align-middle slide-in-top table-hover">
        <thead>
            <tr>
                <th class="text-nowrap">Fecha y Hora</th>
                <th class="text-nowrap">Tipo de Actividad</th>
                <th class="text-nowrap">Asunto o Descripción</th>
                <th class="text-nowrap">Cliente o Contacto</th>
                <th class="text-nowrap">Usuario Responsable</th>
                <th class="text-nowrap">Asignado por</th>
                <th class="text-nowrap">Estado</th>
                <th class="text-nowrap">Prioridad</th>
                <th class="text-nowrap">Recordatorio</th>
                <th class="text-nowrap">Acciones</th>
            </tr>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <!-- Ejemplo de una fila de actividad -->
            <?php  foreach ($activities as $act) {?>
            <tr>

                <td><?=$act['crm_date_time_init']?></td>
                <td><?= strtoupper($act['crm_activity']) ?></td>
                <td><?=$act['crm_desc']?></td>
                <td>
                    <?php 
                    if (!empty($act['clients'])) {
                        echo '<ul class="text-left-custom">';
                        foreach ($act['clients'] as $client) {
                            echo '<li>' . $client[0]['c_name'] . '</li>'; // Mostrar el nombre del cliente
                        }
                        echo '</ul>';
                    } else {
                        echo "No se ha seleccionado ningún cliente";
                    }
                    ?>
                </td>


                <td>
                    <?php 
                    if (!empty($act['attendees'])) {
                        echo '<ul class="text-left-custom">';
                        foreach ($act['attendees'] as $attendee) {
                            echo '<li>' . $attendee['u_name']." ".$attendee['u_lastname']." - ".$attendee['u_email']."</li>"; // Mostrar el nombre del asistente
                        }
                        echo '</ul>';
                    } else {
                        echo "No se ha seleccionado ningún asistente";
                    }
                    ?>
                </td>

                <td class="text-warning">
                    <?php 
                    if (!empty($act['assignor'])) {
                        $assignor = $act['assignor']; // Obtén el array de asignador
                        echo $assignor['u_name'] . " " . $assignor['u_lastname'] . " - " . $assignor['u_email'];
                    } else {
                        echo "No se ha asignado ningún asignador";
                    }
                    ?>
                </td>

                <td><?=$act['status'][0]['status_name']?></td>
                <td><?=$act['priority'][0]['prst_name']?></td>
                <td class="text-success "><span for="" class="badge bg-label-success"><?=$act['crm_reminder']?></span>
                </td>
                <td class="actions">
                    <div class="btn-group" role="group">
                        <!-- <button data-url="<?=Helpers\generateUrl("CRM","CRM","UpdateDetaillsActivity",[],"ajax")?>" data-id="<?=$act['crm_id']?>" type="button" class="updateActivity btn btn-outline-warning">Editar</button> -->
                        <!-- <button type="button" class="btn btn-outline-danger">Eliminar</button> -->
                        <button data-url="<?=Helpers\generateUrl("CRM","CRM","consutlDetaillsActivity",[],"ajax")?>"
                            data-id="<?=$act['crm_id']?>" type="button"
                            class="detaillsActivity btn btn-outline-info">Detalles</button>
                    </div>
                </td>

            </tr>
            <?php  }?>
            <!-- Otras filas de actividades pueden ir aquí -->
        </tbody>
    </table>
</div>