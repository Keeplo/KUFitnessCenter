<?

$SITE_TITLE = "�������ѵ���ȸ";
$SITE_URL	= "http://www.ganggo.org";
$SITE_M_URL	= "http://m.ganggo.org";


// 2017-02-10 �̱���
$IOS_NEW_APP_VERSION = "1.3";
$ANDROID_NEW_APP_VERSION = "1.1";



$SITE_EMAIL	= "";
$EMAIL_YN   = "http://wwww.bcskorea.com/member/modify.php";

$ADMIN_SMS_NUM   = "0415626265";

// �켮 ����2012 ���� ���̾�̽� Ű
$server_push_key = "AAAAh-u2Gb8:APA91bEz6ukFiUXBMyB-0vB2cd_moVDPn2U9JFAKLDm5HvOLAwFftWxGLRRUXTzeacXHyM38tBG7ln-XzxRgRVUbQS3FqgSDhutb7GtED2vlF-b1h9vna-Irfyumo16_qhI4rGWKJspi";
//$server_push_key = "AIzaSyBB-xuruEh2alUq-Y4hm3OfTuYxs3BgNEM";

$ADMIN_SITE_TITLE = "������ �� ����ȸ - ������";

//$BODY_CONTENT = "oncontextmenu=\"alert(contextmenu_message);return false;\" ondragstart=\"return false\" onselectstart=\"return false\"";
$BODY_CONTEXT = "";

$ADMIN_IMG_DIR = "/admin/_img/comm/";
$IMG_DIR = "/_img";

$upload_folder = "/home/ganggo/public_html/_upload/";

$_NOIMAGE_B = "/_img/sub/prod_noimgb.gif";
$_NOIMAGE_S = "/_img/sub/prod_noimgs.gif";

// ��ǰ�̹���
$SHOP_IMG_DIR = "/shopimage";
//���ο�Խù� �Ⱓ
$TERM = 4;

/* ���ϰ��� ����*/
$_MailHeaders  = "From: ".$SITE_TITLE."<$SITE_EMAIL>\r\n";
$_MailHeaders .= "Reply-To: $SITE_TITLE\r\n";
$_MailHeaders .= "X-Mailer: PHP ".phpversion()."\r\n";
//$_MailHeaders .= "X-Priority: 1\r\n";
$_MailHeaders .= "MIME-Version: 1.0\r\n";
$_MailHeaders .= "Content-Type: text/html; charset=EUC-KR\r\n";
/* ���ϰ��� ��*/

$google_shortner_api_key = "AIzaSyD_II7obhxkaX_Hyk50VBhB90fuIpyvfgQ";	//withsystem2012 ���۰���
$Kakao_api_key = "7dfbfd77e3a221896319f3091dbc5806";	//kakao Javascript Ű	*���ΰ��� Ű�Դϴ�. �������� Ű ���� �ʿ�*
$Kakao_api_key_m = "f5c6ea670cd47353cb7ee5616a7ac58c";	//kakao Javascript Ű	*���ΰ��� Ű�Դϴ�. �������� Ű ���� �ʿ�*

$susin_yn_arr = array();

$susin_yn_arr["Y"] = "�������";
$susin_yn_arr["N"] = "���Űź�";

$use_yn_arr["Y"] = "�����";
$use_yn_arr["N"] = "������";

$gender_mw_arr["M"] = "����";
$gender_mw_arr["W"] = "����";

$gubun_ic_arr["company"] = "���";
$gubun_ic_arr["invite"] = "�ʺ�";

$BOARD_ARR[0][0] = "notice";
$BOARD_ARR[0][1] = "���ҽ�";
$BOARD_ARR[0][2] = "left_board.php";
$BOARD_ARR[0][3] = "/_images/sub/ti07_01.gif";

$BOARD_ARR[1][0] = "free";
$BOARD_ARR[1][1] = "�̾߱��";
$BOARD_ARR[1][2] = "left_board.php";
$BOARD_ARR[1][3] = "/_images/sub/ti07_02.gif";

$BOARD_ARR[2][0] = "data";
$BOARD_ARR[2][1] = "�����ڷ�";
$BOARD_ARR[2][2] = "left_board.php";
$BOARD_ARR[2][3] = "/_images/sub/ti07_03_01.gif";

