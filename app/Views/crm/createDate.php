<div class="container mt-5">
    <h2 class="mb-4">Agendar Reunión</h2>
    <form id="meetingForm" method="POST">
        <div class="form-group">
            <label for="clientSelect">Clientes:</label>
            <select multiple class="form-control js-example-basic-multiple
      
      " id="clientSelect" name="companies[]">
                <?php
        foreach ($companies as $comp) {
            echo "<option value='".$comp['c_id']."'>".$comp['c_name']."</option>";
        }
        
        ?>
                <!-- Agrega más opciones de clientes aquí -->
            </select>
        </div>
        <div class="form-group">
            <label for="attendees">Asistentes:</label>
            <select multiple class="form-control js-example-basic-multiple" id="attendees" name="attendees[]">
                <?php
        foreach ($usersCompany as $users) {
            echo "<option value='".$users['u_id']."'>".$users['u_name']." - ".$users['u_email']."</option>";
        }
        
        ?>
                <!-- Agrega más opciones de vendedores o personas aquí -->
            </select>
        </div>
        <div class="form-row d-flex">
            <div class="form-group col-md-3 mb-3">
                <label for="meetingDate">Fecha de Reunión:</label>
                <input type="date" class="form-control" id="meetingDate" name="meetingDate">
            </div>
            <div class="form-group col-md-3 mb-3">
                <label for="meetingTime">Hora de Reunión:</label>
                <input type="time" class="form-control" id="meetingTime" name="meetingTime">
            </div>
        </div>

        <div class="form-group">
            <label for="meetingType">Asunto de la Reunión:</label>
            <input type="text" class="form-control" id="meetingType" name="meetingType">
        </div>

        <div class="form-group">
            <label for="meetingType">link de la Reunión:</label>
            <input type="text" class="form-control" id="meetingLink" name="meetingLink">
        </div>

        <div class="form-group">
            <label for="comments">Comentarios:</label>
            <textarea class="form-control" id="comments"  name="comments" rows="4"></textarea>
        </div>
        <button type="button" data-url="<?= Helpers\generateUrl("CRM","CRM","sendNotificationEmail",[],"ajax")?>" id="meetingFormButton" class="btn btn-primary">Agendar Reunión</button>
    </form>
</div>