<?php
require_once('vendor/autoload.php');

if (!empty($_FILES) && isset($_FILES['files'])){
    convert($_FILES['files']);
} else {
    echo json_encode(['error'=>'No files found for upload.']);
}

function convert($file) {
    // initiate FPDI
    $pdf = new FPDI(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false, true);

    // get the page count
    $pageCount = $pdf->setSourceFile($file['tmp_name']);
    // iterate through all pages
    for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
        // import a page
        $templateId = $pdf->importPage($pageNo);
        // get the size of the imported page
        $size = $pdf->getTemplateSize($templateId);
        // create a page (landscape or portrait depending on the imported page size)
        if ($size['w'] > $size['h']) {
            $pdf->AddPage('L', array($size['w'], $size['h']));
        } else {
            $pdf->AddPage('P', array($size['w'], $size['h']));
        }

        // use the imported page
        $pdf->useTemplate($templateId);
    }

    $uid = uniqid();
    $local_dir = dirname(__FILE__) . '/store/' . $uid;
    $remote_url = 'download.php?id=' . $uid;
    if (is_dir($local_dir)) {
        echo json_encode(['error'=>'Internal storage error: directory already exists.']);
        exit;
    }
    if (!mkdir($local_dir)) {
        echo json_encode(['error'=>'Internal storage error: cannot create directory.']);
        exit;
    }

    $local_fname = $local_dir . '/' . $file['name'];
    $data = $pdf->Output($local_fname,'S');
    if (!file_put_contents($local_fname, $data)) {
        echo json_encode(['error'=>'Internal storage error: cannot create file.']);
        exit;
    }
    echo json_encode(['file_path'=>$remote_url]);
}
