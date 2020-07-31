<? session_start();
ini_set("session.cookie_lifetime",3600);
ini_set("session.cache_expire",3600);
ini_set("session.gc_maxlifetime",3600);
### 디버그 함수
function wd($data)
{
	if($_SERVER['REMOTE_ADDR'] == "220.71.10.208"){
		print "<xmp style=\"display:block;font:9pt 'Bitstream Vera Sans Mono, Courier New';background:#202020;color:#D2FFD2;padding:10px;margin:5px;\">";
		print_r($data);
		print "</xmp>";
	}
}

### 디버그 함수
function wdx($data)
{
	if($_SERVER['REMOTE_ADDR'] == "220.71.10.208"){
		print "<xmp style=\"display:block;font:9pt 'Bitstream Vera Sans Mono, Courier New';background:#202020;color:#D2FFD2;padding:10px;margin:5px;\">";
		print_r($data);
		print "</xmp>";
	}
	echo exit;
}

function rw( $str ) {
	if($_SERVER["REMOTE_ADDR"] == "220.71.10.208" ) {
		echo $str."</br>";
	}
}

function rwe( $str ) {
	if($_SERVER["REMOTE_ADDR"] == "220.71.10.208" ) {
		echo $str."</br>";
		exit;
	}
}



function  Req($data){
 if($data!=""){
		$data = str_replace("<","&lt;",$data);
		$data = str_replace(">","&gt;",$data);
		$data = str_replace("\"","&quot;",$data);
		$data = str_replace("'","&#39;",$data);
		$data = str_replace("--","",$data);
		$data = str_replace("..","",$data);
	}
	return trim($data);
}


function all_group_admin(){
	$write_YN="";

	$cnt = "select count(*) as cnt from circle where c_code like '%class%'";
	$cnt = mysql_query($cnt);
	$cnt	 = mysql_fetch_array($cnt);
	if($cnt[0]){
		$all_admin_chk = "select * from circle where c_code like '%class%'";
		$result_chk = mysql_query($all_admin_chk);

		while($row_admin	 = mysql_fetch_array($result_chk)){
			$c_admin_list[] = $row_admin["c_admin"];		//관리자
			$c_affairs_list[] = $row_admin["c_affairs"];		// 총무
		}

		$c_admin_implo =  implode(",", $c_admin_list);
		$pos = strpos($c_admin_implo, $_SESSION["m_id"]);


		$c_affairs_implo =  implode(",", $c_affairs_list);
		$pos2 = strpos($c_affairs_implo, $_SESSION["m_id"]);


		if ($pos === false){
			//관리자 아님
			if ($pos2 === false){
				//총무도 아님
				$write_YN ="N";
			}else{	//총무
				 $write_YN ="Y";
			}
		}
		else{
			//관리자
			$write_YN ="Y";
		}

		return $write_YN;
	}
}


function all_group_admin_New(){
	$write_YN="";
	$cnt = "select count(*) as cnt from circle_members where c_code like '%class%' and (cm_level ='1' or cm_level ='2' or  cm_level ='3' or  cm_level ='4' )";
	$cnt = mysql_query($cnt);
	$cnt	 = mysql_fetch_array($cnt);
	if($cnt[0]){
		$all_admin_chk = "select * from circle_members where c_code like '%class%' and (cm_level ='1' or cm_level ='2' or  cm_level ='3' or  cm_level ='4' )";
		$result_chk = mysql_query($all_admin_chk);

		while($row_admin	 = mysql_fetch_array($result_chk)){
			$all_admin_id[] = $row_admin["m_id"];		//아이디 나열
		}

		$c_admin_implo =  implode(",", $all_admin_id);
		$pos = strpos($c_admin_implo, $_SESSION["m_id"]);


		if ($pos === false){
			//관리자 아님
		}
		else{
			//관리자
			$write_YN ="Y";
		}
		return $write_YN;
	}
}





function group_memeber($code){
	$write ="";
	$cnt = "SELECT count(*) as cnt FROM circle_members where c_code = '".$code."' ";
	$cnt = mysql_query($cnt);
	$cnt	 = mysql_fetch_array($cnt);
	if($cnt[0]){
		$sql_member = "SELECT * FROM circle_members where c_code = '".$code."' ";
		$result_amember = mysql_query($sql_member);
		while($group_memeber	 = mysql_fetch_array($result_amember)){
			$member_id[] = $group_memeber["m_id"];
		}

		$member_id_implo =  implode(",", $member_id);
		$pos = strpos($member_id_implo, $_SESSION["m_id"]);

		if ($pos === false){
			//회원아님
		   $write ="N";
		}else{
			//화원
		 $write ="Y";
		}
		return $write;

	}else{
		return "N";
	}
}


function group_memeber_check($code){
	$check_query = "SELECT count(*) as cnt FROM circle_members where m_id  = '".$_SESSION["m_id"]."' and c_code  = '".$code."'  and (cm_level=1 or cm_level=2 )";
	$check_result = mysql_query($check_query);
	$check_cnt	 = mysql_fetch_array($check_result);
	if($check_cnt[0] == 0){
		echo "<script>alert('기수장 및 총무만 이용가능합니다..');window.close();</script>";
		exit;
	}
}



function group_memeber_check_popup($code){
	$check_query = "SELECT count(*) as cnt FROM circle_members where m_id  = '".$_SESSION["m_id"]."' and c_code  = '".$code."'  and (cm_level=1 or cm_level=2 )";
	$check_result = mysql_query($check_query);
	$check_cnt	 = mysql_fetch_array($check_result);
	if($check_cnt[0] == 0){
		echo "<script>alert('기수장 및 총무만 이용가능합니다..');window.close();</script>";
		exit;
	}
}

function group_admin($code){
	$admin_YN ="";
	$cnt = "SELECT count(*)  FROM circle_members where c_code = '".$code."' and (cm_level='1' or cm_level='2' or cm_level='3' or cm_level='4' )";
	$cnt  = mysql_query($cnt);
	$cnt 	 = mysql_fetch_array($cnt);
	if($cnt[0]){
		$sql_admin = "SELECT * FROM circle_members where c_code = '".$code."' and (cm_level='1' or cm_level='2' or cm_level='3' or cm_level='4' )";

		$result_admin  = mysql_query($sql_admin);
		while($group_admin 	 = mysql_fetch_array($result_admin )){
			$group_admin_arr[] = $group_admin["m_id"];
		}

		$group_admin_implo =  implode(",", $group_admin_arr);
		$pos = strpos($group_admin_implo, $_SESSION["m_id"]);

		if ($pos=== false){
			//관리자 아님
		   $admin_YN ="N";
		}else{
			//관리자
		 $admin_YN ="Y";
		}
		return $admin_YN;

	}
	 $admin_YN ="N";
	 return $admin_YN;
}



//==========관리자 페이지 로그인 권한 검사 ==============//
function group_admin_mode($code){
	//echo $_SESSION["admin_id"]; exit;
	$admin_YN ="";
	$cnt = "SELECT count(*)  FROM circle_members where c_code = '".$code."' and (cm_level='1' or cm_level='2' or cm_level='3' or cm_level='4' )";
	$cnt  = mysql_query($cnt);
	$cnt 	 = mysql_fetch_array($cnt);
	if($cnt[0]){
		$sql_admin = "SELECT * FROM circle_members where c_code = '".$code."' and (cm_level='1' or cm_level='2' or cm_level='3' or cm_level='4' )";

		$result_admin  = mysql_query($sql_admin);
		while($group_admin 	 = mysql_fetch_array($result_admin )){
			$group_admin_arr[] = $group_admin["m_id"];
		}

		$group_admin_implo =  implode(",", $group_admin_arr);
		//echo $group_admin_implo; exit;
		$pos = strpos($group_admin_implo, $_SESSION["admin_id"]);

		if ($pos=== false){
			//관리자 아님
		   $admin_YN ="N";
		}else{
			//관리자
		 $admin_YN ="Y";
		}

		return $admin_YN;

	}
	 $admin_YN ="N";
	 return $admin_YN;
}




function notice_paging($link, $total, $page, $size) {
	if($total == 0) return;

	$total_page = ceil($total / $size);
	$temp = $page % 10;

	if($temp == 0) {
		$a = 10 - 1;
		$b = $temp;
	}
	else {
		$a = $temp - 1;
		$b = 10 - $temp;
	}

	$start = $page - $a;
	$end = $page + $b;

	//처음페이지
	if($page > 10) {
		echo "<a href='$link&page=1' class='none'><img src='/_img/bbs/prev02.gif'class='num01' align='absmiddle'></a>&nbsp;";
	}

	//이전페이지
	if($page > 10) {
		$back_page = $start - 1;
		echo "<a href='$link&page=$back_page' class='none'><img src='/_img/bbs/prev01.gif' class='num01 pr5' align='absmiddle'></a>&nbsp;";
	}

	//페이지 출력
	for($i = $start; $i <= $end; $i++) {
		if($i > $total_page) break;

		if($page == $i) echo "<strong>$i</strong>&nbsp;";
		else echo "<a href='$link&page=$i'>$i</a>&nbsp;";
	}

	//다음페이지
	if($end < $total_page) {
		$next_page = $end + 1;
		echo "<a href='$link&page=$next_page' class='none'><img src='/_img/bbs/next01.gif' class='num01 pr5' align='absmiddle'></a>&nbsp;";
	}

	//마지막 페이지
	if($end < $total_page) {
		echo "<a href='$link&page=$total_page' class='none'><img src='/_img/bbs/next02.gif'class='num01' align='absmiddle'></a>";
	}
}


