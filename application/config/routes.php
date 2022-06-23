<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
// $route['default_controller'] = 'main_controller';
// $route['default_controller'] = 'cashier_controller/cashier_dashboard_ctrl';
// $route['default_controller'] = 'cashier_controller/cashier_cashform_ctrl';
// $route['default_controller'] = 'liquidation_controller/liq_domination_ctrl';
// $route['default_controller'] = 'cfs_cashier_controller/cfscashier_denomination_ctrl';
// $route['default_controller'] = 'treasury_controller/treasury_ctrl';
$route['default_controller'] = 'supervisor_controller/supervisor_dashboard_ctrl';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;




/*==================================================jay routes===================================================*/
/*==================================================cashier routes===============================================*/
$route['cashier_dashboard_route'] 					= 'cashier_controller/cashier_dashboard_ctrl';
$route['cashier_cashform_route'] 					= 'cashier_controller/cashier_cashform_ctrl';
$route['cashier_noncashform_route'] 				= 'cashier_controller/cashier_noncashform_ctrl';
$route['save_cashdenomination_route'] 				= 'cashier_controller/cash_denomination_ctrl';
$route['save_noncashdenomination_route'] 			= 'cashier_controller/noncash_denomination_ctrl';
$route['display_mop_route'] 						= 'cashier_controller/display_mop_ctrl';
$route['noncash_js_route'] 							= 'cashier_controller/noncash_js_ctrl';
$route['hnoncash_js_route'] 						= 'cashier_controller/hnoncash_js_ctrl';
$route['cashier_historyform_route'] 				= 'cashier_controller/cashier_history_ctrl';
$route['displayhistory_cashform_route'] 			= 'cashier_controller/displayhistory_cashform_ctrl';
$route['update_historycashform_route'] 				= 'cashier_controller/update_historycashform_ctrl';
$route['disabled_saveresetbtn_route'] 				= 'cashier_controller/disabled_saveresetbtn_ctrl';
$route['get_batchid_route']           				= 'cashier_controller/get_batchid_ctrl';
$route['disabled_noncashform_route']            	= 'cashier_controller/disabled_noncashform_ctrl';
$route['view_noncashmodal_route']            		= 'cashier_controller/view_noncashmodal_ctrl';
$route['disabled_partialcheckbox_route']            = 'cashier_controller/disabled_partialcheckbox_ctrl';
$route['displayhistory_noncashform_route']          = 'cashier_controller/displayhistory_noncashform_ctrl';
$route['update_historynoncashform_route']           = 'cashier_controller/update_historynoncashform_ctrl';
$route['display_hpartialdetails_route']           	= 'cashier_controller/display_hpartialdetails_ctrl';
/*================================================================================================================*/




/*==========================================cfs cashier side======================================================*/
$route['cfscashier_denomination_route'] 			= 'cfs_cashier_controller/cfscashier_denomination_ctrl';
$route['cfs_forex_denomination_route'] 				= 'cfs_cashier_controller/cfs_forex_denomination_ctrl';
$route['display_cfsothermop_route'] 				= 'cfs_cashier_controller/display_cfsothermop_ctrl';
$route['display_forex_currency_route'] 				= 'cfs_cashier_controller/display_forex_currency_ctrl';
$route['display_forex_denomination_form_route'] 	= 'cfs_cashier_controller/display_forex_denomination_form_ctrl';
$route['submit_cfscashiercash_route'] 				= 'cfs_cashier_controller/submit_cfscashiercash_ctrl';
$route['submit_cfscashiernoncash_route'] 			= 'cfs_cashier_controller/submit_cfscashiernoncash_ctrl';
$route['display_cfsncashmop_route'] 				= 'cfs_cashier_controller/display_cfsncashmop_ctrl';
$route['display_cfsncashbankname_route'] 			= 'cfs_cashier_controller/display_cfsncashbankname_ctrl';
$route['cfsnoncash_js_route'] 						= 'cfs_cashier_controller/cfsnoncash_js_ctrl';
$route['submit_cfsncash_route'] 					= 'cfs_cashier_controller/submit_cfsncash_ctrl';
$route['get_cfsbatchid_route'] 						= 'cashier_controller/get_batchid_ctrl';
$route['disabled_cfssaveresetbtn_route'] 			= 'cashier_controller/disabled_saveresetbtn_ctrl';
$route['cash_duplicate_route'] 						= 'cfs_cashier_controller/cash_duplicate_ctrl';
$route['noncash_duplicate_route'] 					= 'cfs_cashier_controller/noncash_duplicate_ctrl';

