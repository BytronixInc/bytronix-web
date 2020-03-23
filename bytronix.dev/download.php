<?php //файл-загрузчик
$file = $_GET['file'];
 
$file_extension = strtolower(substr(strrchr($file,"."),1));
switch ($file_extension) {
	case "pdf": $ctype="application/pdf"; break;
	case "exe": $ctype="application/octet-stream"; break;
	case "zip": $ctype="application/zip"; break;
	case "rar": $ctype="application/rar"; break;
	case "7z": $ctype="application/7z"; break;
	case "doc": $ctype="application/msword"; break;
	case "xls": $ctype="application/vnd.ms-excel"; break;
	case "ppt": $ctype="application/vnd.ms-powerpoint"; break;
	case "gif": $ctype="image/gif"; break;
	case "png": $ctype="image/png"; break;
	case "jpe": case "jpeg":
	case "jpg": $ctype="image/jpg"; break;
	default: $ctype="application/force-download";
}
// сбрасываем буфер вывода PHP, чтобы избежать переполнения памяти выделенной под скрипт если этого не сделать файл будет читаться в память полностью!
if (ob_get_level()) {
ob_end_clean();
}
header('Content-Description: File Transfer');
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false);
header("Content-Type: $ctype");
header('Content-Disposition: attachment; filename=' . basename($file));
header('Content-Transfer-Encoding: binary');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($file));
set_time_limit(0);
@readfile($file) or die("File not found.");
exit;
?>
