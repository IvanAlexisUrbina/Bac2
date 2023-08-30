<?php
use function Helpers\generateUrl;

?>
<link href="css/register.css" rel="stylesheet">


<div class="container card p-4">

    <h1 class="text-center">Registro de Empresas</h1>

    <form id="registerUser" action='<?php echo generateUrl("Access","Access","CompanyRequestRegister",[],"ajax");?>'
        method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="company_name">Nombre de la compañía</label>
                    <input name="company_name" id="company_name" type="text" class="form-control" required>
                    <p class="error"><small>El nombre solo puede contener letras.</small></p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="document">Número de identificación tributaria (NIT)</label>
                    <input name="NIT" id="NIT" type="text" class="form-control" required>
                    <p class="error"><small>El nombre solo puede contener letras.</small></p>

                </div>

            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="industry">Industria</label>
                    <select id="industry" name="industry" class="form-control" required>
                        <option value="" disabled selected>Seleccione una opción</option>
                        <?php foreach ($industries as $key) {
                              echo "<option value=".$key['tpi_id'].">".$key['industry_name']."</option>";
                            }?>
                    </select>


                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="country">País</label>
                    <input name="country" id="country" type="text" class="form-control" value="Colombia" readonly>
                    <p class="error"><small>El nombre solo puede contener letras.</small></p>

                </div>

            </div>

        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="department">Departamento</label>
                    <select data-url="<?php echo Helpers\generateUrl("Access","Access","TownsWithDepto",[],"ajax")?>"
                        name="department" id="department" class="form-control">
                        <option value="" disabled selected>Seleccione una opción</option>
                        <?php foreach ($deptos as $dep) {
                              echo "<option value=".$dep['NOMBRE_DEPTO'].">".$dep['NOMBRE_DEPTO']."</option>";
                            }?>
                    </select>


                </div>
            </div>
            <div class="col-md-6 divTowns">

            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="representative_name">Nombre/s representante</label>
                    <input name="representative_name" id="representative_name" type="text" class="form-control"
                        required>
                    <p class="error"><small>El nombre solo puede contener letras.</small></p>

                </div>

            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="representative_lastname">Apellido/s representante</label>
                    <input name="representative_lastname" id="representative_lastname" type="text" class="form-control"
                        required>
                    <p class="error"><small>El nombre solo puede contener letras.</small></p>

                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="representative_document_type">Tipo de documento</label>
                    <select id="representative_document_type" name="representative_document_type" class="form-select"
                        required>
                        <option value="" disabled selected>Seleccione una opción</option>
                        <option value="Cedula de ciudadanía">Cédula de ciudadanía</option>
                        <option value="Cedula de extranjeria">Cédula de extranjería</option>
                        <option value="Pasaporte">Pasaporte</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="representative_document">Número de documento</label>
                    <input name="representative_document" id="representative_document" type="text" class="form-control"
                        required>
                    <p class="error"><small>El nombre solo puede contener letras.</small></p>

                </div>

            </div>

        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email">Correo electrónico</label>
                    <input name="email" id="email" type="text" class="form-control" required>

                    <p class="error"><small>El nombre solo puede contener letras.</small></p>
                </div>

            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="phone">Número de teléfono</label>
                    <input name="phone" id="phone" type="text" class="form-control" required>
                    <p class="error"><small>El nombre solo puede contener letras.</small>

                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group" id="contPass">
                    <label for="password">Contraseña</label>
                    <input name="password" id="password" type="password" class="form-control" required>
                    <p class="error"><small>La contraseña debe ser de 4 a 12 digitos.</small></p>

                </div>

            </div>
            <div class="col-md-6">
                <div class="form-group" id="contPass2">
                    <label for="confirm_password">Confirmar contraseña</label>
                    <input name="confirm_password" id="confirm_password" type="password" class="form-control" required>

                    <p class="error"><small>Las contraseñas deben ser identicas</small></p>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="form-group mt-2 col-md-6">
                <label for="">Descripcion de la empresa</label>
                <textarea class="form-control" name="c_desc" id="" cols="30" rows="10"></textarea>
            </div>
        </div>
        <!-- RUT File Input -->

        <div class="row">

            <div class="form-group col-md-6">
                <label for="rut">RUT (máx. 2MB, PDF, Word, Excel)</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input form-control" id="rut" name="rut"
                        accept=".pdf,.doc,.docx,.xls,.xlsx" size="2097152" required>

                </div>
                <small class="form-text text-muted error">El archivo debe ser un PDF, Word o Excel de tamaño máximo
                    2MB.</small>
            </div>
            <!-- Chamber of Commerce File Input -->
            <div class="form-group col-md-6">
                <label for="chamber_of_commerce">Cámara de Comercio (máx. 2MB, PDF, Word, Excel)</label>
                <div class="custom-file">
                    <input type="file" class="form-control custom-file-input" id="chamber_of_commerce"
                        name="chamber_of_commerce" accept=".pdf,.doc,.docx,.xls,.xlsx" size="2097152" required>

                </div>
                <small class="form-text text-muted error">El archivo debe ser un PDF, Word o Excel de tamaño máximo
                    2MB.</small>
            </div>
        </div>

        <div class="row">

            <!-- Representative Cedula File Input -->
            <div class="form-group  col-md-6">
                <label for="representative_cedula">Cédula del representante legal (máx. 2MB, PDF, Word, Excel)</label>
                <div class="custom-file">
                    <input type="file" class="form-control custom-file-input" id="representative_cedula"
                        name="representative_cedula" accept=".pdf,.doc,.docx,.xls,.xlsx" size="2097152" required>

                </div>
                <small class="form-text text-muted error">El archivo debe ser un PDF, Word o Excel de tamaño máximo
                    2MB.</small>
            </div>

            <!-- Form Inscription File Input -->
            <div class="form-group  col-md-6">
                <label for="form_inscription">Formulario de inscripción (máx. 2MB, PDF, Word, Excel)</label>
                <div class="custom-file">
                    <input type="file" class=" form-control custom-file-input" id="form_inscription"
                        name="form_inscription" accept=".pdf,.doc,.docx,.xls,.xlsx" size="2097152" required>

                </div>
                <small class="form-text text-muted error">El archivo debe ser un PDF, Word o Excel de tamaño máximo
                    2MB.</small>
            </div>
        </div>
        <div class="row">

            <!-- Certificate Bank File Input -->
            <div class="form-group col-md-6">
                <label for="certificate_bank">Certificación bancaria (máx. 2MB, PDF, Word, Excel)</label>
                <div class="custom-file">
                    <input type="file" class="form-control custom-file-input" id="certificate_bank"
                        name="certificate_bank" accept=".pdf,.doc,.docx,.xls,.xlsx" size="2097152" required>

                </div>
                <small class="form-text text-muted error">El archivo debe ser un PDF, Word o Excel de tamaño máximo
                    2MB.</small>
            </div>

        </div>

        <div class="row mt-2 text-center">
            <div class="" id="buttonSendForm">
                <button class="btn btn-primary btn-block" type="submit">Enviar</button>
            </div>
        </div>
    </form>
</div>


<script src="../public/js/register.js"></script>
<script src="../public/js/validation/validationRegister.js"></script>