<?
$dbhost		= "localhost";
$dbuser		= "ganggonew";
$dbpasswd	= "rkdfmdrh!@";
$dbname		= "ganggonew";

$dbconn = mysql_connect($dbhost, $dbuser, $dbpasswd) or die("DB Connection ����");

$dbstatus = mysql_select_db($dbname, $dbconn);
@mysql_query("set names euckr"); // �ѱ۹����ذ������Ͽ� �߰�

if(!$dbstatus) {
	$err_no = mysql_errno();
	$err_msg = mysql_error();
	$error_msg = "ERROR CODE ". $err_no . ":$err_msg";
	echo($error_msg);
	exit;
}
?>
