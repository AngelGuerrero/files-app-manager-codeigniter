<?php

namespace App\Controllers;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpWord\PhpWord;
use TCPDF;

class DocumentsController extends BaseController
{

  public function index()
  {
    // Listar todos los documentos de tipo word, excel y pdf
    $user_id = session()->get('user_id');

    $directory_path = ROOTPATH . 'public/uploads' . '/' . $user_id . '/';
    if (!file_exists($directory_path)) {
      mkdir($directory_path, 0777, true);
    }
    $documents = [];
    $directory = new \DirectoryIterator($directory_path);

    foreach ($directory as $file) {
      if ($file->isFile() && $this->isDocument($file->getExtension())) {
        $documents[] = $file->getFilename();
      }
    }

    // Pasar la lista de documentos a la vista
    $data['documents'] = $documents;
    $data['route'] = 'documents/document_list';

    return view('panel\panel', $data);
  }

  public function generateDocuments()
  {
    // Obtener los datos de post
    $name = $this->request->getPost('name');
    $age = $this->request->getPost('age');
    $city = $this->request->getPost('city');

    // Obtiene el id del usuario para guardarlo en su carpeta
    $user_id = session()->get('user_id');

    // Generar el documento de word
    $this->generateWordDocument($name, $age, $city, $user_id);
    $this->generateExcelDocument($name, $age, $city, $user_id);
    $this->generatePdfDocument($name, $age, $city, $user_id);

    return redirect()->to('/documents')->with('message', 'Documentos creados correctamente');
  }

  public function deleteDocument()
  {
    // Obtén el nombre del documento a eliminar (por ejemplo, desde una solicitud POST)
    $document_name = $this->request->getPost('document');

    // Ruta completa del archivo de documento a eliminar
    $document_path = ROOTPATH . 'public/uploads/' . $document_name;

    // Eliminar el documento
    unlink($document_path);

    return redirect()->to('/documents')->with('message', 'Documento eliminado correctamente');
  }

  private function generateWordDocument($name, $age, $city, $user_id)
  {
    // Cargar el archivo de autoloading de Composer
    require_once APPPATH . '../vendor/autoload.php';

    // Crear una instancia de PHPWord
    $phpWord = new PhpWord();

    // Crear una sección en el documento
    $section = $phpWord->addSection();

    // Agregar los campos al documento
    $section->addText("Nombre: $name");
    $section->addText("Edad: $age");
    $section->addText("Ciudad: $city");

    // Guardar el documento en el servidor
    $file_path = ROOTPATH . 'public/uploads/' . $user_id;
    if (!file_exists($file_path)) {
      mkdir($file_path, 0777, true);
    }
    $random = rand(0, 1000);
    $file_path .= '/' . $random . '_documento.docx';

    $result = $phpWord->save($file_path, 'Word2007');
  }

  private function generateExcelDocument($name, $age, $city, $user_id)
  {
    // Crear una instancia de Spreadsheet
    $spreadsheet = new Spreadsheet();

    // Obtener la hoja de cálculo activa
    $sheet = $spreadsheet->getActiveSheet();

    // Agregar datos al documento
    $sheet->setCellValue('A1', 'Nombre');
    $sheet->setCellValue('B1', 'Edad');
    $sheet->setCellValue('C1', 'Ciudad');

    $sheet->setCellValue('A2', $name);
    $sheet->setCellValue('B2', $age);
    $sheet->setCellValue('C2', $city);

    // Descargar el documento en el navegador
    $writer = new Xlsx($spreadsheet);
    $file_path = ROOTPATH . 'public/uploads/' . $user_id;
    if (!file_exists($file_path)) {
      mkdir($file_path, 0777, true);
    }
    $random = rand(0, 1000);
    $file_path .= '/' . $random . '_documento.xlsx';
    $writer->save($file_path);
  }

  private function generatePdfDocument($name, $age, $city, $user_id)
  {
    // Crear una instancia de TCPDF
    $pdf = new TCPDF();

    // Configurar el documento PDF
    $pdf->SetCreator('Nombre del Creador');
    $pdf->SetAuthor('Autor del PDF');
    $pdf->SetTitle('Título del PDF');
    $pdf->SetSubject('Asunto del PDF');
    $pdf->SetKeywords('Palabras clave, separadas, por, coma');

    // Agregar contenido al PDF
    $pdf->AddPage();
    $pdf->SetFont('helvetica', '', 12);
    $pdf->Cell(0, 10, 'Contenido del PDF', 0, 1);
    $pdf->Write(5, "Nombre: $name", '', 0, 'L', true);
    $pdf->Write(5, "Edad: $age", '', 0, 'L', true);
    $pdf->Write(5, "Ciudad: $city", '', 0, 'L', true);

    // Guardar el PDF en el servidor
    $random = rand(0, 1000);
    $file_path = ROOTPATH . 'public/uploads/' . $user_id;
    if (!file_exists($file_path)) {
      mkdir($file_path, 0777, true);
    }
    $file_path .= '/' . $random . '_documento.pdf';
    $pdf->Output($file_path, 'F');
  }

  private function isDocument($extension)
  {
    $documents = ['docx', 'xlsx', 'pdf'];

    return in_array($extension, $documents);
  }
}