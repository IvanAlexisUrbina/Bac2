<div class="container mt-5">
  <h2 class="mb-4">Agendar Reunión</h2>
  <form id="meetingForm">
    <div class="form-group">
      <label for="clientSelect">Clientes:</label>
      <select multiple class="form-control js-example-basic-multiple
      
      " id="clientSelect">
        <option value="cliente1">Cliente 1</option>
        <option value="cliente2">Cliente 2</option>
        <option value="cliente3">Cliente 3</option>
        <!-- Agrega más opciones de clientes aquí -->
      </select>
    </div>
    <div class="form-group">
      <label for="attendees">Asistentes:</label>
      <select multiple class="form-control js-example-basic-multiple" id="attendees">
        <option value="vendedor1">Vendedor 1</option>
        <option value="vendedor2">Vendedor 2</option>
        <option value="vendedor3">Vendedor 3</option>
        <!-- Agrega más opciones de vendedores o personas aquí -->
      </select>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="meetingDate">Fecha de Reunión:</label>
        <input type="date" class="form-control" id="meetingDate">
      </div>
      <div class="form-group col-md-6">
        <label for="meetingTime">Hora de Reunión:</label>
        <input type="time" class="form-control" id="meetingTime">
      </div>
    </div>
    <div class="form-group">
      <label for="meetingType">Tipo de Reunión:</label>
      <input type="text" class="form-control" id="meetingType">
    </div>
    <div class="form-group">
      <label for="comments">Comentarios:</label>
      <textarea class="form-control" id="comments" rows="4"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Agendar Reunión</button>
  </form>
</div>

