<div class="col-lg-12 card p-4">
    <div class="container ">
        <!-- init  -->
        <div class="container mt-5">
            <div class="activity-form">
                <h2 class="mb-4">Registro de Actividades - CRM</h2>
                <form action="<?= Helpers\generateUrl("CRM","CRM","insertActivityCRM",[],"ajax");?>" method="POST">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="activity-type">Tipo de Actividad:</label>
                            <select class="form-select" name="activity-type" id="activity-type" required>
                                <option value="" disabled selected>Seleccione un tipo</option>
                                <option value="llamada">Llamada</option>
                                <option value="reunion">Reunión</option>
                                <option value="tarea">Tarea</option>
                                <option value="nota">Nota</option>
                                <option value="campaña">campaña</option>
                                <option value="otro">otro</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="activity-area">Área de la Actividad:</label>
                            <select class="form-select" name="activity-area" id="activity-area" required>
                                <option value="" disabled selected>Seleccione un área</option>
                                <option value="ventas">Ventas</option>
                                <option value="soporte">Soporte</option>
                                <option value="Cotizacion">Cotizacion</option>
                                <option value="Pedido">Pedido</option>
                            </select>
                        </div>
                    </div>


                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="activity-date">Fecha y Hora de inicio:</label>
                            <input class="form-control" value="<?= date('Y-m-d\TH:i:s')?>" type="datetime-local"
                                name="activity-date-init" id="activity-date-init" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="activity-date">Fecha y Hora de finalizacion:</label>
                            <input class="form-control" type="datetime-local" name="activity-date-end"
                                id="activity-date-end" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="attendees">Asignar actividad a:</label>
                            <select multiple class="form-control js-example-basic-multiple" id="attendees"
                                name="attendees[]">
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
                            <select multiple class="form-control js-example-basic-multiple" id="clientSelect"
                                name="companies[]">
                                <?php
                                            foreach ($companies as $comp) {
                                                echo "<option value='".$comp['c_id']."'>".$comp['c_name']."</option>";
                                            }
                    
                                            ?>
                                <!-- Agrega más opciones de clientes aquí -->
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="clientSelect">Prioridad de la actividad:</label>
                            <select class="form-select "
                                name="id_prst">
                                <?php
                                            foreach ($priority_States as $prio) {
                                                echo "<option value='".$prio['id_prst']."'>".$prio['prst_name']."</option>";
                                            }
                    
                                            ?>
                                <!-- Agrega más opciones de clientes aquí -->
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="activity-description">Descripción:</label>
                            <textarea name="crm_desc" class="form-control" id="activity-description" rows="3"
                                required></textarea>
                        </div>
                    </div>

                    <!-- hide divs meet -->
                    <div id="DivMeet">

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
                            <input class="form-check-input" type="checkbox" id="activity-reminder"
                                name="activity-reminder">
                            <div class="form-group col-md-12 mt-2" id="reminder-details" style="display: none;">
                                <label for="activity-reminder-time">Hora del Recordatorio:</label>
                                <input class="form-control" type="datetime-local" name="activity-reminder-time"
                                    id="activity-reminder-time">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-3">
                            <button type="button"  id="submit-button-activity" class="btn btn-primary">Guardar Actividad</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- end -->
    </div>