function page_member($link, $total, $page_member, $size) {
	if($total == 0) return;

	$total_page = ceil($total / $size);
	$temp = $page_member % 10;

	if($temp == 0) {
		$a = 10 - 1;
		$b = $temp;
	}
	else {
		$a = $temp - 1;
		$b = 10 - $temp;
	}

	$start = $page_member - $a;
	$end = $page_member + $b;

	//처음페이지
	if($page_member > 10) {
		echo "<a href='$link&page_member=1' class='none'><img src='/_img/bbs/prev02.gif'class='num01' align='absmiddle'></a>&nbsp;";
	}

	//이전페이지
	if($page_member > 10) {
		$back_page = $start - 1;
		echo "<a href='$link&page_member=$back_page' class='none'><img src='/_img/bbs/prev01.gif' class='num01 pr5' align='absmiddle'></a>&nbsp;";
	}

	//페이지 출력
	for($i = $start; $i <= $end; $i++) {
		if($i > $total_page) break;

		if($page_member == $i) echo "<strong>$i</strong>&nbsp;";
		else echo "<a href='$link&page_member=$i'>$i</a>&nbsp;";
	}

	//다음페이지
	if($end < $total_page) {
		$next_page = $end + 1;
		echo "<a href='$link&page_member=$next_page' class='none'><img src='/_img/bbs/next01.gif' class='num01 pr5' align='absmiddle'></a>&nbsp;";
	}

	//마지막 페이지
	if($end < $total_page) {
		echo "<a href='$link&page_member=$total_page' class='none'><img src='/_img/bbs/next02.gif'class='num01' align='absmiddle'></a>";
	}
}


function data_paging($link, $total, $page, $size) {
	if($total == 0) return;

	$total_page = ceil($total / $size);
	$temp = $page % 10;

	if($temp == 0) {
		$a = 10 - 1;
		$b = $temp;
	}
	else {
		$a = $temp - 1;
		$b = 10 - $temp;
	}

	$start = $page - $a;
	$end = $page + $b;

	//처음페이지
	if($page > 10) {
		echo "<a href='$link&page=1'><img src='/_img/bbs/prev02.gif' align='absmiddle'alt='맨앞페이지로가기'></a>&nbsp;";
	}

	//이전페이지
	if($page > 10) {
		$back_page = $start - 1;
		echo "<a href='$link&page=$back_page'><img src='/_img/bbs/prev01.gif' align='absmiddle'alt='앞페이지로가기'></a>&nbsp;";
	}

	//페이지 출력
	for($i = $start; $i <= $end; $i++) {
		if($i > $total_page) break;

		if($page == $i) echo "<strong>$i</strong>&nbsp;";
		else echo "<a href='$link&page=$i'>$i</a>&nbsp;";
	}
	//다음페이지
	if($end < $total_page) {
		$next_page = $end + 1;
		echo "<a href='$link&page=$next_page'><img src='/_img/bbs/next01.gif' align='absmiddle' alt='뒤페이지로가기'></a>&nbsp;";
	}

	//마지막 페이지
	if($end < $total_page) {
		echo "<a href='$link&page=$total_page'><img src='/_img/bbs/next02.gif' align='absmiddle'alt='맨뒤페이지로가기'></a>";
	}
}


function board_paging($link, $total, $page, $size) {
	if($total == 0) return;

	$total_page = ceil($total / $size);
	$temp = $page % 10;

	if($temp == 0) {
		$a = 10 - 1;
		$b = $temp;
	}
	else {
		$a = $temp - 1;
		$b = 10 - $temp;
	}

	$start = $page - $a;
	$end = $page + $b;

	//처음페이지
	//if($page > 10) {
		echo "<a href='$link&page=1' class='none'><img src='../_img/bbs/prev2.gif'class='num01' align='absmiddle'></a>&nbsp;";
	//}

	//이전페이지
	//if($page > 10) {
		$back_page = $start - 1;
		echo "<a href='$link&page=$back_page' class='none'><img src='../_img/bbs/prev.gif' class='num01 pr5' align='absmiddle'></a>&nbsp;";
	//}

	//페이지 출력
	for($i = $start; $i <= $end; $i++) {
		if($i > $total_page) break;

		if($page == $i) echo "<strong>$i</strong>&nbsp;";
		else echo "<a href='$link&page=$i'>$i</a>&nbsp;";
	}

	//다음페이지
	//if($end < $total_page) {
		$next_page = $end + 1;
		echo "<a href='$link&page=$next_page' class='none'><img src='../_img/bbs/next.gif' class='num01 pr5' align='absmiddle'></a>&nbsp;";
	//}

	//마지막 페이지
	//if($end < $total_page) {
		echo "<a href='$link&page=$total_page' class='none'><img src='../_img/bbs/next2.gif'class='num01' align='absmiddle'></a>";
	//}
}


function paging($link, $total, $page, $size) {
	if($total == 0) return;

	$total_page = ceil($total / $size);
	$temp = $page % 10;

	if($temp == 0) {
		$a = 10 - 1;
		$b = $temp;
	}
	else {
		$a = $temp - 1;
		$b = 10 - $temp;
	}

	$start = $page - $a;
	$end = $page + $b;

	//처음페이지
	if($page > 10) {
		echo "<a href='$link&page=1'><img src='/admin/_img/bbs/prev2.gif' align='absmiddle'></a>&nbsp;";
	}

	//이전페이지
	if($page > 10) {
		$back_page = $start - 1;
		echo "<a href='$link&page=$back_page'><img src='/admin/_img/bbs/prev.gif' align='absmiddle'></a>&nbsp;";
	}

	//페이지 출력
	for($i = $start; $i <= $end; $i++) {
		if($i > $total_page) break;

		if($page == $i) echo "<strong>$i</strong>&nbsp;";
		else echo "<a href='$link&page=$i'>$i</a>&nbsp;";
	}

	//다음페이지
	if($end < $total_page) {
		$next_page = $end + 1;
		echo "<a href='$link&page=$next_page'><img src='/admin/_img/bbs/next.gif' align='absmiddle'></a>&nbsp;";
	}

	//마지막 페이지
	if($end < $total_page) {
		echo "<a href='$link&page=$total_page'><img src='/admin/_img/bbs/next2.gif' align='absmiddle'></a>";
	}
}

function com_paging($link, $total, $compage, $size) {
	if($total == 0) return;

	$total_page = ceil($total / $size);
	$temp = $compage % 10;

	if($temp == 0) {
		$a = 10 - 1;
		$b = $temp;
	}
	else {
		$a = $temp - 1;
		$b = 10 - $temp;
	}

	$start = $compage - $a;
	$end = $compage + $b;

	//처음페이지
	if($compage > 10) {
		echo "<a href='$link&com_page=1'><img src='/admin/_img/bbs/prev2.gif' align='absmiddle'></a>&nbsp;";
	}

	//이전페이지
	if($compage > 10) {
		$back_page = $start - 1;
		echo "<a href='$link&com_page=$back_page'><img src='/admin/_img/bbs/prev.gif' align='absmiddle'></a>&nbsp;";
	}

	//페이지 출력
	for($i = $start; $i <= $end; $i++) {
		if($i > $total_page) break;

		if($compage == $i) echo "<strong>$i</strong>&nbsp;";
		else echo "<a href='$link&com_page=$i'>$i</a>&nbsp;";
	}

	//다음페이지
	if($end < $total_page) {
		$next_page = $end + 1;
		echo "<a href='$link&com_page=$next_page'><img src='/admin/_img/bbs/next.gif' align='absmiddle'></a>&nbsp;";
	}

	//마지막 페이지
	if($end < $total_page) {
		echo "<a href='$link&com_page=$total_page'><img src='/admin/_img/bbs/next2.gif' align='absmiddle'></a>";
	}
}



function user_paging($link, $total, $page, $size) {
	if($total == 0) return;

	$total_page = ceil($total / $size);
	$temp = $page % 10;

	if($temp == 0) {
		$a = 10 - 1;
		$b = $temp;
	}
	else {
		$a = $temp - 1;
		$b = 10 - $temp;
	}

	$start = $page - $a;
	$end = $page + $b;

	//처음페이지
	if($page > 10) {
		//echo "<a href='$link&page=1'><img src='/_img/bbs/left02.gif' class='num01'></a>";
	}

	//이전페이지

	if($page > 10) {
		$back_page = $start - 1;
		//echo "<a href='$link&page=$back_page'><img src='/_img/bbs/left01.gif' class='num01 pr5'></a>";
		echo "<a href='$link&page=$i'  class='prev'><img src='../_img/bbs/btn_pagenate_lft.gif' width='11' height='11' alt='이전'></a>";
	}

	//페이지 출력
	for($i = $start; $i <= $end; $i++) {
		if($i > $total_page) break;

		//if ($i != 1){
			//echo " <img src='/_img/bbs/dot02.gif'class='m' /> ";
	//	}

		if($page == $i) echo "<strong>$i</strong>";
		else echo "<a href='$link&page=$i?use_yn=$use_yn'>$i</a>";
	}


	//다음페이지
	if($end < $total_page) {
		$next_page = $end + 1;
		//echo " <a href='$link&page=$next_page'><img src='/_img/bbs/right01a.gif' class='num01 pl5'></a>";
		echo "<a href='$link&page=$i' class='prev'><img src='../_img/bbs/btn_pagenate_rgt.gif' width='11' height='11' alt='다음'></a>";
	}

	//마지막 페이지
	if($end < $total_page) {
		//echo " <a href='$link&page=$total_page'><img src='/_img/bbs/right02a.gif' class='num01'></a>";
	}
}

function user_paging2($link, $total, $page, $size) {
	if($total == 0) return;

	$total_page = ceil($total / $size);
	$temp = $page % 10;

	if($temp == 0) {
		$a = 10 - 1;
		$b = $temp;
	}
	else {
		$a = $temp - 1;
		$b = 10 - $temp;
	}

	$start = $page - $a;
	$end = $page + $b;

	//처음페이지

	if($page > 10) {
		echo "<a href='$link&page=1'><img src='/_img/bbs/num_left.gif' ></a>;";
	}


	//이전페이지
	/*if($page > 10) {
		$back_page = $start - 1;
		echo "<a href='$link&page=$back_page' onFocus='this.blur();'><img src='/_img/btn/btn_pmove_p.gif' alt='이전페이지' title='이전페이지' ></a>";
	}
*/
	//페이지 출력
	for($i = $start; $i <= $end; $i++) {
		if($i > $total_page) break;

		if ($i != 1)
			echo "|";

		if($page == $i) echo "<b>&nbsp;$i&nbsp;</b>";
		else echo "<a href='$link&page=$i' >&nbsp;$i&nbsp;</a>";
	}


	//다음페이지
	/*if($end < $total_page) {
		$next_page = $end + 1;
		echo "<a href='$link&page=$next_page' onFocus='this.blur();'><img src='/_img/btn/btn_pmove_n.gif' alt='다음페이지' title='다음페이지' ></a>";
	}
*/
	//마지막 페이지

	if($end < $total_page) {
		echo "<a href='$link&page=$total_page'><img src='/_img/bbs/num_right.gif' align='absmiddle'></a>";
	}

}

