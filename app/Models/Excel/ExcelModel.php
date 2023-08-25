<?php

namespace Models\Excel;

require '../vendor/autoload.php';

use Models\MasterModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;

class ExcelModel extends MasterModel
{
    private $spreadsheet;

    public function __construct()
    {
        $this->spreadsheet = new Spreadsheet();
    }
    public function generateExcel(array $data, string $filename, int $startRow, int $startColumn, int $totalDocs, $subtotal, $iva, $total, ?string $templatePath = null)
    {
        if ($templatePath) {
            // Cargar la plantilla existente
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($templatePath);
        } else {
            // Crear una nueva instancia de Spreadsheet
            $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        }

        // Obtener la hoja de cálculo activa
        $sheet = $spreadsheet->getActiveSheet();
        $endRow = $startRow + count($data) - 1;
        $endColumn = $startColumn + count($data[0]) - 1;

        // Ajustar ancho de las columnas al contenido
        foreach ($sheet->getColumnIterator() as $column) {
            $sheet->getColumnDimension($column->getColumnIndex())->setAutoSize(true);
        }

        // Establecer bordes para el rango de datos
        $range = $sheet->getCellByColumnAndRow($startColumn, $startRow)
            ->getCoordinate() . ':' .
            $sheet->getCellByColumnAndRow($endColumn, $endRow)
            ->getCoordinate();
        $styleArray = [
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'outline' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ];

        $sheet->getStyle($range)->applyFromArray($styleArray);

        // Set data
        $row = $startRow;
        foreach ($data as $item) {
            $column = $startColumn;
            foreach ($item as $value) {
                $sheet->setCellValueByColumnAndRow($column, $row, $value);
                $column++;
            }
            $row++;
        }

        $sheet->setCellValueByColumnAndRow(8, 7, 'Fecha del documento:');
        date_default_timezone_set('America/Bogota');
        $sheet->setCellValueByColumnAndRow(8, 8, date('Y-m-d H:i:s'));

        $sheet->setCellValueByColumnAndRow(9, 7, 'Total cotizaciones:');
        $sheet->setCellValueByColumnAndRow(9, 8, $totalDocs);

        $sheet->setCellValueByColumnAndRow(12, 7, 'Subtotal:');
        $sheet->setCellValueByColumnAndRow(12, 8, $subtotal);

        $sheet->setCellValueByColumnAndRow(13, 7, 'Impuestos:');
        $sheet->setCellValueByColumnAndRow(13, 8, $iva);

        $sheet->setCellValueByColumnAndRow(14, 7, 'Total:');
        $sheet->setCellValueByColumnAndRow(14, 8, $total);

        // styles
        $boldFontStyle = [
            'font' => [
                'bold' => true,
            ],
        ];

        $sheet->getStyleByColumnAndRow(8, 7)->applyFromArray($styleArray)->applyFromArray($boldFontStyle);
        $sheet->getStyleByColumnAndRow(8, 8)->applyFromArray($styleArray)->applyFromArray($boldFontStyle);
        $sheet->getStyleByColumnAndRow(9, 7)->applyFromArray($styleArray)->applyFromArray($boldFontStyle);
        $sheet->getStyleByColumnAndRow(9, 8)->applyFromArray($styleArray)->applyFromArray($boldFontStyle);

        $sheet->getStyleByColumnAndRow(12, 7)->applyFromArray($styleArray)->applyFromArray($boldFontStyle);
        $sheet->getStyleByColumnAndRow(12, 8)->applyFromArray($styleArray)->applyFromArray($boldFontStyle);
        $sheet->getStyleByColumnAndRow(13, 7)->applyFromArray($styleArray)->applyFromArray($boldFontStyle);
        $sheet->getStyleByColumnAndRow(13, 8)->applyFromArray($styleArray)->applyFromArray($boldFontStyle);
        $sheet->getStyleByColumnAndRow(14, 7)->applyFromArray($styleArray)->applyFromArray($boldFontStyle);
        $sheet->getStyleByColumnAndRow(14, 8)->applyFromArray($styleArray)->applyFromArray($boldFontStyle);

        // Guardar el archivo Excel
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $folder_path = 'uploads/reports/';
        if (!file_exists($folder_path)) {
            mkdir($folder_path, 0755, true);
        }
        $file = $folder_path . $filename . '.xlsx';
        $writer->save($file);
        return $file;
    }
    
    
}


?>