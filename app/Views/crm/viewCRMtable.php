<div class="container table-responsive">
    <h1>Actividades</h1>

    <table class="DataTable  text-center truncate table align-middle slide-in-top table-hover table-responsive">
        <thead class="table-dark">
            <tr>
                <th class="text-nowrap text-white">Fecha y Hora</th>
                <th class="text-nowrap text-white">Tipo de Actividad</th>
                <th class="text-nowrap text-white">Asunto o Descripción</th>
                <th class="text-nowrap text-white">Cliente o Contacto</th>
                <th class="text-nowrap text-white">Usuario Responsable</th>
                <th class="text-nowrap text-white">Asignado por</th>
                <th class="text-nowrap text-white">Estado</th>
                <th class="text-nowrap text-white">Prioridad</th>
                <th class="text-nowrap text-white">Recordatorio</th>
                <th class="text-nowrap text-white">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <!-- Ejemplo de una fila de actividad -->
            <?php  foreach ($activities as $act) {?>
            <tr>

                <td><?=$act['crm_date_time_init']?></td>
                <td><?= strtoupper($act['crm_activity']) ?></td>
                <td><?=$act['crm_desc']?></td>
                <td >
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

                <td><?=$act['crm_status']?></td>
                <td>Alta</td>
                <td class="text-success"><?=$act['crm_reminder']?></td>
                <td class="actions">
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-outline-warning">Editar</button>
                        <button type="button" class="btn btn-outline-danger">Eliminar</button>
                        <button  data-url="<?=Helpers\generateUrl("CRM","CRM","consutlDetaillsActivity",[],"ajax")?>" data-id="<?=$act['crm_id']?>" type="button" class="detaillsActivity btn btn-outline-info">Detalles</button>
                    </div>
                </td>

            </tr>
            <?php  }?>
            <!-- Otras filas de actividades pueden ir aquí -->
        </tbody>
    </table>
</div>