//심사위원 로그인체크
function exam_login_check() {
	if($_SERVER[QUERY_STRING]) $login_rtn_page = urlencode($_SERVER[PHP_SELF] . "?" . $_SERVER[QUERY_STRING]);
	else $login_rtn_page = urlencode($_SERVER[PHP_SELF]);

	if(!$_SESSION[ss_examiner_id] || !$_SESSION[ss_examiner_name] ) {
		echo "<script>location.href='/jury/index.html?rtn_page=" . $login_rtn_page . "';</script>";
		exit;
	}
}
//login_check_member 일반 회원 로그인 체크
function login_check_member() {
	if($_SERVER[QUERY_STRING]) $login_rtn_page = urlencode($_SERVER[PHP_SELF] . "?" . $_SERVER[QUERY_STRING]);
	else $login_rtn_page = urlencode($_SERVER[PHP_SELF]);

	if(!$_SESSION["m_id"] || !$_SESSION["m_kname"]) {
		echo "<script>alert('로그인 후 이용하실 수 있습니다.');location.replace('../member/login.php');</script>";
		exit;
	}
}

function login_check() {
	if($_SERVER[QUERY_STRING]) $login_rtn_page = urlencode($_SERVER[PHP_SELF] . "?" . $_SERVER[QUERY_STRING]);
	else $login_rtn_page = urlencode($_SERVER[PHP_SELF]);

	if(!$_SESSION[ss_mem_id] || !$_SESSION[ss_mem_name]) {
		echo "<script>alert('로그인 후 이용하실 수 있습니다.');location.replace('/member/login.php?login_rtn_page=" . $login_rtn_page . "');</script>";
		exit;
	}
}

function login_check_pop() {
	if(!$_SESSION[sid] || !$_SESSION[sname]) {
		echo "<script>alert('로그인 후 이용하실 수 있습니다.');window.close();</script>";
		exit;
	}
}

//2009-06-02 로그아웃 체크
function logout_check(){
	if($_SESSION[sid]){
		echo "<script>location.href='/';</script>";
		exit;
	}
}
//2009-06-02 로그아웃 체크
function logout_check_pop(){
	if($_SESSION[sid]){
		echo "<script>window.close();</script>";
		exit;
	}
}

function login_check_move() {
	if(!$_SESSION[ss_mem_id] || !$_SESSION[ss_mem_name]) {
		echo "<script>location.replace('/member/login.php?referPage='+encodeURIComponent(document.URL));</script>";
		exit;
	}
}
//비회원으로 구매 가능할 시 체크
function login_check_move_1() {
	if(!$_SESSION[ss_mem_id] && !$_SESSION[ss_mem_name] && !$_SESSION[guest_name]) {
		echo "<script>alert('로그인을 하셔야 진행이됩니다.');location.replace('/member/login.php?mode=noid&referPage='+encodeURIComponent(document.URL));</script>";
		exit;
	}
}

//2009-06-15 단원체크
function dan_check(){
	if($_SESSION[slevel] <= 1){
		echo "<script>alert('단원만 이용가능합니다.');history.go(-1);</script>";
		exit;
	}
}


function admin_login_check() {
	if($_SERVER[QUERY_STRING]) $login_rtn_page = urlencode($_SERVER[PHP_SELF] . "?" . $_SERVER[QUERY_STRING]);
	else $login_rtn_page = urlencode($_SERVER[PHP_SELF]);

	if(!$_SESSION[a_m_id] || !$_SESSION[a_m_kname] ) {
		echo "<script>location.href='/admin/index.php?rtn_page=" . $login_rtn_page . "';</script>";
		exit;
	}
}



function admin_login_check_pop() {
	if(!$_SESSION[m_id] || !$_SESSION[m_kname]) {
		echo "<script>alert('로그인 후 이용하실 수 있습니다.');window.close();</script>";
		exit;
	}
}

function str_cut($str, $length) {
	if(strlen($str) > $length) {
		$str_length = strlen(substr($str, 0, $length));

		for($i = 0; $i < $str_length; $i++) {
			$temp = ord(substr($str, $i, 1));
			if($temp > 127) $i++;
		}

		$rtn_str = substr($str, 0, $i) . "..";
	}
	else {
		$rtn_str = $str;
	}
	return $rtn_str;
}

// 상품이미지 업로드 용
//UploadFile($upload_folder, "30", "m_img", "", "");
function UploadFile($FileSaveDir, $MaxUploadMaga, $FormFieldName, $DeleteFile, $RenameFile) {
	//echo $FileSaveDir.$MaxUploadMaga.$FormFieldName.$DeleteFile.$RenameFile;
	echo "<font size=2 color=red>";																						 //에러메시지 빨간색으로 보여주기 위해
//	echo $FileSaveDir;
//	echo @is_dir($FileSaveDir);
	if(!@is_dir($FileSaveDir)) {																								 //디렉토리 존재  확인
		if(!@mkdir($FileSaveDir,0777)){
			echo " >>>>>>>>>>파일을 저장할 디렉토리 만들기에 실패하였습니다.<<<<<<<<<<<<<br>";
		}
	}

	if ($_FILES[$FormFieldName]['size'] > 0) {			// 4.1.0 이전의 $_FILES 대신에 $HTTP_POST_FILES를 사용, 업로드 되었을경우
		$MaxFileSize=1024 * 1024 * $MaxUploadMaga;																//업로드 최대 사이즈 설정하기(MB)
		$TargetFileName = $_FILES[$FormFieldName]['name'];
		$TargetFileName = preg_replace("/[ #\&\+\-%@=\/\\\:;,\'\"\^`~\_|\!\?\*$#<>()\[\]\{\}]/i","", trim($TargetFileName));
		$UpFileName = explode(".", $TargetFileName);
		$UpFileType =  strtolower($UpFileName[count($UpFileName) - 1]);

		if ($RenameFile != "") {
			$TargetFileName = $RenameFile;					 //원하는 이름을 파일이름 재설정.".".$UpFileType
		} else {
			$i = 0;
			while(file_exists("$FileSaveDir/$TargetFileName")) {
				$TargetFileName = $UpFileName[0]."[".$i++."].".$UpFileType;									 //동일 파일명 처리 : 기존파일명(숫자).확장자
			}
		}


		if(preg_match("/^(php|html|php3|html|htm|asp|jsp|phtml|cgi|jhtml|exe)$/i",$UpFileType))	{			 //파일 타입제한 형식제한
			echo " >>>>>>>>>>>업로드 할수 없는 파일 형식입니다. 업로드에 실패 하였습니다.<<<<<<<<<<<<<br>";
			echo "</font>";																								    	//빨간색 폰트 닫음
			return $DeleteFile;																									 //삭제될 파일명 리턴(파일 수정시 이전파일명)
		}  else {

			if($MaxFileSize < $_FILES[$FormFieldName]['size'])	{
				echo " >>>>>>>>>>파일  업로드 용량을 초과했습니다. 최대 업로드 용량은 ".$MaxUploadMaga."MB입니다.<<<<<<<<<<<<<br>";
				echo "</font>";																								   	//빨간색 폰트 닫음
				return $DeleteFile;																								 //삭제될 파일명 리턴
			} else {
				if (@move_uploaded_file($_FILES[$FormFieldName]['tmp_name'], "$FileSaveDir/$TargetFileName")) {  //업로드된파일 옴기기
				 chmod("$FileSaveDir/$TargetFileName",0757);

					if ($DeleteFile != "" ) {																				 		// 삭제될 파일명이 있을 경우
						if ($DeleteFile != $TargetFileName) {															//지울파일과 업로드한 파일이 같지 않을 경우
							if (file_exists("$FileSaveDir/$DeleteFile")) {
								unlink("$FileSaveDir/$DeleteFile");														//이전 파일 삭제(파일 수정시 이전파일명)
							}
						}
					}
					echo "</font>";																							   	//빨간색 폰트 닫음
					//echo $TargetFileName;
					return $TargetFileName;																					//업로드된 파일명 반환
				} else {
					echo  ">>>>>>>>>>임시 파일을 파일 저장 디렉토리로 옮기는 과정의 에러가 발생하여 업로드에 실패하였습니다.<<<<<<<<<<<<<br>";
					echo "</font>";																						    	//빨간색 폰트 닫음
					return $DeleteFile;																							//삭제될 파일명 반환(파일 수정시 이전파일명)
				}
			}
		}
	} else {																			//php.ini 설정 상태로 인하여 업로드 실패하였을 경우
																						//(upload_tmp_dir, file_uploads,post_max_size, upload_max_filesize,max_execution_time)
		echo "</font>";																						    				//빨간색 폰트 닫음
		return $DeleteFile;																										//삭제될 파일명 반환(파일 수정시 이전파일명)
	}
}



