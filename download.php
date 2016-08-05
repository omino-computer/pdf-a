<?php

// check if an id is passed via GET
if (!isset($_GET['id'])) {
    die('wrong parameter');
}

// check if the id is exactly 9 chars "0-f"
$uid = (string)$_GET['id'];
if (preg_match('/^[0-9a-fA-F]{13}+$/', $uid) != 1) {
    die('wrong id');
}

// check if there's a directory with the given id inside the store
$local_dir = dirname(__FILE__) . '/store/' . $uid;
if (!is_dir($local_dir)) {
    die('invalid id');
}

// parse the dir contents
$files = array();
if ($dh = opendir($local_dir)) {
    while (($file = readdir($dh)) !== false) {
        if ($file != '.' && $file != '..')
            $files[] = $file;
    }
    closedir($dh);
} else {
    die('cannot read dir');
}

$data = null;
$filename = 'out.pdf';
// return the last file in the directory, if any
if (count($files)>0) {
    $filename = array_pop($files);
    $data = file_get_contents($local_dir.'/'.$filename);
    if (!unlink($local_dir.'/'.$filename)){
        die('cannot remove file');
    }
}

// if the directory is empty, delete the directory
if (count($files)<=0) {
    if (!rmdir($local_dir)){
        die('cannot remove dir');
    }
}

// if we were able to read the contents of the file, let's output it
if (!is_null($data)) {
    header('Content-Disposition: attachment; filename="'.$filename.'"');
    header('Content-Type: text/plain');
    header('Content-Length: ' . strlen($data));
    header('Connection: close');
    echo $data;
} else {
    die('no data');
}
