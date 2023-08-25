<div class="container">
    <div class="row">
        <div class="col-md-12">
            <!-- Left column: Sidebar -->
            <div class="sidebar">
                <div class="logo text-center">
                    <img src="<?= LOGOBLACK ?>" alt="Logo de Mensajes" class="img-fluid">
                </div>
                <div class="menu p-2">
                    <!-- <div class="menu-item active">Bandeja de entrada</div> -->
                    <!-- <div class="menu-item">Importante</div>
                    <div class="menu-item">Enviados</div>
                    <div class="menu-item">Borradores</div>
                    <div class="menu-item">Spam</div>
                    <div class="menu-item">Papelera</div>
                    <div class="menu-item">Categorías</div>
                    <div class="menu-item">Etiquetas</div> -->
                </div>
                <!-- <div class="compose-btn">
                    <button class="btn btn-primary btn-block">Aceptar</button>
                </div> -->
            </div>
        </div>

    </div>
   
        <div class="col-md-12">
            <div class="message-list table-responsive">
                <h3>Peticion de registro</h3>
                <table class="DataTable text-center table align-middle slide-in-top table-hover table-responsive">
                    <thead class="table-dark">
                        <tr>
                            <th>Nombre empresa</th>
                            <th>Representante legal</th>
                            <th>Fecha</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($companies as $c): ?>
                        <tr>
                            <td><?php echo $c['c_name']; ?></td>
                            <td><?php echo $c['representant'][0]['u_name'].' '. $c['representant'][0]['u_lastname']; ?>
                            </td>
                            <td><?php echo $c['created_at']; ?></td>
                            <td>
                                <button class="btn btn-primary btn-sm messageInboxRequest" data-id="<?= $c['c_id'] ?>"
                                    data-url="<?= Helpers\generateUrl("Inbox","Inbox","viewRequestRegister",[],"ajax") ?>">
                                    Abrir
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <hr>
        <div class="col-md-12">
            <div class="message-list table-responsive">
                <h3>Pendiente a registro de documentos</h3>
                <table class="DataTable text-center table align-middle slide-in-top table-hover table-responsive">
                    <thead class="table-dark">
                        <tr>
                            <th>Nombre empresa</th>
                            <th>Representante legal</th>
                            <th>Fecha</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($companiesPendig  as $c): ?>
                        <tr>
                            <td><?php echo $c['c_name']; ?></td>
                            <td><?php echo $c['representant'][0]['u_name'].' '. $c['representant'][0]['u_lastname']; ?>
                            </td>
                            <td><?php echo $c['created_at']; ?></td>
                            
                            <td>
                                <button class="btn btn-dark btn-sm">
                                <i class="fa-solid fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    

</div>