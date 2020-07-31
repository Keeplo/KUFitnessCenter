<?

$SITE_TITLE = "강릉고총동문회";
$SITE_URL	= "http://www.ganggo.org";
$SITE_M_URL	= "http://m.ganggo.org";


// 2017-02-10 이국진
$IOS_NEW_APP_VERSION = "1.3";
$ANDROID_NEW_APP_VERSION = "1.1";



$SITE_EMAIL	= "";
$EMAIL_YN   = "http://wwww.bcskorea.com/member/modify.php";

$ADMIN_SMS_NUM   = "0415626265";

// 우석 위드2012 계정 파이어베이스 키
$server_push_key = "AAAAh-u2Gb8:APA91bEz6ukFiUXBMyB-0vB2cd_moVDPn2U9JFAKLDm5HvOLAwFftWxGLRRUXTzeacXHyM38tBG7ln-XzxRgRVUbQS3FqgSDhutb7GtED2vlF-b1h9vna-Irfyumo16_qhI4rGWKJspi";
//$server_push_key = "AIzaSyBB-xuruEh2alUq-Y4hm3OfTuYxs3BgNEM";

$ADMIN_SITE_TITLE = "강릉고 총 동문회 - 관리자";

//$BODY_CONTENT = "oncontextmenu=\"alert(contextmenu_message);return false;\" ondragstart=\"return false\" onselectstart=\"return false\"";
$BODY_CONTEXT = "";

$ADMIN_IMG_DIR = "/admin/_img/comm/";
$IMG_DIR = "/_img";

$upload_folder = "/home/ganggo/public_html/_upload/";

$_NOIMAGE_B = "/_img/sub/prod_noimgb.gif";
$_NOIMAGE_S = "/_img/sub/prod_noimgs.gif";

// 상품이미지
$SHOP_IMG_DIR = "/shopimage";
//새로운게시물 기간
$TERM = 4;

/* 메일관련 시작*/
$_MailHeaders  = "From: ".$SITE_TITLE."<$SITE_EMAIL>\r\n";
$_MailHeaders .= "Reply-To: $SITE_TITLE\r\n";
$_MailHeaders .= "X-Mailer: PHP ".phpversion()."\r\n";
//$_MailHeaders .= "X-Priority: 1\r\n";
$_MailHeaders .= "MIME-Version: 1.0\r\n";
$_MailHeaders .= "Content-Type: text/html; charset=EUC-KR\r\n";
/* 메일관련 끝*/

$google_shortner_api_key = "AIzaSyD_II7obhxkaX_Hyk50VBhB90fuIpyvfgQ";	//withsystem2012 구글계정
$Kakao_api_key = "7dfbfd77e3a221896319f3091dbc5806";	//kakao Javascript 키	*개인계정 키입니다. 펜션톡계정 키 변경 필요*
$Kakao_api_key_m = "f5c6ea670cd47353cb7ee5616a7ac58c";	//kakao Javascript 키	*개인계정 키입니다. 펜션톡계정 키 변경 필요*

$susin_yn_arr = array();

$susin_yn_arr["Y"] = "수신허용";
$susin_yn_arr["N"] = "수신거부";

$use_yn_arr["Y"] = "사용함";
$use_yn_arr["N"] = "사용안함";

$gender_mw_arr["M"] = "남자";
$gender_mw_arr["W"] = "여자";

$gubun_ic_arr["company"] = "기업";
$gubun_ic_arr["invite"] = "초빙";

$BOARD_ARR[0][0] = "notice";
$BOARD_ARR[0][1] = "새소식";
$BOARD_ARR[0][2] = "left_board.php";
$BOARD_ARR[0][3] = "/_images/sub/ti07_01.gif";

$BOARD_ARR[1][0] = "free";
$BOARD_ARR[1][1] = "이야기방";
$BOARD_ARR[1][2] = "left_board.php";
$BOARD_ARR[1][3] = "/_images/sub/ti07_02.gif";

$BOARD_ARR[2][0] = "data";
$BOARD_ARR[2][1] = "연구자료";
$BOARD_ARR[2][2] = "left_board.php";
$BOARD_ARR[2][3] = "/_images/sub/ti07_03_01.gif";

$BOARD_ARR[3][0] = "menual";
$BOARD_ARR[3][1] = "재배메뉴얼";
$BOARD_ARR[3][2] = "left_board.php";
$BOARD_ARR[3][3] = "/_images/sub/ti07_03_02.gif";

