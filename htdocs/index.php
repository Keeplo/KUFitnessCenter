<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 <title> KU FitnessCenter - 관리페이지 </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"  />

<!--<meta http-equiv = "X-UA-Compatible" content = "IE=7">
<script src="/admin/_js/jquery-1.8.2.min.js" language="JavaScript" type="text/javascript"></script>
<link href="_css/intro.css" type="text/css" rel="stylesheet"  media="screen" />
-->

<script language="javascript">
$(document).ready(function(){
	$("#admin_id").focus();

});
function check_form(){
	if($("#admin_id").val() == ""){
		alert("아이디을 입력하세요");
		$("#admin_id").focus();
		return;
	}
	if($("#admin_pwd").val() == ""){
		alert("비밀번호를 입력하세요");
		$("#admin_pwd").focus();
		return;
	}
	$("#frm").submit();
}
</script>

</head>
<body>
	<div id="shim" ></div>
	<div id="wrapper">
		<div class="intro">
			<h1><img src="_img/intro/logo.jpg" alt="이미지"></h1>
			<form name="frm" id="frm" method="post"  action="login_proc.php" >
			<div class="adminpage">
				<p><img src="_img/intro/tit.gif" alt="Administrator page:관리자님께서는 아이디와 비밀번호를 입력해 주시기 바랍니다."></p>
				<div class="login">
					<ul>
						<li>
							<img src="_img/intro/id.gif" alt="아이디"><input type="text" name="admin_id"   id="admin_id"  value=""  tabindex="1" onkeydown="javascript:if(event.keyCode=='13')check_form();">
						</li>
						<li class="pw"><img src="_img/intro/pw.gif" alt="비밀번호"><input  type="password" name="admin_pwd" id="admin_pwd" value=""   onkeydown="javascript:if(event.keyCode=='13')check_form();"  tabindex="2"  >
						</li>
					</ul>
					<p class="btn"><a href="javascript:check_form()"><img src="_img/intro/btn_login.gif"  alt="로그인"  style="cursor:pointer"></a></p>
				</div>
			</div>
			</form>

		</div>
	</div>
</body>
</html>