// 상품이미지 업로드 용  ==> code_idx
//UploadFile($upload_folder, "30", "m_img", "", "");
function UploadFile_code($FileSaveDir, $MaxUploadMaga, $FormFieldName, $DeleteFile, $RenameFile,$file_name) {
	//echo $FileSaveDir.$MaxUploadMaga.$FormFieldName.$DeleteFile.$RenameFile;
	echo "<font size=2 color=red>";																						 //에러메시지 빨간색으로 보여주기 위해

	if(!@is_dir($FileSaveDir)) {																								 //디렉토리 존재  확인
		if(!@mkdir($FileSaveDir,0777)){
			echo " >>>>>>>>>>파일을 저장할 디렉토리 만들기에 실패하였습니다.<<<<<<<<<<<<<br>";
		}
	}

	if ($_FILES[$FormFieldName]['size'] > 0) {			// 4.1.0 이전의 $_FILES 대신에 $HTTP_POST_FILES를 사용, 업로드 되었을경우
		$MaxFileSize=1024 * 1024 * $MaxUploadMaga;																//업로드 최대 사이즈 설정하기(MB)
		$TargetFileName = $file_name;
		$TargetFileName = preg_replace("/[ #\&\+\%@=\/\\\:;,\'\"\^`~\|\!\?\*$#<>()\[\]\{\}]/i","", trim($TargetFileName));
		$UpFileName = explode(".", $TargetFileName);
		$UpFileType =  strtolower($UpFileName[count($UpFileName) - 1]);

		if ($RenameFile != "") {
			$TargetFileName = $RenameFile;					 //원하는 이름을 파일이름 재설정.".".$UpFileType
		} else {
			$i = 0;
			while(file_exists("$FileSaveDir/$TargetFileName")) {
				$TargetFileName = $UpFileName[0]."[".$i++."].".$UpFileType;									 //동일 파일명 처리 : 기존파일명(숫자).확장자
			}
		}


		if(preg_match("/^(php|html|php3|html|htm|asp|jsp|phtml|cgi|jhtml|exe)$/i",$UpFileType))	{			 //파일 타입제한 형식제한
			echo " >>>>>>>>>>>업로드 할수 없는 파일 형식입니다. 업로드에 실패 하였습니다.<<<<<<<<<<<<<br>";
			echo "</font>";																								    	//빨간색 폰트 닫음
			return $DeleteFile;																									 //삭제될 파일명 리턴(파일 수정시 이전파일명)
		}  else {

			if($MaxFileSize < $_FILES[$FormFieldName]['size'])	{
				echo " >>>>>>>>>>파일  업로드 용량을 초과했습니다. 최대 업로드 용량은 ".$MaxUploadMaga."MB입니다.<<<<<<<<<<<<<br>";
				echo "</font>";																								   	//빨간색 폰트 닫음
				return $DeleteFile;																								 //삭제될 파일명 리턴
			} else {
				if (@move_uploaded_file($_FILES[$FormFieldName]['tmp_name'], "$FileSaveDir/$TargetFileName")) {  //업로드된파일 옴기기
				 chmod("$FileSaveDir/$TargetFileName",0757);

					if ($DeleteFile != "" ) {																				 		// 삭제될 파일명이 있을 경우
						if ($DeleteFile != $TargetFileName) {															//지울파일과 업로드한 파일이 같지 않을 경우
							if (file_exists("$FileSaveDir/$DeleteFile")) {
								unlink("$FileSaveDir/$DeleteFile");														//이전 파일 삭제(파일 수정시 이전파일명)
							}
						}
					}
					echo "</font>";																							   	//빨간색 폰트 닫음
					//echo $TargetFileName;
					return $TargetFileName;																					//업로드된 파일명 반환
				} else {
					//echo  ">>>>>>>>>>임시 파일을 파일 저장 디렉토리로 옮기는 과정의 에러가 발생하여 업로드에 실패하였습니다.<<<<<<<<<<<<<br>";
					echo "</font>";																						    	//빨간색 폰트 닫음
					return $DeleteFile;																							//삭제될 파일명 반환(파일 수정시 이전파일명)
				}
			}
		}
	} else {																			//php.ini 설정 상태로 인하여 업로드 실패하였을 경우
																						//(upload_tmp_dir, file_uploads,post_max_size, upload_max_filesize,max_execution_time)
		echo "</font>";																						    				//빨간색 폰트 닫음
		return $DeleteFile;																										//삭제될 파일명 반환(파일 수정시 이전파일명)
	}
}



function attach_single_file($FileSaveDir, $MaxUploadMaga, $FormFieldName, $DeleteFile, $RenameFile) {
	echo "<font size=2 color=red>";																						 //에러메시지 빨간색으로 보여주기 위해

	if ($_FILES[$FormFieldName]['size'] > 0) {

		$MaxFileSize=1024 * 1024 * $MaxUploadMaga;
		$UpFileName = explode(".", $_FILES[$FormFieldName]['name']);
		$UpFileName[0] = time();
		$UpFileType =  strtolower($UpFileName[count($UpFileName) - 1]);
		$TargetFileName =  time().".".$UpFileType;


		if ($RenameFile != "") {
			$TargetFileName = $RenameFile;
		} else {
			$i = 0;
			while(file_exists("$FileSaveDir/$TargetFileName")) {
				$TargetFileName = $UpFileName[0]."_".$i++.".".$UpFileType;
			}
		}

		if(eregi("^(php|html|php3|html|htm|asp|jsp|phtml|cgi|jhtml|exe|js|bat|sh)$",$UpFileType))	{
			echo " >>>>>>>>>>>업로드 할수 없는 파일 형식입니다. 업로드에 실패 하였습니다.<<<<<<<<<<<<<br>";
			echo "</font>";
			return $DeleteFile;
		}  else {

			if($MaxFileSize < $_FILES[$FormFieldName]['size'])	{
				echo " >>>>>>>>>>파일  업로드 용량을 초과했습니다. 최대 업로드 용량은 ".$MaxUploadMaga."MB입니다.<<<<<<<<<<<<<br>";
				echo "</font>";																								   	//빨간색 폰트 닫음
				return $DeleteFile;																								 //삭제될 파일명 리턴
			} else {

				if (@move_uploaded_file($_FILES[$FormFieldName]['tmp_name'], "$FileSaveDir/$TargetFileName")) {  //업로드된파일 옮기기
				 chmod("$FileSaveDir/$TargetFileName",0777);
					if ($DeleteFile != "" ) {																				 		// 삭제될 파일명이 있을 경우
						if ($DeleteFile != $TargetFileName) {															//지울파일과 업로드한 파일이 같지 않을 경우
							if (file_exists("$FileSaveDir/$DeleteFile")) {
								unlink("$FileSaveDir/$DeleteFile");														//이전 파일 삭제(파일 수정시 이전파일명)
							}
						}
					}
					echo "</font>";																							   	//빨간색 폰트 닫음
					return $TargetFileName;																					//업로드된 파일명 반환
				} else {
					echo  ">>>>>>>>>>임시 파일을 파일 저장 디렉토리로 옮기는 과정의 에러가 발생하여 업로드에 실패하였습니다.<<<<<<<<<<<<<br>";
					echo "</font>";																						    	//빨간색 폰트 닫음
					return $DeleteFile;																							//삭제될 파일명 반환(파일 수정시 이전파일명)
				}
			}
		}
	} else {																			//php.ini 설정 상태로 인하여 업로드 실패하였을 경우
																						//(upload_tmp_dir, file_uploads,post_max_size, upload_max_filesize,max_execution_time)
		echo "</font>";																						    				//빨간색 폰트 닫음
		return $DeleteFile;																										//삭제될 파일명 반환(파일 수정시 이전파일명)
	}
}


function attach_file($board_id, $board_idx, $upload_folder) {

	for($i = 0; $i < count($_FILES[board_file]); $i++) {
		if($_FILES[board_file][name][$i] && $_FILES[board_file][size][$i]) {
			$file_ext = strtolower(substr(strrchr($_FILES[board_file][name][$i], "."), 1));


			$file_name = $_FILES[board_file][name][$i];
			$file_name = str_replace(" ","",$file_name);
			$file_path = $upload_folder . $file_name;

			$t = 0;
			while(file_exists($file_path)) {
				$file_name = substr($_FILES[board_file][name][$i], 0, (strripos($_FILES[board_file][name][$i], $file_ext) -1)) . "[" . $t++ . "]." . $file_ext;
				$file_path = $upload_folder . $file_name;
			}

			if(is_uploaded_file($_FILES[board_file][tmp_name][$i])) {
				move_uploaded_file($_FILES[board_file][tmp_name][$i], $file_path);
				chmod($file_path, 0777);
			}

			$query = "insert into TB_BOARD_FILE(board_idx, file_name, regist_date) values($board_idx, '$file_name', '" . date("Y-m-d H:i:s") . "')";


			$result = mysql_query($query);
		}
	}
}




//문자열 자르기 2013-10-01 변선진
function cutstr($text,$length){
	$text_lenth	 =	 strlen($text);
	if($text_lenth >$length){
		$text = substr($text,0,$length)."...";
	}
	echo $text;
}




// 경고 및 페이지 이동
function ErrorBack($message) {
	echo "<script language=JavaScript> alert ('".$message."'); history.go(-1);</script>";
	exit;
}

function AlertMove($message, $move_url) {
	echo "<script language=JavaScript>";

	if($message){
		echo "alert ('".$message."');";

	}

	if($move_url){
		echo "location.href='".$move_url."';";
	}
	echo "</script>";
	exit;
}

function AlertMoveReplace($message, $move_url) {
	echo "<script language=JavaScript>";

	if($message){
		echo "alert ('".$message."');";
	}

	echo "location.replace('".$move_url."');";
	echo "</script>";
	exit;
}


function AlertMoveParentReplace($message, $move_url) {
	echo "<script language=JavaScript>";

	if($message){
		echo "alert ('".$message."');";
	}

	if($move_url){
		echo "parent.location.replace('".$move_url."');";
	}
	echo "</script>";
	exit;
}

// 2009-09-29
function jsAlertScript($function,$msg){
	$str = "<SCRIPT>";

	if($msg)
		$str .= "alert('" . $msg . "');";

	if($function)
		$str .= $function;

	$str .= "</SCRIPT>";
	echo $str;
	exit;
}

