<div class="col-lg-12 ">
    <small class="text-light fw-semibold">CRM</small>
    <div class="demo-inline-spacing mt-3">
        <div class="list-group list-group-horizontal-md text-md-center">
            <a class="list-group-item list-group-item-action active" id="home-list-item" data-bs-toggle="list"
                href="#horizontal-home">Generar actividad</a>
            <a class="list-group-item list-group-item-action " id="profile-list-item" data-bs-toggle="list"
                href="#horizontal-profile">Actividades</a>
            <!-- <a class="list-group-item list-group-item-action" id="messages-list-item" data-bs-toggle="list"
                href="#horizontal-messages">Messages</a>
            <a class="list-group-item list-group-item-action" id="settings-list-item" data-bs-toggle="list"
                href="#horizontal-settings">Settings</a> -->
        </div>
        <div class="tab-content px-0 mt-0 card">
            <div class="tab-pane fade active show" id="horizontal-home">
                <!-- init  -->
                <div class="container mt-5">
                    <div class="activity-form">
                        <h2 class="mb-4">Registro de Actividades - CRM</h2>
                        <form>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="activity-date">Fecha y Hora de la Actividad:</label>
                                    <input class="form-control" type="date" id="activity-date" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="activity-area">Área de la Actividad:</label>
                                    <select class="form-select" id="activity-area" required>
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
                                    <label for="activity-start-time">Hora de Inicio:</label>
                                    <input class="form-control" type="time" id="activity-start-time" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="activity-end-time">Hora de Fin:</label>
                                    <input class="form-control" type="time" id="activity-end-time" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="activity-type">Tipo de Actividad:</label>
                                    <select class="form-select" id="activity-type" required>
                                        <option value="" disabled selected>Seleccione un tipo</option>
                                        <option value="llamada">Llamada</option>
                                        <option value="reunion">Reunión</option>
                                        <option value="tarea">Tarea</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="activity-description">Descripción:</label>
                                    <textarea class="form-control" id="activity-description" rows="3"
                                        required></textarea>
                                </div>
                            </div>

                            <!-- hide divs meet -->
                            <div id="DivMeet">
                                <!-- 1 -->
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="clientSelect">Clientes:</label>
                                        <select multiple class="form-control js-example-basic-multiple"
                                            id="clientSelect" name="companies[]">
                                            <?php
                                            foreach ($companies as $comp) {
                                                echo "<option value='".$comp['c_id']."'>".$comp['c_name']."</option>";
                                            }
                    
                                            ?>
                                            <!-- Agrega más opciones de clientes aquí -->
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="attendees">Asistentes:</label>
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
                                </div>
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
                                        <textarea class="form-control" id="comments" name="comments"
                                            rows="4"></textarea>
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
                <!-- end -->
            </div>
            <div class="tab-pane fade" id="horizontal-profile">
                <div class="container table-responsive">
                    <h1>Tabla de Actividades CRM</h1>

                    <table class="DataTable text-center table align-middle slide-in-top table-hover table-responsive">
                        <thead>
                            <tr>
                                <th class="text-nowrap">Fecha y Hora</th>
                                <th class="text-nowrap">Tipo de Actividad</th>
                                <th class="text-nowrap">Asunto o Descripción</th>
                                <th class="text-nowrap">Cliente o Contacto</th>
                                <th class="text-nowrap">Usuario Responsable</th>
                                <th class="text-nowrap">Estado</th>
                                <th class="text-nowrap">Prioridad</th>
                                <th class="text-nowrap">Seguimiento</th>
                                <th class="text-nowrap">Notas o Comentarios</th>
                                <th class="text-nowrap">Adjuntos</th>
                                <th class="text-nowrap">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Ejemplo de una fila de actividad -->
                            <tr>
                                <td>2023-09-15 10:00 AM</td>
                                <td>Llamada</td>
                                <td>Llamada de seguimiento</td>
                                <td>Jane Doe</td>
                                <td>John Smith</td>
                                <td>Completada</td>
                                <td>Alta</td>
                                <td>2023-09-20</td>
                                <td>Detalles de la llamada...</td>
                                <td>No</td>
                                <td class="actions">
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-outline-warning">Editar</button>
                                        <button type="button" class="btn btn-outline-danger">Eliminar</button>
                                        <button type="button" class="btn btn-outline-info">Detalles</button>
                                    </div>
                                </td>
                            </tr>
                            <!-- Otras filas de actividades pueden ir aquí -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="horizontal-messages">
                Ice cream dessert candy sugar plum croissant cupcake tart pie apple pie. Pastry chocolate
                chupa chups tiramisu. Tiramisu cookie oat cake. Pudding brownie bonbon. Pie carrot cake
                chocolate macaroon. Halvah jelly jelly beans cake macaroon jelly-o. Danish pastry dessert
                gingerbread powder halvah. Muffin bonbon fruitcake dragée sweet sesame snaps oat cake
                marshmallow cheesecake. Cupcake donut sweet bonbon cheesecake soufflé chocolate bar.
            </div>
            <div class="tab-pane fade" id="horizontal-settings">
                Marzipan cake oat cake. Marshmallow pie chocolate. Liquorice oat cake donut halvah jelly-o.
                Jelly-o muffin macaroon cake gingerbread candy cupcake. Cake lollipop lollipop jelly brownie
                cake topping chocolate. Pie oat cake jelly. Lemon drops halvah jelly cookie bonbon cake
                cupcake ice cream. Donut tart bonbon sweet roll soufflé gummies biscuit. Wafer toffee
                topping jelly beans icing pie apple pie toffee pudding. Tiramisu powder macaroon tiramisu
                cake halvah.
            </div>
        </div>
    </div>
</div>