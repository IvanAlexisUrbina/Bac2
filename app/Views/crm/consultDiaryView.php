<div class="container mt-5">
        <div class="activity-form">
            <h2 class="mb-4">Registro de Actividades - CRM</h2>
            <form>
                <div class="form-group col-md-6">
                    <label for="activity-date">Fecha y Hora de la Actividad:</label>
                    <div class="input-group date" id="datetimepicker" data-target-input="nearest">
                    <input class="form-control" type="datetime-local" value="2021-06-18T12:30:00" id="html5-datetime-local-input">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label for="activity-type">Tipo de Actividad:</label>
                    <select class="form-select" id="activity-type" required>
                        <option value="" disabled selected>Seleccione un tipo</option>
                        <option value="llamada">Llamada</option>
                        <option value="reunion">Reunión</option>
                        <option value="tarea">Tarea</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="activity-description">Descripción:</label>
                    <textarea class="form-control" id="activity-description" rows="3" required></textarea>
                </div>
                <div class="row mt-2  ">
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary">Guardar Actividad</button>

                    </div>
                </div>
            </form>
        </div>
    </div>