Function DateType($datestr,$typeno) {

	$date_temp= explode(" ",$datestr);
	list($typeY, $typeM, $typeD) =explode("-",$date_temp[0]);
	list($typeH, $typeMI, $typeSE) =explode(":",$date_temp[1]);

	If (strlen($typeM) == 1) $typeM	= "0".$typeM;
	If (strlen($typeD) == 1) $typeD = "0".$typeD;
	If (strlen($typeH) == 1) $typeH	= "0".$typeH;
	If (strlen($typeMI) == 1) $typeMI = "0".$typeMI;
	If (strlen($typeSE) == 1) $typeSE	= "0".$typeSE;

	if ($typeno == 1) {
			$ReturnDateType = $typeY."-".$typeM."-".$typeD." ".$typeH.":".$typeMI.":".$typeSE;
	}  else if ($typeno == 2) {
			$ReturnDateType	= $typeY."년 ".$typeM."월 ".$typeD."일";
	} else if ($typeno == 3) {
			$ReturnDateType	= $typeY."년 ".$typeM."월 ".$typeD."일 ".$typeH."시 ".$typeMI."분";
	} else if ($typeno == 4) {
			$ReturnDateType	= $typeY."/".$typeM."/".$typeD;
	} else if ($typeno == 5) {
			$ReturnDateType	= $typeY.$typeM.$typeD.$typeH.$typeMI.$typeSE;
	} else if ($typeno == 6) {
			$ReturnDateType	=  $typeY."-".$typeM."-".$typeD;
	} else if ($typeno == 7) {
			$ReturnDateType	= $typeY.$typeM.$typeD;
	} else if ($typeno == 8) {
			$ReturnDateType	= $typeY.".".$typeM.".".$typeD;
	} else if ($typeno == 9) {
			$ReturnDateType	= $typeY."년 ".$typeM."월 ".$typeD."일 ".$typeH."시 ".$typeMI."초";
	} else if ($typeno== 11) {
		  $date_time = explode(" ", $datestr);
		  $date = explode("-",$date_time[0]);
		  $time = explode(":",$date_time[1]);
		  unset($date_time);
		  list($year, $month, $day)=$date;
		  list($hour,$minute,$second)=$time;
		  $ReturnDateType =  mktime(intval($hour), intval($minute), intval($second), intval($month), intval($day), intval($year));
	} else if ($typeno == 12) {
			$ReturnDateType	= substr($typeY,2,2).".".$typeM.".".$typeD;
	}  else if ($typeno == 13) {
			$ReturnDateType	= $typeY."년 ".$typeM."월";

	} else {
			$ReturnDateType	= $datestr;
	}

	 return $ReturnDateType;
}


// 2009-06-03 파일사이즈 체크
function attach_file_size($maxsize){
	if($maxsize > 0){
		$size = 1024 * 1024 * $maxsize;

		for($i = 0; $i < count($_FILES[board_file]); $i++) {
			if($_FILES[board_file][name][$i] && $_FILES[board_file][size][$i]) {
				if($_FILES[board_file][size][$i] > $size){
					echo "<script>alert('첨부파일 용량을 초과하여 글 등록에 실패하였습니다.\\n\\n첨부하시는 파일은 ".$maxsize."MB까지 가능합니다.');history.back(-1);</script>";
					exit;
				}
			}
		}
	}
}


function get_week_code($week) {
	if($week == "월") $code = 1;
	elseif($week == "화") $code = 2;
	elseif($week == "수") $code = 3;
	elseif($week == "목") $code = 4;
	elseif($week == "금") $code = 5;
	elseif($week == "토") $code = 6;
	elseif($week == "일") $code = 7;
	else $code = 0;

	return $code;
}

function get_week_name($code) {
	if($code == 1) $week = "월";
	elseif($code == 2) $week = "화";
	elseif($code == 3) $week = "수";
	elseif($code == 4) $week = "목";
	elseif($code == 5) $week = "금";
	elseif($code == 6) $week = "토";
	elseif($code == 0) $week = "일";
	else $week = "";

	return $week;
}

function get_member_part($part) {
	$rtn_str = "";

	if($part) {
		$query = "select inst_name from instrument where inst_idx = $part";
		$result = mysql_query($query);
		$affect_num = mysql_num_rows($result);
		if($affect_num) {
			$row = mysql_fetch_row($result);
			$rtn_str = $row[0];
		}
	}

	return $rtn_str;
}

function get_admin_gubun($gubun){
	$rtn_str = "";

	switch ($gubun){
		case "fee" :
			$rtn_str = "회계관리자";
			break;
		case "attend" :
			$rtn_str = "출석관리자";
			break;
		case "board" :
			$rtn_str = "게시판관리자";
			break;
		default :
			$rtn_str = "관리자";
			break;
	}

	return $rtn_str;
}

//사용자 알림글 조회여부
function get_read_yn($read_yn){
	$rtn_str = "";

	switch ($read_yn){
		case "Y" :
			$rtn_str = "읽음";
			break;
		case "N" :
			$rtn_str = "읽지않음";
			break;
		default :
			$rtn_str = "읽지않음";
			break;
	}

	return $rtn_str;
}

//사용자 알림글 수
function get_memo_count() {
	$rtn_str = "";
	$query = "select count(*) from board b, board_memo_target bmt where b.board_idx = bmt.board_idx and board_id = 'memo' and bmt.member_id = '".$_SESSION[sid]."' and read_yn = 'N'";
	$result = mysql_query($query);
	$affect_num = mysql_num_rows($result);
	if($affect_num) {
		$row = mysql_fetch_row($result);
		$rtn_str = $row[0];
	}

	return $rtn_str;
}


// 메일주소
function getEmail($email){
	$_EMAIL = array();
	$_EMAIL[] = "naver.com";
	$_EMAIL[] = "chol.com";
	$_EMAIL[] = "dreamwiz.com";
	$_EMAIL[] = "empal.com";
	$_EMAIL[] = "freechal.com";
	$_EMAIL[] = "gmail.com";
	$_EMAIL[] = "hanafos.com";
	$_EMAIL[] = "hanmail.net";
	$_EMAIL[] = "hanmir.com";
	$_EMAIL[] = "hiphone.net";
	$_EMAIL[] = "hotmail.com";
	$_EMAIL[] = "korea.com";
	$_EMAIL[] = "lycos.co.kr";
	$_EMAIL[] = "nate.com";
	$_EMAIL[] = "netian.com";
	$_EMAIL[] = "paran.com";
	$_EMAIL[] = "yahoo.com";
	$_EMAIL[] = "yahoo.co.kr";

	$str = "<option value=''>직접입력</option>";

	for($i=0; $i<count($_EMAIL); $i++){
		$selected = "";
		if($_EMAIL[$i]==$email) $selected = "selected";

		$str.= "<option value='".$_EMAIL[$i]."' ".$selected.">".$_EMAIL[$i]."</option>";
	}

	return $str;
}

// 전화번호 국번
function getPhone($phone1){
	$_PHONE = array();
	$_PHONE[] = "02";
	$_PHONE[] = "031";
	$_PHONE[] = "032";
	$_PHONE[] = "033";
	$_PHONE[] = "041";
	$_PHONE[] = "042";
	$_PHONE[] = "043";
	$_PHONE[] = "051";
	$_PHONE[] = "052";
	$_PHONE[] = "053";
	$_PHONE[] = "054";
	$_PHONE[] = "055";
	$_PHONE[] = "061";
	$_PHONE[] = "062";
	$_PHONE[] = "063";
	$_PHONE[] = "064";
	$_PHONE[] = "070";

	$str ="<option value=''></option>";

	for($i=0; $i<count($_PHONE); $i++){
		$selected = "";
		if($_PHONE[$i]==$phone1) $selected = "selected";

		$str.= "<option value='".$_PHONE[$i]."' ".$selected.">".$_PHONE[$i]."</option>";
	}

	return $str;

}

// 핸드폰
function getMobile($mobile1){
	$_MOBILE = array();
	$_MOBILE[] = "010";
	$_MOBILE[] = "011";
	$_MOBILE[] = "016";
	$_MOBILE[] = "017";
	$_MOBILE[] = "018";
	$_MOBILE[] = "019";

	$str ="<option value=''></option>";

	for($i=0; $i<count($_MOBILE); $i++){
		$selected = "";
		if($_MOBILE[$i]==$mobile1) $selected = "selected";

		$str.= "<option value='".$_MOBILE[$i]."' ".$selected.">".$_MOBILE[$i]."</option>";
	}

	return $str;

}

// 계좌정보
function getPayBank($pay_bank){
	$_BANK = array();
	$_BANK[] = "농협 123-5486-2642-86 예금주-신안천일염";

	$str ="<option value=''>입금계좌를 선택하세요.</option>";

	for($i=0; $i<count($_BANK); $i++){
		$selected = "";
		if($_BANK[$i]==$pay_bank) $selected = "selected";

		$str.= "<option value='".$_BANK[$i]."' ".$selected.">".$_BANK[$i]."</option>";
	}

	return $str;

}

$_LEVEL = array();
$_LEVEL[0] = "";
$_LEVEL[1] = "일반회원";
$_LEVEL[2] = "정단원";
$_LEVEL[3] = "휴식단원";
$_LEVEL[4] = "운영진";


$_MY_BOARD_ID = array();
$_MY_BOARD_ID[] = "my_notice";
$_MY_BOARD_ID[] = "pds";

$_FEE_TYPE = array();
$_FEE_TYPE[] = "정기회비";
$_FEE_TYPE[] = "입단비";
$_FEE_TYPE[] = "기타";

$_ATTEND_TYPE = array();
$_ATTEND_TYPE[] = "출석";
$_ATTEND_TYPE[] = "지각";
$_ATTEND_TYPE[] = "결석";

$_DIARY_TYPE = array();
$_DIARY_TYPE[] = "연습";
$_DIARY_TYPE[] = "연습실사용";
$_DIARY_TYPE[] = "회의";
$_DIARY_TYPE[] = "정기연주";
$_DIARY_TYPE[] = "기타연주";

//2009-06-01 사용자 왼쪽메뉴관련
$_PHPSELF = explode("/", $_SERVER[PHP_SELF]);
if($_PHPSELF[count($_PHPSELF)-1]){
	$_PAGENAME = explode(".", $_PHPSELF[count($_PHPSELF)-1]);
	if(is_array($_PAGENAME)){
		$_PAGENAME = $_PAGENAME[0];
	}
	else{
		$_PAGENAME ="";
	}
}

// 2009-09-16 상품페이지 상단 이미지 (DVD, BOOK, GIFT)
function getRootImg($cate_root){
	if($cate_root){
		switch($cate_root){
			case "1":
				$str = " <img src='/_img/tit/ti_dvd.gif' alt='DVD' title='DVD'> ";
				break;
			case "2":
				$str = " <img src='/_img/tit/ti_book.gif' alt='BOOK' title='BOOK'> ";
				break;
			case "3":
				$str = " <img src='/_img/tit/ti_gift.gif' alt='GIFT' title='GIFT'> ";
				break;
			case "17":
				$str = " <img src='/_img/tit/ti_sale.gif' alt='할인상품' title='할인상품'> ";
				break;
		}

		return $str;
	}
}

