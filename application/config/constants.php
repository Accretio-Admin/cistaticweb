<?php
defined('BASEPATH') OR exit('No direct script access allowed');
function sign($message, $key) {
    return hash_hmac('sha256', $message, $key) . $message;
}

function verify($bundle, $key) {
    return hash_equals(
      hash_hmac('sha256', mb_substr($bundle, 64, null, '8bit'), $key),
      mb_substr($bundle, 0, 64, '8bit')
    );
}

function getKey($password, $keysize = 16) {
    return hash_pbkdf2('sha256',$password,'some_token',100000,$keysize,true);
}

function encrypt($message, $password) {
    $iv = random_bytes(16);
    $key = getKey($password);
    $result = sign(openssl_encrypt($message,'aes-256-ctr',$key,OPENSSL_RAW_DATA,$iv), $key);
    return bin2hex($iv).bin2hex($result);
}

function decrypt($hash, $password) {
    $iv = hex2bin(substr($hash, 0, 32));
    $data = hex2bin(substr($hash, 32));
    $key = getKey($password);
    if (!verify($data, $key)) {
      return null;
    }
    return openssl_decrypt(mb_substr($data, 64, null, '8bit'),'aes-256-ctr',$key,OPENSSL_RAW_DATA,$iv);
}
/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
define('FOPEN_READ', 'rb');
define('FOPEN_READ_WRITE', 'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE', 'ab');
define('FOPEN_READ_WRITE_CREATE', 'a+b');
define('FOPEN_WRITE_CREATE_STRICT', 'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
define('EXIT_SUCCESS', 0); // no errors
define('EXIT_ERROR', 1); // generic error
define('EXIT_CONFIG', 3); // configuration error
define('EXIT_UNKNOWN_FILE', 4); // file not found
define('EXIT_UNKNOWN_CLASS', 5); // unknown class
define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
define('EXIT_USER_INPUT', 7); // invalid user input
define('EXIT_DATABASE', 8); // database error
define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

// define('url','https://thirdy.globalpinoyremittance.com/webportal');
///API

//FundRequest FTP Credentials
define('ftp_server','103.16.170.114');	//define('ftp_server','210.213.236.42');
define('ftp_server_radius','103.16.170.114');
define('ftp_port','800');
define('ftp_user_name','argel');
define('ftp_user_pass','argel_argel!!!');
define('destination_file','/Fund_Request/');
define('_ftp_url','ftp://frequest:frequest@10.10.1.252:800/Fund_Request/');

//define('ftp_server','35.186.159.201');
//define('ftp_port','21');
//define('ftp_user_name','fundrequest');
//define('ftp_user_pass','fundrequest!@#');
//define('_ftp_url','ftp://frequest:frequest@35.186.159.201:21/');

define('KB', 1024);
define('MB', 1048576);
define('GB', 1073741824);
define('TB', 1099511627776);



//API
define('api_token',decrypt(getenv('api_token'),getenv('password')));
define('APPID',decrypt(getenv('APPID'),getenv('password'))); //app_id
define('APPVER',getenv('APPVER')); //appver
define('PLATFORM',getenv('PLATFORM'));//platform 
define('FLAG',getenv('FLAG'));//flag 

	// -- verify device
define('_verify_device', 'verify_device');
	// --end
// define('api_url','http://52.74.212.148/');
$SANDBOX_MODE = false;

if($SANDBOX_MODE){
	define('url_mobilereports','https://mobilereports.globalpinoyremittance.com/portal');	
	define('url','http://10.10.10.29:8001/webportal');
	//define('url','http://172.16.16.10:8008/webportal');
}else{
	define('url_mobilereports','https://mobilereports.globalpinoyremittance.com/portal');	
	// define('url','https://unifiedpubsub.azurewebsites.net/webportal_dev?op=pa');
	define('url','https://unifiedpubsub.azurewebsites.net/webportal?op=pa');
	// define('url','https://mobileapi.unified.ph//webportal?op=pa');
	define('url_old','https://unifiedpubsub.azurewebsites.net/webportal');
	define('sso_url', 'http://sso.bentanayan.com');
	define('sso_client_id','1901286');
	define('sso_client_secret','abcVDspEyxyeObZVttpBu7ka1aaqa5cpFBbHDlb7');
}

define('_login','ups_login');
define('_forgot','ups_login/forgot_login_password');
define('_registration','ups_registration_service/dealer_register');
define('_check_mobile_number','ups_registration_service/check_mobile_number');
define('_verify_mobile_number','ups_registration_service/verify_mobile_number');
define('_check_email','ups_registration_service/check_email_address');
define('_verify_email','ups_registration_service/verify_email_address');

//added by yaj 12/07/2017
define('_change_email','ups_login/change_email');
define('_change_email_verify','ups_login/change_email_verify');
define('_change_email_resend','ups_login/change_email_resend');

define('_change_mobile','ups_login/change_mobile');
define('_change_mobile_verify','ups_login/change_mobile_verify');
define('_change_mobile_resend','ups_login/change_mobile_resend');

define('_change_trans_password','ups_login/change_transaction_password2');
define('_change_login_password','ups_login/change_login_password2');

define('_forgot_trans_password','ups_login/forgot_transaction_password');

define('_create_supervisor_password','supervisorpass/createSupervisorPass');
define('_forgot_supervisor_password','supervisorpass/forgotSvpass');

define('_verify_accountupload_confirm','ups_login/verify_accountupload_confirm');
define('_check_user_id_verify','ups_login/check_user_id_verify');

define('_auto_quota','ups_login/auto_quota');// For Auto Quota Switch
define('_get_account_link','ups_account_service/get_account_link');

//update by nhez 03/21/2017
//account checking
define('_fetch_userfunds','ups_login/fetch_user_funding');
define('_account_user_priv','ups_account_service/check_user_access');
define('_account_settlement','ups_account_service/get_account_settlements');
define('_fetch_voucher_list','ups_account_service/get_account_vouchers');
define('_confirm_unsettled_account','ups_account_service/pay_unsettled_account');

// FB
define('_social_login','ups_login/social_media_login');
define('_social_registration','ups_login/social_registration');
//Retail
define('_retail_registration','ups_login/retail_registration');

define('_loadfund','ups_ecash_service/ecash_to_loadfund');
define('_sgdfund','ups_ecash_service/ecash_to_singtelfund');
define('_ecashtoecash','ups_ecash_service/ecash_to_ecash');
define('_remittance_search','ups_ecash_service/remittance_search_user');
define('_remittance_search_bsp','ups_ecash_service/remittance_search_user_bsp');
define('_remittance_search_bene_bsp','ups_ecash_service/remittance_selected_beneficiary_bsp');
define('_ecashtosmartmoney','ups_ecash_service/remittance_send_smartmoney_v2'); //new rates 07/31/2017
// define('_ecashtosmartmoney','ups_ecash_service/remittance_send_smartmoney');
//define('_ecashtosmartmoney','ups_paymaya_service/remittance_send_smartmoney');
define('_ecashtopaymaya','ups_ecash_service/ecash_to_paymaya'); //paymaya

define('_remittance_add_user','ups_ecash_service/remittance_add_user');
define('_remittance_add_user_bsp','ups_ecash_service/remittance_add_user_bsp');
define('_remittance_add_bene_bsp','ups_ecash_service/remittance_add_beneficiary_bsp');
define('_remittance_send_ecash_padala','ups_ecash_service/remittance_send_ecash_padala');
define('_remittance_send_ecash_padala_confirm','ups_ecash_service/remittance_send_ecash_padala_confirm');
define('_remittance_send_credit_bank','ups_ecash_service/remittance_send_credit_bank');
define('_remittance_send_credit_bank_confirm','ups_ecash_service/remittance_send_credit_bank_confirm');
define('_remittance_send_credit_bank_confirm_new','ups_ecash_service/remittance_send_credit_bank_confirm_new');
define('_remittance_search_cashcard_user','ups_ecash_service/remittance_search_cashcard_user');
define('_remittance_cashcard_confirm','ups_ecash_service/remittance_cashcard_confirm');
define('_remittance_cashcard_otp','ups_ecash_service/unhold_remittance_cashcard_service');
define('_remittance_cashcard_otp_resend','ups_ecash_service/remittance_cashcard_resend');
define('_remittance_send_smartmoney_confirm','ups_ecash_service/remittance_send_smartmoney_confirm_v2'); //new rates 07/31/2017
// define('_remittance_send_smartmoney_confirm','ups_ecash_service/remittance_send_smartmoney_confirm');
define('_remittance_send_smartmoney_confirm_activation','ups_ecash_service/function_unhold_smartmoney_v2'); //new rates 07/31/2017
// define('_remittance_send_smartmoney_confirm_activation','ups_ecash_service/function_unhold_smartmoney');
//define('_remittance_send_smartmoney_confirm','ups_paymaya_service/remittance_send_smartmoney_confirm');
//define('_remittance_send_smartmoney_confirm_activation','ups_paymaya_service/function_unhold_smartmoney');
define('_remittance_send_smartmoney_checkref','ups_ecash_service/smartmoney_check_ref');
//define('_remittance_send_smartmoney_checkref','ups_paymaya_service/smartmoney_check_ref');
//define('_smartmoney_otp_resend','ups_paymaya_service/smartmoney_otp_resend');

//UPGRADE
define('_upgrade_check_accountType','ups_upgrade/accountType');
define('_upgrade_fetch_upgradeDetails','ups_upgrade/upgradeDetails');
define('_upgrade_fetch_upgradePrice','ups_upgrade/fetch_packagePrice');
define('_transact_upgrade','ups_upgrade/upgrade_send'); 


//BAREMI
define('_baremi_check_remittance_charge','ups_baremi_service/check_remittance_charge');
define('_baremi_send_remittance','ups_baremi_service/send_remittance');
define('_baremi_otp_resend','ups_baremi_service/baremi_otp_resend');
define('_baremi_confirm_activation','ups_baremi_service/function_unhold_baremi');
define('_baremi_check_ref','ups_baremi_service/baremi_check_ref');
define('_baremi_payout_checkref','ups_baremi_service/payout_checkref'); //nes added 08/09/2017
define('_baremi_payout','ups_baremi_service/payout_remittance'); //nes added 08/09/2017
define('_baremi_cancel','ups_baremi_service/cancel_transfer'); //nes added 08/22/2017




define('_remittance_send_gcash_cashin_confirm_activation','ups_gcash_service/function_unhold_gcash_cico');
define('_remittance_send_gcash_cashin','ups_gcash_service/remittance_send_gcashcashin');
define('_remittance_send_gcash_cashin_confirm','ups_gcash_service/remittance_send_gcash_cico_confirm');

define('_fetch_loading_status','ups_airtime_loading/fetch_loading_status');
define('_fetch_smartmoney_status','ups_airtime_loading/fetch_smartmoney_status');
define('_rsloading','ups_airtime_loading/rsloading');
define('_fetch_special_plancodes','ups_airtime_loading/fetch_special_plancodes');
define('_fetch_prepaid_card','ups_airtime_loading/fetch_prepaid_card');
// define('_lccard_loading','ups_airtime_loading/lccard_loading'); LIVE
define('_lccard_loading','ups_airtime_loading/lccard_loading_v2'); //with prepaid inventory
define('_singtel_loading','ups_airtime_loading/singtel_loading');
define('_etisalat_loading_validation','ups_airtime_loading/etisalat_loading_validation');
define('_etisalat_loading_confirmation','ups_airtime_loading/etisalat_loading_confirmation');
define('_universal_loading','ups_airtime_loading/universal_loading');
define('_fund_request','ups_funding_service/fund_request');
define('_fetch_user_info','ups_login/fetch_user_info'); //fetch regcode
define('_aed_fund_request','ups_funding_service/aed_fundrequest'); //aed fund
define('_DP_fund_request','ups_funding_service/fundrequestdp'); //dp fund
define('_DP_fund_request_upd','ups_funding_service/fundrequestdp_upd'); //dp fund
define('_DP_update_stat','ups_funding_service/DP_update_stat'); //dp fund
// added by rene for paymaya
define('_fetch_available_ids','ups_ecash_payout/fetch_available_ids');

define('_fetch_primary_ids','ups_ecash_payout/fetch_primary_ids');

define('_fetch_biller_info','ups_billspay_service/fetch_biller_lists');
define('_fetch_biller_info_web','ups_billspay_service/fetch_biller_lists_web');
define('FETCH_BILLER_INFO_WEB','ups_billspay_service/fetch_biller_lists_web');
define('FETCH_BILLER_INFO_WEB_BY_CATEGORY','ups_billspay_service/fetch_biller_lists_web_by_category');
// define('_fetch_biller_info','ups_billspay_service/fetch_biller_list_test');  // testing for gcash

define('_post_biller','ups_billspay_service');
define('FETCH_BILLER_FIELDS','ups_billspay_service/fetch_biller_fields');
// define('_post_biller','ups_billspay_service2'); // testing for gcash
define('_batelec_checkaccount','ups_billspay_service/batelec_checkaccount'); // batelec_checkaccountnumber

//REMITTANCE PAYOUT
define('_payout_smartmoney_check','ups_ecash_payout/remittance_smartmoney_payout_checkref');
// define('_payout_smartmoney_confirm','ups_ecash_payout/remittance_smartmoney_payout_confirm');
// define('_payout_smartmoney_confirm','ups_ecash_payout/remittance_smartmoney_payout_confirm_v2'); //new rates 07/31/2017
define('_payout_smartmoney_confirm','ups_ecash_payout/remittance_smartmoney_payout_confirm_latest'); //new url  03/11/2019
define('_payout_ecashpadala_check','ups_ecash_payout/remittance_ecash_padala_payout_checkref');
// define('_payout_ecashpadala_confirm','ups_ecash_payout/remittance_ecash_padala_payout_confirm');
// define('_payout_ecashpadala_confirm2','ups_ecash_payout/remittance_ecash_padala_payout_confirm2'); // 11/27/17 ecashpayout with ID
define('_payout_ecashpadala_confirm2','ups_ecash_payout/remittance_ecash_padala_payout_confirm_latest'); // 11/03/17 with checking loan
define('_payout_iremit_check','ups_ecash_payout/remittance_iremit_payout_checkref2');
define('_payout_iremit_check_own_payout','ups_ecash_payout_own_payout/remittance_iremit_payout_checkref2');
// define('_payout_iremit_confirm','ups_ecash_payout/remittance_iremit_payout_confirm2');
// define('_payout_iremit_confirm2','ups_ecash_payout/remittance_iremit_payout_confirm3'); // 11/27/17 ecashpayout with ID
define('_payout_iremit_confirm','ups_ecash_payout/remittance_iremit_payout_confirm_latest');	//03/11/2019 new url
define('_payout_iremit_confirm2','ups_ecash_payout/remittance_iremit_payout_confirm_latest'); //03/11/2019 new url
define('_payout_transfast_nyb_check','ups_ecash_payout/remittance_transfast_nyb_payout_checkref');
// define('_payout_transfast_nyb_check_new','ups_ecash_payout/remittance_transfast_nyb_payout_checkref_new');
define('_url_payout_transfast_nyb_check_new','ups_ecash_payout/remittance_transfast_nyb_payout_checkref_new');
define('_url_payout_transfast_fetch_ids','ups_ecash_payout/fetch_transfast_validId'); 
define('_url_payout_transfast_fetch_country','ups_ecash_payout/fetch_transfast_Countries'); 
define('_url_payout_transfast_fetch_states','ups_ecash_payout/fetch_transfast_States'); 
define('_url_payout_transfast_fetch_cities','ups_ecash_payout/fetch_transfast_Cities'); 
define('_url_payout_transfast_fetch_remitPurpose','ups_ecash_payout/fetch_transfast_RemitPurpose'); 
define('_url_payout_transfast_fetch_occupation','ups_ecash_payout/fetch_transfast_BeneOccupation');
define('_fetch_remitpayout_secondary_ids','ups_ecash_payout/fetch_available_secondary_ids'); 
define('_url_payout_transfast_nyb_payinvoice_new','ups_ecash_payout/remittance_transfast_nyb_payout_invoice');
define('_payout_transfast_nyb_check_own_payout','ups_ecash_payout_own_payout/remittance_transfast_nyb_payout_checkref_new');
// define('_payout_transfast_nyb_confirm','ups_ecash_payout/remittance_transfast_nyb_payout_confirm');	
// define('_payout_transfast_nyb_confirm','ups_ecash_payout/remittance_transfast_nyb_payout_confirm2'); // 11/27/17 ecashpayout with ID
define('_payout_transfast_nyb_confirm','ups_ecash_payout/remittance_transfast_nyb_payout_latest'); // 03/11/19 new url
// define('_fetch_available_remitpayout_ids','ups_ecash_payout/fetch_available_remitpayout_ids');
define('_fetch_available_remitpayout_ids','ups_ecash_payout/fetch_available_remitpayout_ids');
define('_create_remitpayout_id','ups_ecash_payout/create_remitpayout_id2');
// define('_create_remitpayout_id_local','ups_ecash_payout/create_remitpayout_id2');
define('_update_remitpayout_id','ups_ecash_payout/update_remitpayout_id2');
define('_fetch_remitpayout_id_types','ups_ecash_payout/fetch_remitpayout_id_types');
//083017 TOA agreement ecash payout -yaj
define('_payout_check_user_agreement','ups_ecash_payout/check_user_agreement');
define('_payout_agree_user_agreement','ups_ecash_payout/agree_user_agreement');


define('_payout_moneygram_check','ups_ecash_payout/remittance_moneygram_payout');
define('_payout_moneygram_confirm','ups_ecash_payout/remittance_moneygram_new_payout_confirm');
define('_fetch_countries','ups_ecash_payout/remittance_countries');

define('_payout_placid_check','ups_ecash_payout/remittance_placid_payout');
define('_payout_placid_confirm','ups_ecash_payout/remittance_placid_payout_confirm');
//TICKETING DOMESTIC
define('_search_domestic_flights','ups_ticketing_service/search_domestic_flights');	
define('_choose_domestic_flights','ups_ticketing_service/pricing_rates_request');	
define('_fetch_mark_up','ups_ticketing_service/fetch_markup');	
define('_update_mark_up','ups_ticketing_service/update_markup');	
define('_domestic_booking_request','ups_ticketing_service/domestic_booking_request');	
define('_domestic_booking_transactions','ups_ticketing_service/domestic_booking_transactions');


//TICKETING INTERNATIONAL
define('_search_international_flights','ups_ticketing_service/search_international_flights');	
define('_choose_international_flights','ups_ticketing_service/pricing_rates_request');
define('_international_booking_request','ups_ticketing_service/intl_booking_request');	
define('_international_booking_transactions','ups_ticketing_service/intl_booking_transactions');
define('_international_update_transaction','ups_ticketing_service/intl_update_transaction');


//NETWORKING

define('_get_direct_referral','ups_network_service/direct_referral');		
define('_get_indirect_referral','ups_network_service/indirect_referral');	
define('_get_high5_report','ups_network_service/highfive');	
define('_get_network_summary','ups_network_service/network_summary');	
define('_get_weekly_payout','ups_network_service/weekly_payout');	
define('_get_payout_history','ups_network_service/payout_history');
define('_get_right_downlines','ups_network_service/right_downlines');	
define('_get_left_downlines','ups_network_service/left_downlines');	
define('_get_network_income','ups_network_service/network_income');	
define('_get_network_income_convert','ups_network_service/network_income_convert');
define('_get_network_genealogy','ups_network_service/network_genealogy');	

//NETWORKING

//REPORT 
define('_general_report','ups_report_service/general_report');
define('_ecash_remittance_report','ups_report_service/ecash_remittance_report');
define('_ecash_cashcard','ups_report_service/cashcard_report');
define('_ecash_payout_report','ups_report_service/ecash_payout_report');
define('_get_foreign_exchange_rate','ups_ecash_service/get_foreign_exchange_rate');
define('_ecash_to_forextrade','ups_ecash_service/ecash_to_forextrade');
define('_ecash_to_forextrade_new','ups_ecash_service/ecash_to_forextrade_new');
define('_ecash_to_forextrade_confirm','ups_ecash_service/ecash_to_forextrade_confirm');
define('_ecash_to_forextrade_confirm_new','ups_ecash_service/ecash_to_forextrade_confirm_new');
define('_fetch_pending_remitpayout_ids','ups_ecash_payout/fetch_pending_remitpayout_ids');
define('_fetch_approved_remitpayout_ids','ups_ecash_payout/fetch_approved_remitpayout_ids');
define('_fetch_revoked_remitpayout_ids','ups_ecash_payout/fetch_revoked_remitpayout_ids');
define('_ecash_padala_report','ups_report_service/ecash_padala_report'); //old connection
define('_cebuana_report_v2','ups_report_service/cebuana_report_v2');
define('_ecash_padala_payout_report','ups_report_service/ecash_padala_payout_report'); //new connection
define('_billspayment_report','ups_report_service/billspayment_report');
define('_view_cards','ups_report_service/view_cards');
define('_universal','ups_report_service/universal');
define('_airtime_transaction_current','ups_report_service/airtime_transaction_current');
define('_airtime_transaction_old','ups_report_service/airtime_transaction_old');
define('_airtime_current','ups_report_service/airtime_current');
define('_airtime_old','ups_report_service/airtime_old');
define('_malayan_report','ups_report_service/malayan_report');
define('_cptl_report','ups_fpg_ctpl/get_ctpl_transactions');
define('_western_union_report','ups_report_service/wester_union_report');

define('_forextransfer_to_ecash_confirm','ups_ecash_service/forextransfer_to_ecash_confirm');

//REPORT

// CURRENT ETISALAT REPORT
define('_etisalat_current','ups_report_service/etisalat_current');

//MLM REPORT
define('_mlm_ups_last10_report','ups_report_service/mlm_ups_last10_report');
define('_mlm_ups_report','ups_report_service/mlm_ups_report');
define('_mlm_hub_last10_report','ups_report_service/mlm_hub_last10_report');
define('_mlm_hub_report','ups_report_service/mlm_hub_report');

//MLM NETWORK INCOME and REPORT
define('_get_network_MLMincome_convert','ups_network_service/network_MLMincome_convert');
define('_get_network_MLM_income','ups_network_service/network_MLM_income');
define('_get_mlmincome_summary','ups_network_service/mlmincome_summary');
define('_get_mlmincome_rebates','ups_network_service/mlmincome_rebates');
define('_get_mlmincome_leadership','ups_network_service/mlmincome_leadership');
define('_get_mlmincome_points','ups_network_service/mlmincome_points');
define('_get_mlmincome_personal_sales','ups_network_service/mlmincome_personal_sales');
define('_mlm_income_summary_report','ups_network_service/mlm_income_summary_report');
define('_mlm_rebates_report','ups_network_service/mlm_rebates_report');
define('_mlm_leadership_bonus_report','ups_network_service/mlm_leadership_bonus_report');
define('_mlm_points_report','ups_network_service/mlm_points_report');
define('_mlm_personal_sales_report','ups_network_service/mlm_personal_sales_report');



//FUND
define('_fetch_user_funding','ups_login/fetch_user_funding');
define('_insurance','ups_insurance_service/malayan_insurance');
define('_insurance_test','ups_test_service/malayan_insurance');
//FUND

//online shop//
define("_get_upgrade_price",'ups_account_service/get_upgrade_price');
define("_upgrade_account",'ups_account_service/upgrade_account');
define("_fetch_buycodes_rate",'ups_buycodes/fetch_buycodes_rate');
define("_fetch_buycodes_rate_new",'ups_buycodes/fetch_buycodes_rate_new');
define("_confirm_buycodes",'ups_account_service/confirm_buycodes');
define("_generate_tracking_buycodes",'ups_account_service/generate_tracking_online_buycodes');
define("_request_buycodes_purchase",'ups_buycodes/request_buycodes_purchase');
define("_fetch_top_products",'ups_mlm_test/fetch_top_products');
define("_fetch_product_category",'ups_mlm_test/fetch_product_category');
define('_buycodes_check_user_agreement','ups_buycodes/check_user_agreement');
define('_buycodes_agree_user_agreement','ups_buycodes/agree_user_agreement');
define('_buycodes_gettransactions','ups_buycodes/buykits_transaction_records'); //new connection
define('_new_buycodes_fetch_packages','ups_buycodes/fetch_ups_packages');//newbuycodes
define('_new_buycodes_fetch_packages_variants','ups_buycodes/fetch_ups_packages_variant');//newbuycodes
define('_new_buycodes_validate_transaction','ups_buycodes/buycodes_validate');//newbuycodes
define('_new_buycodes_transaction','ups_buycodes/buycodes_transaction');//newbuycodes
define('_new_buycodes_get_transaction','ups_buycodes/new_buycodes_get_transaction');//newbuycodes
define('_new_buycodes_get_regcode_listing','ups_buycodes/new_buycodes_regcode_listing');//newbuycodes
define('_new_shared_email','ups_buycodes/share_retailer_regcode');//newbuycodes
//online shop//


//MLM
define("_fetch_product_list",'ups_mlm_test/fetch_product_list');
define("_add_product",'ups_mlm_test/add_product');
define("_edit_product",'ups_mlm_test/edit_product');
define("_fetch_quota",'ups_mlm_test/fetch_quota');
define("_edit_quota",'ups_mlm_test/edit_quota');
define("_fetch_package_currency",'ups_mlm_test/fetch_package_currency');
define("_edit_package_currency",'ups_mlm_test/edit_package_currency');
define("_fetch_gc",'ups_mlm_test/fetch_gc');
define("_generate_gc",'ups_mlm_test/generate_gc');
define("_search_gc",'ups_mlm_test/gc_search');
define("_fetch_mlm_report",'ups_mlm_test/fetch_mlm_report');
define("_del_product",'ups_mlm_test/del_product');
define("_rating_update",'ups_mlm_test/rating_update');

//mlm account
define("_validate_mlm_user",'ups_mlm_test/validate_mlm_user');

//MLMShop
define("_payout_MLMShop",'ups_mlm_test/mlm_payout');
define("_payout_MLMShop_test",'ups_mlm_test/mlm_payout_test');
define("_get_MLMShop",'ups_mlm_test/mlm_get_purchase');

//MLMShop Location
define("_mlm_province",'ups_mlm_location/MLMProvince');
define("_mlm_city",'ups_mlm_location/MLMCity');

//MLMShipping Rates and Product Weight
define("_mlm_shipping",'ups_mlm_location/ShippingRate');

//inventory
define("_regcode_validate",'ups_inventory_test/validate_regcode');
define("_cart_inventory_validate",'ups_inventory_test/cart_inventory_validate');
define("_cart_validate",'ups_inventory_test/cart_validate');
define("_cart_inventory_confirm",'ups_inventory_test/cart_inventory_confirm');
define("_cart_confirm",'ups_inventory_test/cart_confirm');
define("_hub_inventory_list",'ups_inventory_test/hub_inventory_list');


define('_fetch_biller_infos','ups_billspay_service/fetch_biller_list');
// define('_fetch_biller_infos','ups_billspay_service/fetch_biller_list_test'); // testing for gcash


define('_fetch_creditcard_reload_transactions','ups_funding_service/creditcard_transaction_records');
define('_check_user_agreement','ups_funding_service/check_user_agreement');
define('_agree_user_agreement','ups_funding_service/agree_user_agreement');
define('_check_cc_application','ups_funding_service/check_cc_application');


//DRAGONPAY
define('merchantid_DP','GPRS');
// define('passkey_DP','Hz8X^w@g$'); // comment by rene to apply new dragon pay cred
define('passkey_DP','5TY2bL2BqLD5Rq5'); // added by rene dragonpay new cred

define("_generate_tracking_reload_DP",'ups_funding_service/generate_tracking_online_reload_DP');


define("_generate_tracking_reload",'ups_funding_service/generate_tracking_online_reload');
define("_request_reload_purchase",'ups_funding_service/request_reload_purchase');
define("_requirements_reload_submit",'ups_funding_service/submit_application_requirements');
define("_reapply_requirements",'ups_funding_service/reapplication_requirements');


//ABACUS
define("abacus_search_domestic_flights",'abacus_ticketing_service/search_flights_domestic');
define('abacus_choose_domestic_flights','abacus_ticketing_service/pricing_rates_request');
define('abacus_domestic_booking_request','abacus_ticketing_service/domestic_booking_request');
define('abacus_getmarkup','abacus_ticketing_service/fetch_markup');
define('abacus_updatemarkup','abacus_ticketing_service/update_markup');
define('abacus_fetch_reserved_flights','abacus_ticketing_service/fetch_reserved_flights');
define('abacus_fetch_pnr_details','abacus_ticketing_service/fetch_pnr_details');
define('abacus_issue_ticket_domestic','abacus_ticketing_service/issue_ticket');

define("abacus_search_international_flights",'abacus_ticketing_service/search_flights');
define('abacus_choose_international_flights','abacus_ticketing_service/pricing_rates_request');
define('abacus_international_booking_request','abacus_ticketing_service/domestic_booking_request2');

//FEDERAL CPTL

define("_federal_ctpl_mvlist",'ups_fpg_ctpl/get_fpg_ctpl_mvlist');
define("_federal_ctpl_validate",'ups_fpg_ctpl/validate_registration');
define("_federal_ctpl_register",'ups_fpg_ctpl/register_insured');
define("_fetch_fpg_options",'coc_mobile/get_federal_options');
define("_fetch_voucher_validate",'coc_mobile/validate_voucher');
define("_fetch_fpg_rate",'coc_mobile/get_federal_rate');
define("_fetch_create_coc",'coc_mobile/createCOC');

//ECASH PAYCENTER
define("_fetch_ecashpaycenter",'ups_report_service/ecashpaycenter');

//HKD LOADING
define('_fetch_hkd_denom','ups_airtime_loading_nes/fetch_hkd_denom');
define('_hkd_loading_validation','ups_airtime_loading_nes/hkd_loading_validation');
define('_hkd_loading_confirmation','ups_airtime_loading_nes/hkd_loading_confirmation');
define('_hkd_fund_request','ups_funding_service/hkd_fundrequest');

//SGD LOADING
define('_sgd_loading_confirmation','ups_airtime_loading_nes/sgd_loading_confirmation');
//New Etisalat LOADING
define('_newEtisalat_loading_confirmation','ups_airtime_loading_nes/newEtisalat_loading_confirmation');

//MCWD
define('_fetch_mcwd','ups_billspay_service/verify_mcwd_consumer_code');
define('_fetch_mcwd_pending','ups_gaming/fetch_pending_mcwd');
define('_fetch_mcwd_processed','ups_gaming/fetch_processed_mcwd');
define('_mcwd_approval','ups_gaming/mcwd_approval');
define('_mcwd_reject','ups_gaming/mcwd_reject');

//METROTURF
define('_metroturf_topup','ups_gaming/metroturf');
define('_fetch_metroturf','ups_gaming/fetch_pending');
define('_fetch_metroturf_processed','ups_gaming/fetch_processed_mmtci');
define('_metroturf_approval','ups_gaming/metroturf_approval');

//NORKIS
define('_norkis_checkdigit','ups_billspay_service/norkis_checkdigit');

//ASIALINK AND FINASWIDE
define('_checkdigit_modulus11','ups_billspay_service/checkdigit_modulus11');


//CEBUANA
define("_search_sender",'ups_cebuana_service_jorel/search_sender');
define("_search_beneficiary",'ups_cebuana_service_jorel/search_beneficiary');
define("_fetch_currency",'ups_cebuana_service_jorel/fetch_available_currency');
define("_get_domestic_rates",'ups_cebuana_service_jorel/get_domestic_rates');
define("_cebuana_send",'ups_cebuana_service_jorel/send_domestic_remittance');
define("_cebuana_send_new",'ups_cebuana_service_jorel/send_domestic_remittance_new'); //ADDED BY PABLO 11-22-2018
define("_unhold_cebuana_send",'ups_cebuana_service_jorel/unhold_cebuana_send_service');
define("_otp_cebuana_resend",'ups_cebuana_service_jorel/resend_cebuana_OTP');
define("_cebuana_id_list",'ups_cebuana_service_jorel/fetch_id_list_collection');
define("_cebuana_cancel",'ups_cebuana_service_jorel/cancel_remittance_transaction');
define("_cebuana_refund",'ups_cebuana_service_jorel/refund_remittance_transaction');
define("_cebuana_amend",'ups_cebuana_service_jorel/ammend_domestic_transaction');
define("_cebuana_amend_fee",'ups_cebuana_service_jorel/fetch_ammendment_fee');
define("_register_sender",'ups_cebuana_service_jorel/register_sender');
define("_register_beneficiary",'ups_cebuana_service_jorel/register_beneficiary');
define("_cebuana_payout_check_user_agreement",'ups_cebuana_service_jorel/check_user_agreement');
define("_cebuana_payout_agree_user_agreement",'ups_cebuana_service_jorel/agree_user_agreement');

define("_cebuana_payout_confirm",'ups_cebuana_service_jorel/payout_domestic');
define("_cebuana_payout_confirm_new",'ups_cebuana_service_jorel/payout_domestic_new'); //Added by Pablo 11-19-2018
// define("_cebuana_payout_confirm_new_latest",'ups_cebuana_service_jorel/payout_domestic_new_latest'); //Added by Pablo 01-09-2019
define("_cebuana_payout_confirm_new_latest",'ups_cebuana_service_jorel/payout_domestic_new_latest_loan'); //new url 03/11/2019
define("_cebuana_checkref",'ups_cebuana_service_jorel/get_domestic_remittance_details');
define("_cebuana_checkref_new",'ups_cebuana_service_jorel/get_domestic_remittance_details_new'); //Added by Pablo 11-19-2018
define("_cebuana_checkref_new_latest",'ups_cebuana_service_jorel/get_domestic_remittance_details_new_latest'); //Added by Pablo 01-09-2019
define("_cebuana_checkref_new_latest_own_payout",'ups_cebuana_service_jorel_own_payout/get_domestic_remittance_details_new_latest'); //Added by rene for own payout


//WESTERN

define('_fetch_countries_iso','ups_ecash_service_nes/get_western_union_countries');
define('_fetch_country_charge','ups_ecash_service_nes/get_western_union_charge');
define('_ecash_to_western','ups_ecash_service_nes/ecash_to_western');
define('_ecash_to_western_details','ups_ecash_service_nes/ecash_to_western_details');
define('_fetch_pending_western','ups_ecash_service_nes/get_western_union_pending');
define('_fetch_donecancelled_western','ups_ecash_service_nes/get_western_union_donecancelled');
define('_get_status_pending_western','ups_ecash_service_nes/get_western_union_send_status');

define('_fetch_pending_western_payout','ups_ecash_service_nes/fetch_pending_payout_western_request');
define('_fetch_pending_moneygram_payout','ups_ecash_service_nes/fetch_pending_payout_moneygram_request');
define('_get_status_payout_western','ups_ecash_service_nes/get_pending_wu_txn_status');
define('_get_status_payout_moneygram','ups_ecash_service_nes/get_pending_mg_txn_status');
define('_western_create_request','ups_ecash_service_nes/create_payout_western_request');
define('_western_create_sender_benificiary_request','ups_ecash_service_nes/create_payout_western_sender_benificiary_request');
define('_moneygram_create_request','ups_ecash_service_nes/create_payout_moneygram_request');
define('_fetch_donecancelled_western_payout','ups_ecash_service_nes/get_western_union_payout_donecancelled');
define('_fetch_donecancelled_moneygram_payout','ups_ecash_service_nes/get_moneygram_payout_donecancelled');
define('_fetch_confirm_western_payout','ups_ecash_service_nes/get_fconf_wu_txns');
define('_ecash_to_western_payout','ups_ecash_service_nes/submit_payout_western_confirmation');
define('_fetch_process_western_payout','ups_ecash_service_nes/fetch_forcredit_payout_western_request');
define('_get_status_process_western_payout','ups_ecash_service_nes/get_forcredit_wu_txn_status');
define('_cancel_western_txn','ups_ecash_service_nes/submit_payout_western_cancellation');

//BANk API

define('_get_active_banks','ups_ecash_service/get_active_bank');

//smartloading
define('_getSmartList','smart_load/getGlyph');
define('_createSmartList','smart_load/Glyph_transaction');
define('_createSmartListandImages','smart_load/getGlyph_images');