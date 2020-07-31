<?
$dbhost		= "localhost";
$dbuser		= "ganggonew";
$dbpasswd	= "rkdfmdrh!@";
$dbname		= "ganggonew";

$dbconn = mysql_connect($dbhost, $dbuser, $dbpasswd) or die("DB Connection 실패");

$dbstatus = mysql_select_db($dbname, $dbconn);
@mysql_query("set names euckr"); // 한글문제해결을위하여 추가

if(!$dbstatus) {
	$err_no = mysql_errno();
	$err_msg = mysql_error();
	$error_msg = "ERROR CODE ". $err_no . ":$err_msg";
	echo($error_msg);
	exit;
}
?>