// 2009-09-16 대카테고리별 상품
// cate_root: 대카테고리, shop_yn: 상품구분(베스트셀러, 최신, 추천, 이벤트, 인기)
// 사용처 : 상품목록
function getProdGubunQuery($cate_root, $shop_yn, $limit){

	$query = " SELECT shop_idx, shop_name, shop_sobiprice, shop_sellprice, shop_cate_idx , shop_imgfile1 ";
	$query.= " FROM TB_SHOP ";
	$query.= " WHERE SUBSTRING_INDEX(SUBSTRING_INDEX(shop_cate_idx, '_', 2), '_', -1) = '".$cate_root."' ";
	$query.= " AND ".$shop_yn." = 'Y' ";
	$query.= " AND shop_flag = '1' ";
	$query.= " ORDER BY RAND() ";
	$query.= " LIMIT 0, ".$limit;

	return $query;
}

// 2009-09-16 태그
function getTag ($shop_idx){
	$returnStrTag="";

	if($shop_idx){
		$query = " Select tag_idx, shop_idx, shop_tag From TB_SHOP_TAG WHERE shop_idx = '".$shop_idx."'  ";
		$result = mysql_query($query.$whereQuery);
		$cnt = 0;
		if($result){
			while($row = mysql_fetch_array($result)){
				if($cnt <> 0) $returnStrTag.= ", ";
				$returnStrTag.= "<a href='/search/search_list.html?top_keyword=".$row[shop_tag]."' onFocus='this.blur();'>".$row[shop_tag]."</a>";
				$cnt++;
			}
		}
		else{
			$returnStrTag = "태그불러오기 실패";
		}
	}

	return $returnStrTag;
}


// 2009-09-16 상품네비게이션
function getProdNavi($cate_root, $cate_idx){
	$arrCate = array();

	$query = " Select cate_root, cate_parent, cate_name, cate_step From TB_CATEGORY ";

	if($cate_idx){
		$whereQuery = " Where cate_idx = '".$cate_idx."' ";

		$result = mysql_query($query.$whereQuery);
		if($result){
			$row = mysql_fetch_array($result);
			$cate_step	= $row[cate_step];
			$cate_parent= $row[cate_parent];
			$arrCate[0]	= "<b>".$row[cate_name]."</b>";

			if($cate_step > 1){
				for($i=1; $i < $cate_step; $i++){
					$whereQuery = " Where cate_idx = '".$cate_parent."'";
					$result = mysql_query($query.$whereQuery);
					$row = mysql_fetch_array($result);
					$arrCate[$i] = $row[cate_name];
					$cate_parent = $row[cate_parent];
				}
			}

			if(is_array($arrCate)){
				$arrCateCnt = count($arrCate)-1;
				for($i=$arrCateCnt; $i>=0; $i--){
					$naviStr.= $arrCate[$i];
					if($i <> 0) $naviStr.= " > ";
				}
			}

		}
		else{
			echo "<font color='red'>카테고리명 로드실패</font>";
		}
	}

	return $naviStr;

}


function getMainProd($cate,$column,$count,$SHOP_IMG_DIR,$_NOIMAGE_S){
	$returnStr = "";

	if($column && $count){

		if($cate)
			$searchSql = " And SUBSTRING_INDEX(SUBSTRING_INDEX(shop_cate_idx, '_', 2), '_', -1) = '".$cate."' ";

		$query  = " SELECT shop_idx, shop_name, shop_sobiprice, shop_sellprice, shop_cate_idx , shop_imgfile1 ";
		$query .= " FROM TB_SHOP ";
		$query .= " WHERE ".$column." = 'Y' ";
		$query .= " AND shop_flag = '1' ";
		$query .= $searchSql;
		$query .= " ORDER BY shop_sort Desc";
		$query .= " LIMIT 0, ".$count;

		$result = mysql_query($query);

		if($result){

			$i = 0;

			while($row = mysql_fetch_array($result)){
				$shop_idx		= $row[shop_idx];
				$shop_name		= $row[shop_name];
				$shop_sobiprice = $row[shop_sobiprice];
				$shop_sellprice = number_format($row[shop_sellprice]);
				$shop_imgfile1	= $row[shop_imgfile1];

				if($shop_imgfile1){
					$shop_img = $SHOP_IMG_DIR."/".$shop_idx."/".$shop_imgfile1;
				}
				else{
					$shop_img = $_NOIMAGE_S;
				}

				$returnStr .= " <td> ";
				$returnStr .= "	<a href=\"./product/detail.html?shop_idx=".$shop_idx."\"><img src=\"".$shop_img."\" border=\"0\" width=\"94\" height=\"120\"></a><br> ";
				$returnStr .= "	<a href=\"./product/detail.html?shop_idx=".$shop_idx."\">".$shop_name."</a><br>";
				$returnStr .= "	<span class=\"price\">".$shop_sellprice."원</span> ";
				$returnStr .= "	</td> ";

				$i++;
			}

			for($j=$i;$j<$count;$j++){
				$returnStr .= "<td width=\"107\">&nbsp;</td>";
			}

		}
	}

	return $returnStr;
}


function getMainProdDetail($cate,$column,$SHOP_IMG_DIR,$_NOIMAGE_S){
	$returnStr = "";

	if($column){

		if($cate)
			$searchSql = " And SUBSTRING_INDEX(SUBSTRING_INDEX(shop_cate_idx, '_', 2), '_', -1) = '".$cate."' ";

		$query  = " SELECT shop_idx, shop_name, shop_sobiprice, shop_sellprice, shop_cate_idx, shop_imgfile1, shop_content";
		$query .= " FROM TB_SHOP ";
		$query .= " WHERE ".$column." = 'Y' ";
		$query .= " AND shop_flag = '1' ";
		$query .= $searchSql;
		$query .= " ORDER BY rand() Desc";
		$query .= " LIMIT 0, 1 " ;

		$result = mysql_query($query);

		if($result){

			while($row = mysql_fetch_array($result)){
				$shop_idx		= $row[shop_idx];
				$shop_name		= $row[shop_name];
				$shop_sobiprice = $row[shop_sobiprice];
				$shop_sellprice = number_format($row[shop_sellprice]);
				$shop_imgfile1	= $row[shop_imgfile1];
				$shop_content	= $row[shop_content];
				$shop_content	= strip_tags($shop_content);
				$shop_name		= str_cut($shop_name,"20");
				if($shop_imgfile1){
					$shop_img = $SHOP_IMG_DIR."/".$shop_idx."/".$shop_imgfile1;
				}
				else{
					$shop_img = $_NOIMAGE_S;
				}

				$returnStr .= " <tr> ";
				$returnStr .= "		<th><a href=\"./product/detail.html?shop_idx=".$shop_idx."\"><img src=\"".$shop_img."\" border=\"0\" width=\"94\" height=\"120\"></a></th> ";
				$returnStr .= "		<td> ";
				$returnStr .= "		  <h3><a href=\"./product/detail.html?shop_idx=".$shop_idx."\">".$shop_name."</a></h3>";
				$returnStr .= "			<i>".$shop_sellprice."원</i>";
				$returnStr .= "<em>&nbsp;</em>";
				$returnStr .= "			<a href=\"./product/detail.html?shop_idx=".$shop_idx."\">".str_cut($shop_content,85)."</a></td></tr>";

			}

		}
	}

	return $returnStr;
}

function tagInsert($shop_idx,$tagStr,$regId){
	$tagStr	= str_replace(" ","",$tagStr);

	if($tagStr){
		$tagArr = explode(",",$tagStr);

		$Sql = " Delete From TB_SHOP_TAG Where shop_idx = " . $shop_idx;
		mysql_query($Sql);

		for($i=0;$i<count($tagArr);$i++){
			if($tagArr[$i]){

				$Sql  = " Insert into TB_SHOP_TAG (shop_idx,shop_tag,regdate,regid) values (";
				$Sql .= $shop_idx .",";
				$Sql .= "'" . $tagArr[$i] . "',";
				$Sql .= "now(),";
				$Sql .= "'" . $regId . "')";

				mysql_query($Sql);
			}
		}
	}
}

function tagSelect($shop_idx){

	$tmpStr = "";

	if($shop_idx){

		$Sql	= " Select shop_tag From TB_SHOP_TAG Where shop_idx = " . $shop_idx . " Order by tag_idx asc ";
		$result = mysql_query($Sql);
		$num	= mysql_num_rows($result);

		//echo $num;

		if($result){
			while($row = mysql_fetch_array($result)){
				$i++;
				$tmpStr .= $row[0];
				if($i<$num) $tmpStr .= ",";
			}
		}
	}

	return $tmpStr;
}

// 배송료(10만원이상 무료)
function getSendprice($order_totalprice, $DELIVERY_CONDITION_PRICE, $DELIVERY_PRICE){
	if($order_totalprice >= $DELIVERY_CONDITION_PRICE){
		$order_sendprice = 0;
	}
	else{
		$order_sendprice = $DELIVERY_PRICE;
	}

	return $order_sendprice;
}

// 2009-09-24 정렬
function getProdOrderSql($sort){
	$sort_sql = "";

	switch($sort){
		case "A"://판매량많은순
			$sort_sql = " ORDER BY shop_order DESC, ts.shop_name ASC ";
			break;
		case "B"://상품명순
			$sort_sql = " ORDER BY ts.shop_name ASC, ts.shop_name ASC ";
			break;
		case "C"://신상품순
			$sort_sql = " ORDER BY ts.shop_sort DESC, ts.shop_name ASC ";
			break;
		case "D"://저가순
			$sort_sql = " ORDER BY ts.shop_sellprice ASC, ts.shop_name ASC ";
			break;
		case "E"://고가순
			$sort_sql = " ORDER BY ts.shop_sellprice DESC, ts.shop_name ASC ";
			break;
	}

	return $sort_sql;
}

// 2009-09-29
function ifilter($str) {
	return eregi_replace("(select|update|insert|delete|drop|#|\/\*|\*\/|\\\|\;|<|>|\')","",$str);
}

// 2009-11-16 41바이트 비밀번호 생성
// 한독협 디비서버가 password()와 old_password() 실행시 같은 값을 가져다 주는 관계로...
function mysql_new_password( $pw ) {
	return strlen($pw)>0?strtoupper('*'.sha1(sha1($pw,true))):($pw=== null?null:'');
}
//************회원 sms 발송
function open_sms_db() {
	global $sms_dbhost, $sms_dbuser, $sms_dbpasswd, $sms_dbname, $sms_dbconn, $sms_dbstatus;

	$sms_dbhost = "114.200.199.9";
	$sms_dbuser = "sms_emma";
	$sms_dbpasswd = "niceduri";
	$sms_dbname = "sms_emma";
	$sms_dbconn = mysql_connect($sms_dbhost, $sms_dbuser, $sms_dbpasswd) or die("DB Connection 실패");

	$sms_dbstatus = mysql_select_db($sms_dbname, $sms_dbconn);
}