$UPLOAD_BOARD    = $RootDIR."/_upload";
$UPLOAD_LINK	 = "/_upload";

$csv_arr[0]	= "이름";
$csv_arr[1]	= "기수";
$csv_arr[2]	= "핸드폰번호";
$csv_arr[3]	= "직장명";
$csv_arr[4]	= "거주지";
$csv_arr[5]	= "근무지";

//관리자 모드 파일 업로드 시
$img_title_array = array();
$img_title_array[gallery]	  = "리스트 이미지";
$img_title_array[movie]     = "리스트 이미지";

$apply_gubun= array();
$apply_gubun_arr["T"]="팀";
$apply_gubun_arr["P"]="개인";

$apply_team_kind_arr    = array();
$apply_team_kind_arr["student"]="학생부";
$apply_team_kind_arr["normal"]="일반부";


$examiner_gubun_arr= array();
$examiner_gubun_arr["company"]="기업";
$examiner_gubun_arr["invite"]="초빙";

$apply_status_arr= array();
$apply_status_arr["apply"]="신청접수";
$apply_status_arr["accept"]="작품접수완료";
$apply_status_arr["preliminary_n"]="예선탈락";
$apply_status_arr["preliminary_y"]="예선통과";


$_BOARD = array();
$_BOARD[notice]   = "공지사항";
$_BOARD[data]     = "자료실";
$_BOARD[qna]     = "QnA";
$_BOARD[gallery]      = "갤러리";
$_BOARD[movie] = "동영상게시판";
$_BOARD[faq] = "자주묻는질문";
$_BOARD[news] = "뉴스";

$_CERTIF = array();
$_CERTIF['country']="국내인증";
$_CERTIF['global']="국제인증";

$_COMM_BOARD_ID = array();
$_COMM_BOARD_ID[] = "memo";

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
$_EMAIL[] = "hitel.net";
$_EMAIL[] = "hotmail.com";
$_EMAIL[] = "korea.com";
$_EMAIL[] = "lycos.co.kr";
$_EMAIL[] = "nate.com";
$_EMAIL[] = "netian.com";
$_EMAIL[] = "paran.com";
$_EMAIL[] = "yahoo.com";
$_EMAIL[] = "yahoo.co.kr";

//2009-06-01 추가
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
$_PHONE[] = "061";
$_PHONE[] = "070";

//2009-06-01 추가
$_MOBILE = array();
$_MOBILE[] = "010";
$_MOBILE[] = "011";
$_MOBILE[] = "016";
$_MOBILE[] = "017";
$_MOBILE[] = "018";
$_MOBILE[] = "019";

//동덕여대 주요사이트
$_IMPORTANT_SITE = array();
#$_IMPORTANT_SITE["http://www.naver.com"] = "네이버";
#$_IMPORTANT_SITE["http://www.nate.com"] = "네이트";
#$_IMPORTANT_SITE["http://www.withsystem.com"] = "위드시스템";


//동문회 소식
$dongmoon = array();
$dongmoon["class_news"] = "동문회 소식";
$dongmoon["main_event_1"] = "행사공지";
$dongmoon["main_event_2"] = "행사후기";
$dongmoon["mentoring"] = "멘토링 사업";

//관리자 동문회 소식
$dongmoon_admin = array();
$dongmoon_admin["class_news"] = "[동문회 소식]&nbsp;&nbsp;";
$dongmoon_admin["main_event_1"] = "[행사공지]&nbsp;&nbsp;";
$dongmoon_admin["main_event_2"] = "[행사후기]&nbsp;&nbsp;";
$dongmoon_admin["mentoring"] = "[멘토링 사업]&nbsp;&nbsp;";

//동문근황


$category_kor = array();
$category_kor["1"] = "전직/이직";
$category_kor["2"] = "승진/전근";
$category_kor["3"] = "결혼";
$category_kor["4"] = "와병/입원";
$category_kor["5"] = "부고";
$category_kor["6"] = "수상/출간";
$category_kor["8"] = "알림";
$category_kor["10"] = "개업/창업";


//비지니스

$catagory_business = array();
$catagory_business["sell"] = "팝니다";
$catagory_business["buy"] = "삽니다";
$catagory_business["people"] = "구인";
$catagory_business["job"] = "구직";
$catagory_business["information"] = "정보";
$catagory_business["request"] = "문의";



// 앱 OS  - 진우석
$_APP_OS = array();
$_APP_OS[android] = "A";
$_APP_OS[ios] = "I";

?>
