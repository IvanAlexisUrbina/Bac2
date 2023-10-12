<?php
use function Helpers\generateUrl;
if (isset($_SESSION['welcome']) && $_SESSION['welcome'] == false) {
    echo "
    <div class='container text-focus-in'>
        <div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>Bienvenido, " . $_SESSION['nameUser'] . "!</strong> Gracias por ingresar al sistema.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Cerrar'></button>
        </div>
    </div>";
    $_SESSION['welcome'] = true; // Establece la variable de sesión de "flag" en "true"
}

if ($_SESSION['StatusUser'] == '2' AND $_SESSION['RolUser'] == '2') {
    echo "
    <div class='container text-focus-in'>
        <div class='alert alert-info alert-dismissible fade show' role='alert'>
            <strong>Hola, usuario! para poder activar los modulos y terminar el registro de tu empresa<br>
            por favor rellena el formulario de registro,
            que se encuentra en el panel izquierdo o presiona <a href='".generateUrl("Company","Company","RegisterUpdateView")."'>Aquí</a></strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Cerrar'></button>
        </div>
    </div>";
}

// HERE THE SESSION VARIABLE IS PRINTED SO THAT WE CAN MODIFY THE GRAPHICS WE ARE GOING TO USE FROM THE HOME JS
echo '<script>var RolUser = ' . json_encode($_SESSION['RolUser']) . ';</script>';

// var_dump($_SESSION);
?>
<div class="container">
    <h1 class="tracking-in-expand">INFORMACIÓN GENERAL</h1>
    <div class="timeline d-flex text-center">
        <div class="circle-container mx-3">
            <a style="text-decoration:none;" href="<?= Helpers\generateUrl("Access","Access","HomeView");?>">
                <div class="circle scale-in-hor-center">
                    <i id="home" class="fa-sharp fa-solid fa-house-chimney"></i>
                </div>
            </a>
            <span><b>Inicio</b></span>
        </div>
        <?php if ($_SESSION['RolUser'] == '3'): ?>
        <div class="circle-container mx-3">
            <div class="circle scale-in-hor-center"
                data-url="<?= generateUrl("Company","Company","ViewProfilesUsers",[],"ajax");?>" id="contIconUsers">
                <i title="Perfiles de usuarios" id="users" class="fa-solid fa-users"></i>
            </div>
            <span><b>Usuarios</b></span>
        </div>
        <?php endif; ?>
        <?php if ($_SESSION['StatusUser'] == '1' AND $_SESSION['RolUser'] == '3' OR $_SESSION['RolUser'] == '4'): ?>

        <div class="circle-container mx-3">
            <div id="contIconAddress" class="circle scale-in-hor-center"
                data-url="<?= generateUrl("Company","Company","ViewAddressCompany",[],"ajax");?>">
                <i title="Direcciones de la empresa" id="address" class="fa-solid fa-address-book"></i>
            </div>
            <span><b>Direcciones</b></span>
        </div>
        <?php endif; ?>

    </div>

    <!-- ... Código HTML anterior ... -->
<div class="col-md-12 card p-4">
    <div class="col-md-6 ">
        <canvas id="incomeChart" width="400" height="200"></canvas>
    </div>
    <div class="col-md-6">
        <!-- Elemento HTML para el gráfico -->
        <canvas id="salesProgress" width="150" height="150"></canvas>

    </div>
</div>

</div>


<!--/ Expense Overview -->
</div>



<script>
// Datos de ventas (puedes personalizar estos valores)
var ventasMensuales = 7500; // Cambia este valor según tus datos reales
var objetivoMensual = 12000; // Cambia este valor según tu objetivo mensual

// Calcula el progreso en porcentaje
var porcentajeMensual = (ventasMensuales / objetivoMensual) * 100;

// Configura los datos del gráfico de barras
var data = {
    labels: ["Progreso"],
    datasets: [{
        data: [porcentajeMensual],
        backgroundColor: ["#1abc9c"], // Color de la barra de progreso
        borderWidth: 0,
    }, ],
};

// Configura las opciones del gráfico
var options = {
    responsive: false,
    cutout: '75%', // Controla el tamaño del agujero central para crear un efecto circular
    plugins: {
        legend: {
            display: false, // Oculta la leyenda
        },
        tooltip: {
            enabled: false, // Desactiva la información sobre herramientas (tooltip)
        },
    },
};

// Crea el gráfico de barras
var ctx = document.getElementById("salesProgress").getContext("2d");
var myChart = new Chart(ctx, {
    type: "doughnut", // Usa un tipo de gráfico de "doughnut" para crear un efecto circular
    data: data,
    options: options,
});
</script>
<!-- ... Código HTML posterior ... -->

<script>
// Espera a que se cargue el DOM antes de ejecutar el código de Chart.js
document.addEventListener("DOMContentLoaded", function() {
    // Obtén una referencia al elemento canvas
    var incomeChartCanvas = document.getElementById('incomeChart').getContext('2d');

    // Define los datos para el gráfico
    var data = {
        labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo'],
        datasets: [{
            label: 'Ingresos',
            data: [1000, 1200, 800, 1500, 2000],
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        }]
    };

    // Configura las opciones del gráfico
    var options = {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    };

    // Crea el gráfico usando Chart.js
    var incomeChart = new Chart(incomeChartCanvas, {
        type: 'bar',
        data: data,
        options: options
    });
});
</script>