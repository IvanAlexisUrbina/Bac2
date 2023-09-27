<div class="container ">
    <!-- init  -->


    <div class="container mt-5">
        <div class="activity-form">
            <h2 class="mb-4">Registro de Actividades - CRM</h2>
            <form action="<?= Helpers\generateUrl("CRM","CRM","insertActivityCRM");?>" method="POST">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="activity-type">Tipo de Actividad:</label>
                        <select class="form-select" name="activity-type" id="activity-type" required>
                            <?php

                            use function Helpers\dd;

                            $selectedOption = $activity[0]['crm_activity']; // Valor seleccionado
                            $options = ["llamada", "reunion", "tarea", "nota", "campaña", "otro"]; // Opciones disponibles
                            foreach ($options as $option) {
                                echo '<option value="' . $option . '"';
                                if ($option === $selectedOption) {
                                    echo ' selected';
                                }
                                echo '>' . ucfirst($option) . '</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="activity-area">Área de la Actividad:</label>
                        <select class="form-select" name="activity-area" id="activity-area" required>
                            <?php
                        $selectedArea = $activity[0]['crm_area']; // Valor seleccionado
                        $areas = ["ventas", "soporte", "Cotizacion", "Pedido"]; // Áreas disponibles
                        foreach ($areas as $area) {
                            echo '<option value="' . $area . '"';
                            if ($area === $selectedArea) {
                                echo ' selected';
                            }
                            echo '>' . ucfirst($area) . '</option>';
                        }
                        ?>
                        </select>
                    </div>

                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="activity-date">Fecha y Hora de inicio:</label>
                        <input class="form-control" value="<?= $activity[0]['crm_date_time_init']?>"
                            type="datetime-local" name="activity-date-init" id="activity-date-init" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="activity-date">Fecha y Hora de finalizacion:</label>
                        <input class="form-control" value="<?=$activity[0]['crm_date_time_end']?>" type="datetime-local"
                            name="activity-date-end" id="activity-date-end" required>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="attendees">Asignar actividad a:</label>
                        <select multiple class="form-control js-example-basic-multiple" id="" name="attendees[]">
                            <?php
                            foreach ($usersCompany as $users) {
                                echo "<option value='".$users['u_id']."'>".$users['u_name']." - ".$users['u_email']."</option>";
                            }
                            ?>
                            <!-- Agrega más opciones de vendedores o personas aquí -->
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="clientSelect">Clientes:</label>
                        <select multiple class="form-control js-example-basic-multiple"  name="companies[]">
                            <?php
                            $selectedClients = $activity[0]['clients'][0][0];
                        
                            foreach ($companies as $comp) {
                                $clientId = $comp['c_id'];
                                $clientName = $comp['c_name'];
                                $isSelected = in_array($clientId, $selectedClients) ? 'selected' : '';
                                echo '<option value="' . $clientId . '" ' . $isSelected . '>' . $clientName . '</option>';
                            }
                            ?>
                        </select>
                    </div>


                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="activity-description">Descripción:</label>
                        <textarea name="crm_desc" class="form-control" id="activity-description" rows="3"
                            required></textarea>
                    </div>
                </div>

                <!-- hide divs meet -->
                <div>

                    <!-- 2 -->
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="meetingType">Asunto de la Reunión:</label>
                            <input type="text" class="form-control" id="meetingType" name="meetingType">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="meetingType">link de la Reunión:</label>
                            <input type="text" class="form-control" id="meetingLink" name="meetingLink">
                        </div>
                    </div>
                    <!-- 3 -->
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="comments">Comentarios:</label>
                            <textarea class="form-control" id="comments" name="comments" rows="4"></textarea>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="activity-reminder">¿Recordatorio?</label>
                        <input class="form-check-input" type="checkbox" id="activity-reminder" name="activity-reminder">
                        <div class="form-group col-md-12 mt-2" id="reminder-details" style="display: none;">
                            <label for="activity-reminder-time">Hora del Recordatorio:</label>
                            <input class="form-control" type="datetime-local" name="activity-reminder-time"
                                id="activity-reminder-time">
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary">Guardar Actividad</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
