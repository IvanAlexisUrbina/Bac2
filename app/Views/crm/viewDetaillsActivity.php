<div class="col-lg-12 card p-4">
    <div class="container ">
        <!-- init  -->
        <div class="container mt-5">
            <div class="activity-form">
                <h2 class="mb-4">Detalles de la actividad</h2>
                <form action="" method="POST">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="activity-type">Tipo de Actividad:</label>
                            <p class="form-control"><?php echo ucfirst($activity[0]['crm_activity']); ?></p>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="activity-area">Área de la Actividad:</label>
                            <p class="form-control"><?php echo ucfirst($activity[0]['crm_area']); ?></p>

                        </div>
                    </div>


                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="activity-date">Fecha y Hora de inicio:</label>
                            <p class="form-control"><?php echo ucfirst($activity[0]['crm_date_time_init']); ?></p>

                        </div>
                        <div class="form-group col-md-6">
                            <label for="activity-date">Fecha y Hora de finalizacion:</label>
                            <p class="form-control"><?php echo ucfirst($activity[0]['crm_date_time_end']); ?></p>

                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="attendees">Encargados:</label>
                            <ul>
                                <?php foreach ($activity[0]['attendees'] as $attendee): ?>
                                <li><?php echo $attendee['u_name'] . ' ' . $attendee['u_lastname'] . ' - ' . $attendee['u_email']; ?>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="clientSelect">Clientes:</label>
                            <ul class="list-group">
                                <?php foreach ($activity[0]['clients'] as $client): ?>
                                <li>
                                    <?php echo $client[0]['c_name']; ?>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>

                    </div>


                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="activity-description">Descripción:</label>
                            <textarea readonly name="crm_desc" class="form-control" id="activity-description" rows="3"
                                required><?php echo $activity[0]['crm_desc']; ?></textarea>
                        </div>
                    </div>

                    <!-- hide divs meet -->
                    <?php if (!empty($activity[0]['meetingDetaills'])): ?>
                    <?php foreach ($activity[0]['meetingDetaills'] as $meetingDetaills): ?>
                    <!-- 2 -->
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="meetingType">Asunto de la Reunión:</label>
                            <label for="" class="form-control"><?= $meetingDetaills['meeting_type'] ?></label>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="meetingType">Link de la Reunión:</label>
                            <label for="" class="form-control"><?= $meetingDetaills['meeting_link'] ?></label>
                        </div>
                    </div>
                    <!-- 3 -->

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="comments">Comentarios:</label>
                            <textarea class="form-control" id="comments" name="comments"
                                rows="4"><?= $meetingDetaills['comments'] ?></textarea>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <?php endif; ?>
            </div>
            <?php
                    if (!empty($activity[0]['crm_reminder'])) {
                        
                    ?>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="activity-reminder">¿Recordatorio?</label>
                    <input class="form-check-input" type="checkbox" checked disabled id="activity-reminder"
                        name="activity-reminder">
                    <div class="form-group col-md-12 mt-2" id="reminder-details">
                        <label for="activity-reminder-time">Hora del Recordatorio:</label>
                        <label for="" class="form-control"><?= $activity[0]['crm_reminder']?></label>
                    </div>
                </div>
            </div>

            <?php }?>
            </form>
        </div>
        <!-- end -->
    </div>