function close_sms_db() {
	global $sms_dbconn;

	mysql_close($sms_dbconn);
}

function send_sms($site_id, $rcv_num, $send_num, $content) {

	global $sms_dbconn;

	$sms_query = "insert into em_tran(tran_id, tran_phone, tran_callback, tran_status, tran_date, tran_msg) values('$site_id', '$rcv_num', '$send_num', '1', '" . date("Y-m-d H:i:s") . "', '$content')";
	$sms_result = mysql_query($sms_query, $sms_dbconn);
}

function SendMail($email_adr, $email_title, $email_B_content) {
	global $SITE_URL, $_MailHeaders  ,$EMAIL_YN;

	$mail_header = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>\n";
	$mail_header .= "<head>\n";
	$mail_header .= "<title></title>\n";
	$mail_header .= "<meta http-equiv='Content-Type' content='text/html; charset=euc-kr' />\n";
	$mail_header .= "<meta http-equiv = 'X-UA-Compatible' content = 'IE=7'>\n";
	$mail_header .= "<style type='text/css'>\n";
	$mail_header .= "#sinan_wrap span	{font-weight:bold; color:#000; text-decoration:underline;}\n";
	$mail_header .= "</style>\n";
	$mail_header .= "</head>\n";
	$mail_header .= "<body>\n";
	$mail_header .= "	<div id='sinan_wrap' style='width:660px; margin:0 auto; padding:10px; border:1px solid #ccc'>\n";
	$mail_header .= "		<div>\n";
	$mail_header .= "			<a href='".$SITE_URL."' target='_blank'><img src='".$SITE_URL."/_img/main/tit.gif' alt='' border='0'></a>\n";
	$mail_header .= "		</div>\n";
	$mail_header .= "		<div style='width:636px; padding:12px 10px 10px 10px; margin:5px 0 0 0; border:2px solid #ddd'>\n";
	$mail_header .= "			<table style='width:595px; color:#666; text-align:center; margin:0 auto; border:1px solid #ccc'>\n";
	$mail_header .= "			  <tr>\n";
	$mail_header .= "				<td style='padding:10px;'>\n";

	$mail_footer = "				</td>\n";
	$mail_footer = "			  </tr>\n";
	$mail_footer = "			</table>\n";
	$mail_footer .= "			<table width='610px' border='0' cellpadding='0' cellspacing='0'>\n";
	$mail_footer .= "			  <tr>\n";
	$mail_footer .= "				<td align='center' valign='top' width='50px' style='font-size:12px; padding:10px 0 0 0'><img src='".$SITE_URL."/_img/main/mail_01.gif' alt='' border='0'></td>\n";
	$mail_footer .= "				<td style='font-size:12px; line-height:150%; padding:10px 0 0 0'>본 메일은 [정보통신망 이용촉진 및 정보보호 등에 관한 법률]시행규칙 제11조 제3항에 의거회원님의<br/>
		  메일수신동의 여부를 확인한 결과 회원님께서 수신을 동의하셨기에 발송되었습니다.<br/>
		메일 수신을 원하지 않으시면<a href='".$EMAIL_YN."'>[수신거부]</a>를 클릭하셔서 로그인후 <br/>회원정보의  <a href='".$EMAIL_YN."'>[메일수신여부]</a>를 변경해주세요</td>\n";
	$mail_footer .= "			 </tr>\n";
	$mail_footer .= "			</table>\n";
	$mail_footer .= "		</div>\n";
	$mail_footer .= "		<div style='padding:20px 10px 10px 10px; text-align:center; color:#666; font-size:11px;'>\n";
	$mail_footer .= "			충청남도 천안시 서북구 두정동 1371 팰리스피아 514호   TEL : 041) 562-6265  FAX : 041) 562-6266  <br>
								Copyright (C) 2010 BCS KOREA ALL RIGHTS RESERVED\n";
	$mail_footer .= "		</div>\n";
	$mail_footer .= "	</div>\n";
	$mail_footer .= "</body>\n";
	$mail_footer .= "</html>\n";

	$email_content = $mail_header . $email_B_content . $mail_footer;
	//echo $email_content ;
	//exit;
	 mail($email_adr, $email_title, $email_content, $_MailHeaders);
	//echo mail($email_adr, $email_title, $email_content, $_MailHeaders);
	 //exit;
}
/*******************************************************************************
email 발송
*******************************************************************************/
function Send_DemonMail($server_id, $senderName, $senderMail, $rcvName, $rcvMail, $mailSubject, $mailContent, $server_ip, $senderDomain, $rcvDomain, $susinIdx) {
 $DemonMail_dbhost  = "localhost";
 $DemonMail_dbuser  = "daemonmail";
 $DemonMail_dbpasswd  = "epahsapdlf!@";
 $DemonMail_dbname  = "daemonmail";
 $DemonMail_dbconn  = mysql_connect($DemonMail_dbhost, $DemonMail_dbuser, $DemonMail_dbpasswd) or die("DB Connection 실패");
 $DemonMail_dbstatus  = mysql_select_db($DemonMail_dbname, $DemonMail_dbconn);

 mysql_query("SET NAMES 'euckr'");
 mysql_query("set character_set_client=euckr");
 mysql_query("set character_set_connection=euckr");
 mysql_query("set character_set_results=euckr");

 if(!$DemonMail_dbstatus) {
  $err_no = mysql_errno();
  $err_msg = mysql_error();
  $error_msg = "ERROR CODE ". $err_no . ":$err_msg";
  echo($error_msg);
  exit;
 }


 $sql  =" insert into daemon_mail(rcv_server_id,rcv_server_ip,sender_mail_address,sender_mail_domain,sender_mail_name,rcv_mail_address,";
 $sql .="       rcv_mail_domain,rcv_mail_name,mail_subject,mail_body,insertdate,susin_idx)";
 $sql .=" values ( '".$server_id."','".$server_ip."','".$senderMail."','".$senderDomain."','".$senderName."','".$rcvMail."',";
 $sql .="          '".$rcvDomain."', '".$rcvName."','".$mailSubject."','".$mailContent."',now(),'".$susinIdx."')";
//ECHO $sql; exit;
 $send_result = mysql_query($sql);

 return $send_result;
}

function data_SendMail($email_content){

	///////////////////////////////////////////////////////////main/////////////////////////////////////////////////////////////
	global $SITE_URL, $_MailHeaders  ,$EMAIL_YN;
	$URL = "http://www.ganggo.or.";
	$send_email_content  = "<table style=\"margin:20px auto; width:600px\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\n";
	$send_email_content .= "<tr>\n";
	$send_email_content .= "<td>".$email_content."</td>\n";
	$send_email_content .= "</tr>\n";
	$send_email_content .= "</table>	\n";
	///////////////////////////////////////////////////////////main/////////////////////////////////////////////////////////////


	//////////////////////////////////////////////////////////content////////////////////////////////////////////////////////////
	$mail_header = "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n";
	$mail_header .= "<head>\n";
	$mail_header .= "<title></title>\n";
	$mail_header .= "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=euc-kr\" />\n";
	$mail_header .= "<meta http-equiv = \"X-UA-Compatible\" content = \"IE=7\">\n";
	$mail_header .= "<style type=\"text/css\">\n";
	$mail_header .= "#sinan_wrap span	{font-weight:bold; color:#000; text-decoration:underline;}\n";
	$mail_header .= "</style>\n";
	$mail_header .= "</head>\n";
	$mail_header .= "<body>\n";
	$mail_header .= "	<div id=\"sinan_wrap\" style=\"width:660px; margin:0 auto; padding:10px; background:#eee; border:1px solid #d1d1d1; \">\n";
	$mail_header .= "		<div>\n";
	$mail_header .= "			<a href=\"".$SITE_URL."\" target=\"_blank\" style=\"text-decoration:none;border:none;\" >\n";
	$mail_header .= "		</div>\n";
	$mail_header .= "		<p style=\"padding:0; margin:0;\"><img src=\"".$URL."/_img/mail_tit.gif\" style=\"text-decoration:none;border:none;\"></a></p>";
	$mail_header .= "		<div style=\"width:636px; margin:10px 0 0 0; padding:12px 10px 10px 10px; border:1px solid #d1d1d1; background:#fff; \">\n";
	$mail_header .= "			<table style=\"width:595px; color:#666; text-align:center; margin:0 auto; \">\n";
	$mail_header .= "			  <tr>\n";
	$mail_header .= "				<td style=\"padding:10px;\">\n";

	$mail_footer .= "				</td>\n";
	$mail_footer .= "			  </tr>\n";
	$mail_footer .= "			</table>\n";
	$mail_footer .= "		</div>\n";
	$mail_footer .= "		<div style=\"padding:20px 10px 10px 10px; text-align:center; color:#666; font-size:11px; line-height:16px;\">\n";
	$mail_footer .= "			210-924 강원도 강릉시 교1동 1256-1번지 4층 TEL : 033-666-7113<br>
											Copyright (C) 2001~2013 강릉고등학교총동문회 ALL RIGTHS RESERVED \n";
	$mail_footer .= "		</div>\n";
	$mail_footer .= "	</div>\n";
	$mail_footer .= "</body>\n";
	$mail_footer .= "</html>\n";
	$document = $mail_header . $send_email_content . $mail_footer;

	return $document;
}



