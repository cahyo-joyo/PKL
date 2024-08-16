<?php
namespace App\Controllers;

class DBimport extends BaseController
{
public function index()
{
  $dataa = [
    'title' => 'Tabel | Magang',
  ];
  return view('/import', $dataa);
}
public function coba()
{
$host = "localhost";
$uname = "root";
$pass = "";
$database = "import_sql"; //Change Your Database Name
$conn = mysqli_connect($host, $uname, $pass, $database);
$filename = 'database/WebKosong_INCL_PPN.sql'; //How to Create SQL File Step : url:http://localhost/phpmyadmin->database select->table select->Export(In Upper Toolbar)->Go:DOWNLOAD .SQL FILE
$op_data = '';
$lines = file($filename);
foreach ($lines as $line) {
    if (substr($line, 0, 2) == '--' || $line == '') //This IF Remove Comment Inside SQL FILE
    {
        continue;
    }
    $op_data .= $line;
    if (substr(trim($line), -1, 1) == ';') //Breack Line Upto ';' NEW QUERY
    {
        $conn->query($op_data);
        $op_data = '';
    }
}
return redirect()->to('/import');
}
}
