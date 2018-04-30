<?php

if (!function_exists("create_excel_output")) {

    /**
     * Crea una respuesta generando un archivo excel
     * @param string $file_name nombre del archivo (sin la extension)
     * @param array $aDatos array de datos. <br>
     * Ejemplo: [fila1[columna1,columna2],fila2[columna1], etc]
     */
    function create_excel_output($file_name, array $aDatos) {
        require_once APPPATH . 'libraries/xlsxwriter.class.php';

        header('Content-disposition: attachment; filename="' . XLSXWriter::sanitize_filename($file_name) . '.xlsx"');
        header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        header('Content-Transfer-Encoding: binary');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');

        $writer = new XLSXWriter();
        $writer->setAuthor('Hexania');
        $writer->writeSheet($aDatos, 'Informe ' . $file_name);
        $writer->writeToStdOut();
    }

}

if (!function_exists("create_excel_file")) {

    /**
     * Crea una respuesta generando un archivo excel
     * @param string $file_name nombre del archivo (sin la extension)
     * @param array $aDatos array de datos. <br>
     * Ejemplo: [fila1[columna1,columna2],fila2[columna1], etc]
     */
    function create_excel_output($file_name, array $aDatos) {
        require_once APPPATH . 'libraries/xlsxwriter.class.php';

        $writer = new XLSXWriter();
        $writer->setAuthor('Aegon Santander');
        $writer->writeSheet($aDatos, 'Informe ' . $file_name);
        $writer->writeToFile(FCPATH . 'assets/files/reports/' . $file_name . '.xlsx');
    }

}