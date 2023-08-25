<?php
require '../vendor/autoload.php';

use Models\Excel\ExcelModel;
use Models\Reports\ReportsModel;

use function Helpers\dd;
use function Helpers\generateUrl;
use function Helpers\redirect;

class ReportsController
{
 
    public function ViewCreateReports(){
     include_once '../app/Views/reports/viewCreateReport.php';
    }

    public function reportsQuotes(){
        $report= new ReportsModel();
        $date_init=$_POST['cotizacion-fecha-inicio'];
        $date_end=$_POST['cotizacion-fecha-fin'];
        $dataReport=$report->generateReportQuotesWithCompanyAndRol($_SESSION['IdCompany'],$_SESSION['RolUser'],$date_init,$date_end);
        $totaldocs=count($dataReport);      
        $excel= new ExcelModel();
    //    dd($dataReport);
        // Datos para el archivo Excel
        $data = array(
            array('No. Cotizacion', 'Fecha de cotizacion', 'Cliente','Empresa', 'Subtotal','Impuestos','Total')
        );
        // vars excel
        $subtotal = 0;
        $iva = 0;
        $total = 0;

        foreach ($dataReport as $d) {
            $subtotal = number_format($d['total_subtotal'], 2, ',', '.');
            $iva = number_format($d['total_iva'], 2, ',', '.');
            $total = number_format($d['total_total'], 2, ',', '.');            
            $row = array(
                $d['quo_id'],
                $d['quo_date'],
                $d['quo_name'],
                $d['c_name'],
                $d['quo_subtotal'],
                $d['quo_iva'],
                $d['quo_total']
            );
        
            array_push($data, $row);
        }
        // dd($data);
       
        // Generar el archivo Excel
        $filename = 'Reporte_Cotizacion';
        $excel->generateExcel($data, $filename,9,8,$totaldocs,$subtotal,$iva,$total,'uploads/templatesExcel/TemplateReportsQuotes.xlsx');
        redirect(generateUrl("Reports","Reports","ViewCreateReports"));
        redirect('uploads/reports/Reporte_Cotizacion.xlsx');
    }


    public function reportsOrders()
    {
        $report = new ReportsModel();
    
        $date_init = $_POST['order-date-init'];
        $date_end = $_POST['order-date-end'];
    
        $dataReport = $report->generateReportOrdersWithCompanyAndRol($_SESSION['IdCompany'], $_SESSION['RolUser'], $date_init, $date_end);
        $totaldocs = count($dataReport);
        $excel = new ExcelModel();
    
        // Datos para el archivo Excel
        $data = array(
            array('No. Pedido', 'Fecha de pedido', 'Cliente', 'Empresa', 'Subtotal', 'Impuestos', 'Total')
        );
        // vars excel
    
        $subtotal = 0;
        $iva = 0;
        $total = 0;

    foreach ($dataReport as $d) {
        $subtotal = number_format($d['total_subtotal'], 2, ',', '.');
        $iva = number_format($d['total_iva'], 2, ',', '.');
        $total = number_format($d['total_total'], 2, ',', '.');
        $row = array(
            $d['order_id'],
            $d['order_date'],
            $d['order_name'],
            $d['c_name'],
            $d['order_subtotal'],
            $d['order_iva'],
            $d['order_total']
            );
    
            array_push($data, $row);
        }
    
        // Generar el archivo Excel
        $filename = 'Reporte_Pedido';
        $excel->generateExcel($data, $filename, 9, 8, $totaldocs, $subtotal, $iva, $total, 'uploads/templatesExcel/TemplateReportsOrders.xlsx');
            // Redirigir a la página de descarga
       
    }
    
    public function reportsStock(){
        $report = new ReportsModel();
    
        $date_init = $_POST['stock-date-init'];
        $date_end = $_POST['stock-date-end'];
    
        $dataReport = $report->generateReportStockWithCompanyAndRol($_SESSION['IdCompany'], $_SESSION['RolUser'], $date_init, $date_end);
        $totaldocs = count($dataReport);
        $excel = new ExcelModel();
    
        // Datos para el archivo Excel
        $data = array(
            array('No. Stock', 'Fecha de stock', 'Articulo', 'Bodega', 'Cantidad activa', 'Pendiente', 'Total de articulos')
        );
        // vars excel
    
        $stockArticlesActive = 0;
        $statusStock = 0;
        $totalArticles = 0;

    foreach ($dataReport as $d) {
        $subtotal = number_format($d['total_subtotal'], 2, ',', '.');
        $iva = number_format($d['total_iva'], 2, ',', '.');
        $total = number_format($d['total_total'], 2, ',', '.');
        $row = array(
            $d['order_id'],
            $d['order_date'],
            $d['order_name'],
            $d['c_name'],
            $d['order_subtotal'],
            $d['order_iva'],
            $d['order_total']
            );
    
            array_push($data, $row);
        }
    
        // Generar el archivo Excel
        $filename = 'Reporte_Pedido';
        $excel->generateExcel($data, $filename, 9, 8, $totaldocs, $subtotal, $iva, $total, 'uploads/templatesExcel/TemplateReportsOrders.xlsx');
            // Redirigir a la página de descarga
    }


}






?>