function data_SendWebMail($email_content){

	///////////////////////////////////////////////////////////main/////////////////////////////////////////////////////////////
	global $SITE_URL, $_MailHeaders  ,$EMAIL_YN;
	$URL = "http://www.ganggo.or.kr";
	$send_email_content  = "<table style=\"margin:20px auto; width:600px\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\n";
	$send_email_content .= "<tr>\n";
	$send_email_content .= "<td>".$email_content."</td>\n";
	$send_email_content .= "</tr>\n";
	$send_email_content .= "</table>	\n";
	///////////////////////////////////////////////////////////main/////////////////////////////////////////////////////////////


	//////////////////////////////////////////////////////////content////////////////////////////////////////////////////////////
	$mail_header = "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n";
	$mail_header .= "<head>\n";
	$mail_header .= "<title></title>\n";
	$mail_header .= "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=euc-kr\" />\n";
	$mail_header .= "<meta http-equiv = \"X-UA-Compatible\" content = \"IE=7\">\n";
	$mail_header .= "<style type=\"text/css\">\n";
	$mail_header .= "#sinan_wrap span	{font-weight:bold; color:#000; text-decoration:underline;}\n";
	$mail_header .= "</style>\n";
	$mail_header .= "</head>\n";
	$mail_header .= "<body>\n";
	$mail_header .= "	<div id=\"sinan_wrap\" style=\"width:660px; margin:0 auto; padding:10px; background:#eee; border:1px solid #d1d1d1; \">\n";
	$mail_header .= "		<div>\n";
	$mail_header .= "			<a href=\"".$SITE_URL."\" target=\"_blank\" style=\"text-decoration:none;border:none;\" >\n";
	$mail_header .= "		</div>\n";
	$mail_header .= "		<div style=\"width:636px; margin:10px 0 0 0; padding:12px 10px 10px 10px; border:1px solid #d1d1d1; background:#fff; \">\n";
	$mail_header .= "			<table style=\"width:595px; color:#666; text-align:center; margin:0 auto; \">\n";
	$mail_header .= "			  <tr>\n";
	$mail_header .= "				<td style=\"padding:10px;\">\n";

	$mail_footer .= "				</td>\n";
	$mail_footer .= "			  </tr>\n";
	$mail_footer .= "			</table>\n";
	$mail_footer .= "		</div>\n";
	$mail_footer .= "	</div>\n";
	$mail_footer .= "</body>\n";
	$mail_footer .= "</html>\n";
	$document = $mail_header . $send_email_content . $mail_footer;

	return $document;
}

//****************************************************************************************************************//

/*******************************************************************************
SMS 발송
*******************************************************************************/
function SendSMS($from_num, $to_num, $message, $msg_type) {
	$sms_site_id = "ganggo";

	$sms_sql		 = "";
	$sms_log_sql = "";

	$from_num = str_replace("-","",$from_num);
	$to_num = str_replace("-","",$to_num);

	//$to_num = "01062507943";
	//$to_num = "0336467113";
	//$to_num = "01033912891";

//Insert into em_tran
//(tran_phone, tran_callback, tran_status, tran_date, tran_msg , tran_type) values
//('010-000-0000', '010-000-0000', '1', sysdate(), 'Test Message입니다' ,4);


	$sms_sql .= "INSERT INTO em_tran( tran_phone, tran_callback, tran_status, tran_date, tran_msg, tran_type, tran_id, tran_etc1 )  values  ";
	$sms_sql .= "('".$to_num."'";
	$sms_sql .= ", '".$from_num."'";
	$sms_sql .= ", '1'";
	$sms_sql .= ", sysdate() ";
	$sms_sql .= ", '".$message."'";
	$sms_sql .= ", 4";
	$sms_sql .= ", '".$sms_site_id."'";
	$sms_sql .= ", '".$msg_type."'";
	$sms_sql .= ") ";

	$SMSDbcon=mysql_connect("localhost","sms_emma","niceduri") or die("데이터베이스 연결에 실패하였습니다.");

	mysql_select_db("sms_emma",$SMSDbcon);
	mysql_query($sms_sql,$SMSDbcon);
	mysql_close($SMSDbcon);
}

function deleteTag($content) {
	$content = str_replace("<","&lt;",$content);
	$content = str_replace(">","&gt;",$content);
	return $content;
}
// 코멘트 테이블에서 현재 IDX 값에 해당하는 답글이 있는지 확인 (동덕리더십)
function check_comment($tb_name, $check_idx)
{
	$query_cmt = "SELECT * FROM $tb_name WHERE qna_idx =$check_idx";

	$result_cmt = mysql_query($query_cmt);
	$affect_num_cmt = mysql_num_rows($result_cmt);

	return $affect_num_cmt;
}
// 나머지 구하는 함수
function mod($target, $value)
{
	$temp = $target/$value;
	$temp = (int)$temp;
	$temp = $temp * $value;

	$temp = $target - $temp ;

	return $temp;
}

function AlertClose($message){	//정재우 2013-03-11
	echo "<script>";
	echo "alert('".$message."');";
	echo "window.close();";
	echo "</script>";
	exit;
}
function Level_check(){
	if($_SESSION["a_m_level"]<"5"){
		echo "<script>alert('권한이 없습니다.');history.back();</script>";
	}
}

function phone_firstNumCheck($arg_firstNum) {
	if((substr($arg_firstNum, 0, 3) == "010") || (substr($arg_firstNum, 0, 3) == "011") || (substr($arg_firstNum, 0, 3) == "016") || (substr($arg_firstNum, 0, 3) == "017") || (substr($arg_firstNum, 0, 3) == "018") || (substr($arg_firstNum, 0, 3) == "019") ) {
		return true;
	} else {
		return false;
	}
}



//////////////////////////////////////make_thumb_nail_function- 이미지 비율 적용된 함수////////////////////////////////////////////////
//$source_path : 저장된 이미지 경로
//$width : 변경할 가로 사이즈
//$height : 변경할 세로 사이즈
//$thumbnail_path : 변경 이후 저장할 경로 (파일이름과 같이 써야 한다.)
function make_thumbnail($source_path, $width, $height, $thumbnail_path){
	@ini_set('gd.jpeg_ignore_warning', 1);	//  GD를 이용한 이미지 처리. 해결(jws 2-24)
/*
	echo $source_path."<br />";
	echo $width."<br />";
	echo $height."<br />";
	echo $thumbnail_path."<br />";
	exit;
*/
	# 저장된 이미지의 정보를 가져와 배열로 만들어준다. list는 변수로 담을 수 있음.

    list($img_width,$img_height, $type)	= getimagesize($source_path);

	#type은 1:GIF / 2:JPG / 3:PNG / 15:WBMP
    if ($type!=1 && $type!=2 && $type!=3 && $type!=15)  return;

	# 해당경로 해당 이미지와 동일한 조건으로 새로 만든다.
    if ($type==1) {
		# GIF 확장자
		$img_sour = imagecreatefromgif($source_path);
	} else if ($type==2 ) {
		# JPG 확장자
		$img_sour = @imagecreatefromjpeg($source_path);		// @ 강제사용. jws 2-24
	} else if ($type==3 ) {
		# PNG 확장자
		$img_sour = imagecreatefrompng($source_path);
	} else if ($type==15) {
		# WBMP 확장자
		$img_sour = imagecreatefromwbmp($source_path);
	}

	$sx = $img_width;
	$sy = $img_height;

	$maxX = $width;
	$maxY = $height;


	if(($sx==$maxX)&&($sy==$maxY)) {

		$targ_X = 300;
		$targ_Y = 300;
	}else{

		if($sx > $sy ){
		 $targ_Y=$maxY;
		 $targ_X=ceil(($sx*$maxY)/$sy);
		 if ($targ_X < $maxX) {
			$targ_X = $maxX;
			$targ_Y = ceil(($sy*$maxX)/$sx);
		 }
		 $startX = ceil(($targ_X - $maxX)/2);
		}
		else{
		 $targ_X=$maxX;
		 $targ_Y=ceil(($sy*$maxX)/$sx);
		}
	}

	//echo "sx--->".$sx."<br>";
	//echo "targ_X--->".$targ_X."<br>";
	//echo "maxX--->".$maxX."<br>";
	//echo "startX--->".$startX."<br>";


	$dst_img=ImageCreateTrueColor($width, $height);//빈이미지를 만들어주고
	$trans_colour = imagecolorallocate($dst_img, 255,255,255);
	imagefill($dst_img, 0, 0, $trans_colour);

	if($sx > $sy ){
	 imagecopyresampled($dst_img,$img_sour,0,0,$startX,0,$targ_X,$targ_Y,$sx,$sy);
	}
	else{
	 imagecopyresampled($dst_img,$img_sour,0,0,0,0,$targ_X,$targ_Y,$sx,$sy);
	}
	//imagedestroy($dst_img);


    if ($thumbnail_path) {
		#각 타입에 맞는 확장자로 이미지 저장.
        if ($type==1) {
			imagegif($dst_img, $thumbnail_path, 100); # 생성된 이미지, 저장될 경로, ★이미지 압축레벨(0~9)★,이미지상태 높을수록 좋음
		} else if ($type==2 ) {
			imagejpeg($dst_img, $thumbnail_path, 100);
		} else if ($type==3 ) {
			imagepng($dst_img, $thumbnail_path,9, 100);
		} else if ($type==15) {
			imagebmp($dst_img, $thumbnail_path, 100);
		}
    }else {
        if ($type==1) {
			imagegif($dst_img);
		} else if ($type==2 ) {
			imagejpeg($dst_img);
		} else if ($type==3 ) {
			imagepng($dst_img);
		} else if ($type==15) {
			imagebmp($dst_img);
		}
    }
    imagedestroy($dst_img);


}//////////////////////////////////////make_thumb_nail_function- 이미지 비율 적용된 함수////////////////////////////////////////////////



//접속매체 가져오기.
function get_ua() {
	$ua = strtolower($_SERVER['HTTP_USER_AGENT']);
	$iphone = strpos($ua, "iphone");
	$ipad = strpos($ua, "ipad");
	$ipod = strpos($ua, "ipod");
	$ios = strpos($ua, "ios");
	$android = strpos($ua, "android");

	$pensiontalk = strpos($ua, "pensiontalk");
	$ua = "pc";
	if($iphone || $ipad || $ipod || $ios ) {
		$ua = "ios";
	}else if($android) {
		$ua = "android";
	}

//	if($pensiontalk) {
//		$ua .= "_inapp";
//	}
	return $ua;

}


function setFileNameExt($file_full_path, $file_full_name) {

	$retune_value = $file_full_name;

	$arr_ext = array("jpg","gif","png","bmp");

	foreach ($arr_ext as $key=>$val) {
		if (is_file($file_full_path."/".$file_full_name.".".$val)) {
			$retune_value = $file_full_name.".".$val;
			break;
		}
	}
	return $retune_value;

}
?>