/*================================================================================================================*/




/*==========================================liquidation side======================================================*/
$route['liq_domination_route'] 					= 'liquidation_controller/liq_domination_ctrl';
$route['view_pendingdenomination_route'] 		= 'liquidation_controller/view_pendingdenomination_ctrl';
$route['get_pendingdenomination_route'] 		= 'liquidation_controller/get_pendingdenomination_ctrl';
$route['get_variancemodal_route'] 				= 'liquidation_controller/get_variancemodal_ctrl';
$route['confirm_pcpmodal_route'] 				= 'liquidation_controller/confirm_pcpmodal_ctrl';
$route['get_pendingnoncashmodal_route'] 		= 'liquidation_controller/get_pendingnoncashmodal_ctrl';
$route['cashier_linkaccess_route'] 				= 'liquidation_controller/cashier_linkaccess_ctrl';
$route['display_cashierlinkaccess_route'] 		= 'liquidation_controller/display_cashierlinkaccess_ctrl';

// ============================================liquidation adjustment route========================================
$route['liq_adjustment_route'] 					= 'liquidation_controller/liq_adjustment_ctrl';
$route['get_businessunit_route'] 				= 'liquidation_controller/get_businessunit_ctrl';
$route['get_bunitcode_route'] 					= 'liquidation_controller/get_bunitcode_ctrl';
$route['get_department_route'] 					= 'liquidation_controller/get_department_ctrl';
$route['get_deptamount_route'] 					= 'liquidation_controller/get_deptamount_ctrl';
$route['submit_amount_adjustment_route'] 		= 'liquidation_controller/submit_amount_adjustment_ctrl';
$route['get_adjusted_data_route'] 				= 'liquidation_controller/get_adjusted_data_ctrl';

/*================================================================================================================*/





/*==================================================TREASURY ROUTE=====================================================*/
$route['treasury_route'] 						= 'treasury_controller/treasury_ctrl';
$route['get_allbusinessunit_route'] 			= 'treasury_controller/get_allbusinessunit_ctrl';
$route['get_bunit_code_route'] 					= 'treasury_controller/get_bunit_code_ctrl';
$route['get_dept_name_route'] 					= 'treasury_controller/get_dept_name_ctrl';
$route['get_dept_code_route'] 					= 'treasury_controller/get_dept_code_ctrl';
$route['get_banks_route'] 						= 'treasury_controller/get_banks_ctrl';
$route['submit_bank_tagging_route'] 			= 'treasury_controller/submit_bank_tagging_ctrl';
$route['get_setup_bank_route'] 					= 'treasury_controller/get_setup_bank_ctrl';
$route['delete_banksetup_route'] 				= 'treasury_controller/delete_banksetup_ctrl';
$route['get_selected_bank_route'] 				= 'treasury_controller/get_selected_bank_ctrl';
$route['update_bank_tagging_route'] 			= 'treasury_controller/update_bank_tagging_ctrl';
$route['save_updated_banktagging_route'] 		= 'treasury_controller/save_updated_banktagging_ctrl';
/*================================================================================================================*/




/*===================================================SUPERVISOR ROUTE=================================================*/
$route['supervisor_dashboard_route'] 			= 'supervisor_controller/supervisor_dashboard_ctrl';
$route['supervisor_adjustment_route'] 			= 'supervisor_controller/supervisor_adjustment_ctrl';
/*=====================================================================================================================*/

// ============================================ end jay routes=========================================================