$BOARD_ARR[3][0] = "menual";
$BOARD_ARR[3][1] = "���޴���";
$BOARD_ARR[3][2] = "left_board.php";
$BOARD_ARR[3][3] = "/_images/sub/ti07_03_02.gif";

$UPLOAD_BOARD    = $RootDIR."/_upload";
$UPLOAD_LINK	 = "/_upload";

$csv_arr[0]	= "�̸�";
$csv_arr[1]	= "���";
$csv_arr[2]	= "�ڵ�����ȣ";
$csv_arr[3]	= "�����";
$csv_arr[4]	= "������";
$csv_arr[5]	= "�ٹ���";

//������ ��� ���� ���ε� ��
$img_title_array = array();
$img_title_array[gallery]	  = "����Ʈ �̹���";
$img_title_array[movie]     = "����Ʈ �̹���";

$apply_gubun= array();
$apply_gubun_arr["T"]="��";
$apply_gubun_arr["P"]="����";

$apply_team_kind_arr    = array();
$apply_team_kind_arr["student"]="�л���";
$apply_team_kind_arr["normal"]="�Ϲݺ�";


$examiner_gubun_arr= array();
$examiner_gubun_arr["company"]="���";
$examiner_gubun_arr["invite"]="�ʺ�";

$apply_status_arr= array();
$apply_status_arr["apply"]="��û����";
$apply_status_arr["accept"]="��ǰ�����Ϸ�";
$apply_status_arr["preliminary_n"]="����Ż��";
$apply_status_arr["preliminary_y"]="�������";


$_BOARD = array();
$_BOARD[notice]   = "��������";
$_BOARD[data]     = "�ڷ��";
$_BOARD[qna]     = "QnA";
$_BOARD[gallery]      = "������";
$_BOARD[movie] = "������Խ���";
$_BOARD[faq] = "���ֹ�������";
$_BOARD[news] = "����";

$_CERTIF = array();
$_CERTIF['country']="��������";
$_CERTIF['global']="��������";

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

//2009-06-01 �߰�
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

//2009-06-01 �߰�
$_MOBILE = array();
$_MOBILE[] = "010";
$_MOBILE[] = "011";
$_MOBILE[] = "016";
$_MOBILE[] = "017";
$_MOBILE[] = "018";
$_MOBILE[] = "019";

//�������� �ֿ����Ʈ
$_IMPORTANT_SITE = array();
#$_IMPORTANT_SITE["http://www.naver.com"] = "���̹�";
#$_IMPORTANT_SITE["http://www.nate.com"] = "����Ʈ";
#$_IMPORTANT_SITE["http://www.withsystem.com"] = "����ý���";


//����ȸ �ҽ�
$dongmoon = array();
$dongmoon["class_news"] = "����ȸ �ҽ�";
$dongmoon["main_event_1"] = "������";
$dongmoon["main_event_2"] = "����ı�";
$dongmoon["mentoring"] = "���丵 ���";

//������ ����ȸ �ҽ�
$dongmoon_admin = array();
$dongmoon_admin["class_news"] = "[����ȸ �ҽ�]&nbsp;&nbsp;";
$dongmoon_admin["main_event_1"] = "[������]&nbsp;&nbsp;";
$dongmoon_admin["main_event_2"] = "[����ı�]&nbsp;&nbsp;";
$dongmoon_admin["mentoring"] = "[���丵 ���]&nbsp;&nbsp;";

//������Ȳ


$category_kor = array();
$category_kor["1"] = "����/����";
$category_kor["2"] = "����/����";
$category_kor["3"] = "��ȥ";
$category_kor["4"] = "�ͺ�/�Կ�";
$category_kor["5"] = "�ΰ�";
$category_kor["6"] = "����/�Ⱓ";
$category_kor["8"] = "�˸�";
$category_kor["10"] = "����/â��";


//�����Ͻ�

$catagory_business = array();
$catagory_business["sell"] = "�˴ϴ�";
$catagory_business["buy"] = "��ϴ�";
$catagory_business["people"] = "����";
$catagory_business["job"] = "����";
$catagory_business["information"] = "����";
$catagory_business["request"] = "����";



// �� OS  - ���켮
$_APP_OS = array();
$_APP_OS[android] = "A";
$_APP_OS[ios] = "I";

?>
