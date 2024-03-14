<?php 
/**
 * Familyinfo_new Page Controller
 * @category  Controller
 */
class Familyinfo_newController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "familyinfo_new";
	}
	/**
     * List page records
     * @param $fieldname (filter record by a field) 
     * @param $fieldvalue (filter field value)
     * @return BaseView
     */
	function index($fieldname = null , $fieldvalue = null){
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$fields = array("id", 
			"ward_name", 
			"male AS male1", 
			"is_residence_in_govt_quarter", 
			"name", 
			"age", 
			"gender", 
			"mobile_no", 
			"email_id", 
			"category_text", 
			"occupation_text", 
			"education_current_status", 
			"education_text", 
			"no_of_family_member", 
			"female", 
			"male", 
			"other_fmember_count", 
			"house_no", 
			"tap_no", 
			"gross_family_income", 
			"rationcard_text", 
			"is_below_poority_line", 
			"poority_certificate_no", 
			"pm_arogya_yojana", 
			"houseconstructiontype_text", 
			"home_info", 
			"statusofhouse_text", 
			"gharkul_yojana", 
			"if_not_applied", 
			"rain_water_harvest", 
			"toilet", 
			"compost", 
			"garden", 
			"solar", 
			"solar_type", 
			"personal_info_count", 
			"entry_date", 
			"user_id");
		$pagination = $this->get_pagination(50); // get current pagination e.g array(page_number, page_limit)
	#Statement to execute before list record
	if(USER_ROLE!=3){
    $db->where("user_id",USER_ID);
}
	# End of before list statement
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				familyinfo_new.id LIKE ? OR 
				familyinfo_new.ward_name LIKE ? OR 
				male LIKE ? OR 
				familyinfo_new.is_residence_in_govt_quarter LIKE ? OR 
				familyinfo_new.name LIKE ? OR 
				familyinfo_new.age LIKE ? OR 
				familyinfo_new.gender LIKE ? OR 
				familyinfo_new.mobile_no LIKE ? OR 
				familyinfo_new.email_id LIKE ? OR 
				familyinfo_new.category LIKE ? OR 
				familyinfo_new.category_text LIKE ? OR 
				familyinfo_new.occupation LIKE ? OR 
				familyinfo_new.occupation_text LIKE ? OR 
				familyinfo_new.education_current_status LIKE ? OR 
				familyinfo_new.education LIKE ? OR 
				familyinfo_new.education_text LIKE ? OR 
				familyinfo_new.no_of_family_member LIKE ? OR 
				familyinfo_new.female LIKE ? OR 
				familyinfo_new.male LIKE ? OR 
				familyinfo_new.other_fmember_count LIKE ? OR 
				familyinfo_new.house_no LIKE ? OR 
				familyinfo_new.tap_no LIKE ? OR 
				familyinfo_new.gross_family_income LIKE ? OR 
				familyinfo_new.ration_card_type LIKE ? OR 
				familyinfo_new.rationcard_text LIKE ? OR 
				familyinfo_new.is_below_poority_line LIKE ? OR 
				familyinfo_new.poority_certificate_no LIKE ? OR 
				familyinfo_new.pm_arogya_yojana LIKE ? OR 
				familyinfo_new.type_of_house LIKE ? OR 
				familyinfo_new.houseconstructiontype_text LIKE ? OR 
				familyinfo_new.home_info LIKE ? OR 
				familyinfo_new.state_of_house LIKE ? OR 
				familyinfo_new.statusofhouse_text LIKE ? OR 
				familyinfo_new.gharkul_yojana LIKE ? OR 
				familyinfo_new.if_not_applied LIKE ? OR 
				familyinfo_new.rain_water_harvest LIKE ? OR 
				familyinfo_new.toilet LIKE ? OR 
				familyinfo_new.compost LIKE ? OR 
				familyinfo_new.garden LIKE ? OR 
				familyinfo_new.solar LIKE ? OR 
				familyinfo_new.solar_type LIKE ? OR 
				familyinfo_new.personal_info_count LIKE ? OR 
				familyinfo_new.aadhar_number LIKE ? OR 
				familyinfo_new.voter_id LIKE ? OR 
				familyinfo_new.choose LIKE ? OR 
				familyinfo_new.optional LIKE ? OR 
				familyinfo_new.entry_date LIKE ? OR 
				familyinfo_new.user_id LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "familyinfo_new/search.php";
		}
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("familyinfo_new.id", ORDER_TYPE);
		}
		if($fieldname){
			$db->where($fieldname , $fieldvalue); //filter by a single field name
		}
		$tc = $db->withTotalCount();
		$records = $db->get($tablename, $pagination, $fields);
		$records_count = count($records);
		$total_records = intval($tc->totalCount);
		$page_limit = $pagination[1];
		$total_pages = ceil($total_records / $page_limit);
		$data = new stdClass;
		$data->records = $records;
		$data->record_count = $records_count;
		$data->total_records = $total_records;
		$data->total_page = $total_pages;
		if($db->getLastError()){
			$this->set_page_error();
		}
		$page_title = $this->view->page_title = get_lang('familyinfo_new');
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$this->render_view("familyinfo_new/list.php", $data); //render the full page
	}
	/**
     * View record detail 
	 * @param $rec_id (select record by table primary key) 
     * @param $value value (select record by value of field name(rec_id))
     * @return BaseView
     */
	function view($rec_id = null, $value = null){
		$request = $this->request;
		$db = $this->GetModel();
		$rec_id = $this->rec_id = urldecode($rec_id);
		$tablename = $this->tablename;
		$fields = array("id", 
			"name", 
			"age", 
			"gender", 
			"mobile_no", 
			"email_id", 
			"category", 
			"occupation", 
			"education", 
			"no_of_family_member", 
			"female", 
			"male", 
			"house_no", 
			"tap_no", 
			"gross_family_income", 
			"ration_card_type", 
			"pm_arogya_yojana", 
			"type_of_house", 
			"home_info", 
			"state_of_house", 
			"gharkul_yojana", 
			"if_not_applied", 
			"rain_water_harvest", 
			"toilet", 
			"compost", 
			"garden", 
			"solar", 
			"solar_type", 
			"personal_info_count", 
			"is_residence_in_govt_quarter", 
			"category_text", 
			"occupation_text", 
			"education_text", 
			"rationcard_text", 
			"houseconstructiontype_text", 
			"statusofhouse_text", 
			"entry_date", 
			"user_id", 
			"ward_name", 
			"education_current_status", 
			"is_below_poority_line", 
			"poority_certificate_no", 
			"other_fmember_count");
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("familyinfo_new.id", $rec_id);; //select record based on primary key
		}
		$record = $db->getOne($tablename, $fields );
		if($record){
			$page_title = $this->view->page_title = get_lang('view_familyinfo_new');
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		}
		else{
			if($db->getLastError()){
				$this->set_page_error();
			}
			else{
				$this->set_page_error(get_lang('no_record_found'));
			}
		}
		return $this->render_view("familyinfo_new/view.php", $record);
	}
	/**
     * Insert new record to the database table
	 * @param $formdata array() from $_POST
     * @return BaseView
     */
	function add($formdata = null){
		if($formdata){
			$db = $this->GetModel();
			$tablename = $this->tablename;
			$request = $this->request;
			//fillable fields
			$fields = $this->fields = array("is_residence_in_govt_quarter","ward_name","name","age","gender","mobile_no","email_id","category","occupation","education_current_status","education","no_of_family_member","female","male","other_fmember_count","house_no","tap_no","gross_family_income","ration_card_type","is_below_poority_line","poority_certificate_no","pm_arogya_yojana","type_of_house","home_info","state_of_house","gharkul_yojana","if_not_applied","rain_water_harvest","toilet","compost","garden","solar","solar_type","personal_info_count","entry_date","user_id");
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'is_residence_in_govt_quarter' => 'required',
				'ward_name' => 'required',
				'name' => 'required',
				'age' => 'required|numeric',
				'gender' => 'required',
				'mobile_no' => 'required|numeric',
				'email_id' => 'valid_email',
				'category' => 'required',
				'occupation' => 'required',
				'education_current_status' => 'required',
				'education' => 'required',
				'no_of_family_member' => 'required',
				'female' => 'required',
				'male' => 'required',
				'other_fmember_count' => 'required',
				'gross_family_income' => 'required|numeric',
				'ration_card_type' => 'required',
				'is_below_poority_line' => 'required',
				'poority_certificate_no' => 'required',
				'pm_arogya_yojana' => 'required',
				'type_of_house' => 'required',
				'home_info' => 'required',
				'state_of_house' => 'required',
				'gharkul_yojana' => 'required',
				'rain_water_harvest' => 'required',
				'toilet' => 'required',
				'compost' => 'required',
				'garden' => 'required',
				'solar' => 'required',
			);
			$this->sanitize_array = array(
				'is_residence_in_govt_quarter' => 'sanitize_string',
				'ward_name' => 'sanitize_string',
				'name' => 'sanitize_string',
				'age' => 'sanitize_string',
				'gender' => 'sanitize_string',
				'mobile_no' => 'sanitize_string',
				'email_id' => 'sanitize_string',
				'category' => 'sanitize_string',
				'occupation' => 'sanitize_string',
				'education_current_status' => 'sanitize_string',
				'education' => 'sanitize_string',
				'no_of_family_member' => 'sanitize_string',
				'female' => 'sanitize_string',
				'male' => 'sanitize_string',
				'other_fmember_count' => 'sanitize_string',
				'house_no' => 'sanitize_string',
				'tap_no' => 'sanitize_string',
				'gross_family_income' => 'sanitize_string',
				'ration_card_type' => 'sanitize_string',
				'is_below_poority_line' => 'sanitize_string',
				'poority_certificate_no' => 'sanitize_string',
				'pm_arogya_yojana' => 'sanitize_string',
				'type_of_house' => 'sanitize_string',
				'home_info' => 'sanitize_string',
				'state_of_house' => 'sanitize_string',
				'gharkul_yojana' => 'sanitize_string',
				'if_not_applied' => 'sanitize_string',
				'rain_water_harvest' => 'sanitize_string',
				'toilet' => 'sanitize_string',
				'compost' => 'sanitize_string',
				'garden' => 'sanitize_string',
				'solar' => 'sanitize_string',
				'solar_type' => 'sanitize_string',
				'personal_info_count' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			$modeldata['entry_date'] = datetime_now();
$modeldata['user_id'] = USER_ID;
			if($this->validated()){
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
		# Statement to execute after adding record
		$params = array($modeldata['category']);
$value = $db->rawQueryValue("SELECT category_name FROM `category_master` WHERE id=?", $params);
$table_data = array(
    "category_text" => $value[0]
);
$db->where("id",$rec_id);
$bool = $db->update("familyinfo_new", $table_data);
$params = array($modeldata['occupation']);
$value = $db->rawQueryValue("SELECT occ_name FROM `occu_master` WHERE id=?", $params);
$table_data = array(
    "occupation_text" => $value[0]
);
$db->where("id",$rec_id);
$bool = $db->update("familyinfo_new", $table_data);
$params = array($modeldata['education']);
$value = $db->rawQueryValue("SELECT edu_name FROM `edu_master` WHERE id=?", $params);
$table_data = array(
    "education_text" => $value[0]
);
$db->where("id",$rec_id);
$bool = $db->update("familyinfo_new", $table_data);
$params = array($modeldata['ration_card_type']);
$value = $db->rawQueryValue("SELECT retion_name FROM `retion_master` WHERE id=?", $params);
$table_data = array(
    "rationcard_text" => $value[0]
);
$db->where("id",$rec_id);
$bool = $db->update("familyinfo_new", $table_data);
$params = array($modeldata['type_of_house']);
$value = $db->rawQueryValue("SELECT house_name FROM `house_master` WHERE id=?", $params);
$table_data = array(
    "houseconstructiontype_text" => $value[0]
);
$db->where("id",$rec_id);
$bool = $db->update("familyinfo_new", $table_data);
$params = array($modeldata['state_of_house']);
$value = $db->rawQueryValue("SELECT house_info_type FROM `house_info_master` WHERE id=?", $params);
$table_data = array(
    "statusofhouse_text" => $value[0]
);
$db->where("id",$rec_id);
$bool = $db->update("familyinfo_new", $table_data);
		# End of after add statement
					$this->set_flash_msg(get_lang('record_added_successfully'), "success");
					return	$this->redirect("familyinfo_new");
				}
				else{
					$this->set_page_error();
				}
			}
		}
		$this->render_view("familyinfo_new/add.php");
	}
	/**
     * Update table record with formdata
	 * @param $rec_id (select record by table primary key)
	 * @param $formdata array() from $_POST
     * @return array
     */
	function edit($rec_id = null, $formdata = null){
		$request = $this->request;
		$db = $this->GetModel();
		$this->rec_id = $rec_id;
		$tablename = $this->tablename;
		 //editable fields
		$fields = $this->fields = array("id","is_residence_in_govt_quarter","ward_name","name","age","gender","mobile_no","email_id","category","occupation","education_current_status","education","no_of_family_member","female","male","other_fmember_count","house_no","tap_no","gross_family_income","ration_card_type","is_below_poority_line","poority_certificate_no","pm_arogya_yojana","type_of_house","home_info","state_of_house","gharkul_yojana","if_not_applied","rain_water_harvest","toilet","compost","garden","solar","solar_type","personal_info_count","entry_date","user_id");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'is_residence_in_govt_quarter' => 'required',
				'ward_name' => 'required',
				'name' => 'required',
				'age' => 'required|numeric',
				'gender' => 'required',
				'mobile_no' => 'required|numeric',
				'email_id' => 'valid_email',
				'category' => 'required',
				'occupation' => 'required',
				'education_current_status' => 'required',
				'education' => 'required',
				'no_of_family_member' => 'required',
				'female' => 'required',
				'male' => 'required',
				'other_fmember_count' => 'required',
				'gross_family_income' => 'required|numeric',
				'ration_card_type' => 'required',
				'is_below_poority_line' => 'required',
				'poority_certificate_no' => 'required',
				'pm_arogya_yojana' => 'required',
				'type_of_house' => 'required',
				'home_info' => 'required',
				'state_of_house' => 'required',
				'gharkul_yojana' => 'required',
				'rain_water_harvest' => 'required',
				'toilet' => 'required',
				'compost' => 'required',
				'garden' => 'required',
				'solar' => 'required',
			);
			$this->sanitize_array = array(
				'is_residence_in_govt_quarter' => 'sanitize_string',
				'ward_name' => 'sanitize_string',
				'name' => 'sanitize_string',
				'age' => 'sanitize_string',
				'gender' => 'sanitize_string',
				'mobile_no' => 'sanitize_string',
				'email_id' => 'sanitize_string',
				'category' => 'sanitize_string',
				'occupation' => 'sanitize_string',
				'education_current_status' => 'sanitize_string',
				'education' => 'sanitize_string',
				'no_of_family_member' => 'sanitize_string',
				'female' => 'sanitize_string',
				'male' => 'sanitize_string',
				'other_fmember_count' => 'sanitize_string',
				'house_no' => 'sanitize_string',
				'tap_no' => 'sanitize_string',
				'gross_family_income' => 'sanitize_string',
				'ration_card_type' => 'sanitize_string',
				'is_below_poority_line' => 'sanitize_string',
				'poority_certificate_no' => 'sanitize_string',
				'pm_arogya_yojana' => 'sanitize_string',
				'type_of_house' => 'sanitize_string',
				'home_info' => 'sanitize_string',
				'state_of_house' => 'sanitize_string',
				'gharkul_yojana' => 'sanitize_string',
				'if_not_applied' => 'sanitize_string',
				'rain_water_harvest' => 'sanitize_string',
				'toilet' => 'sanitize_string',
				'compost' => 'sanitize_string',
				'garden' => 'sanitize_string',
				'solar' => 'sanitize_string',
				'solar_type' => 'sanitize_string',
				'personal_info_count' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			$modeldata['entry_date'] = datetime_now();
$modeldata['user_id'] = USER_ID;
			if($this->validated()){
				$db->where("familyinfo_new.id", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
		# Statement to execute after adding record
			$params = array($modeldata['category']);
$value = $db->rawQueryValue("SELECT category_name FROM `category_master` WHERE id=?", $params);
$table_data = array(
    "category_text" => $value[0]
);
$db->where("id",$rec_id);
$bool = $db->update("familyinfo_new", $table_data);
$params = array($modeldata['occupation']);
$value = $db->rawQueryValue("SELECT occ_name FROM `occu_master` WHERE id=?", $params);
$table_data = array(
    "occupation_text" => $value[0]
);
$db->where("id",$rec_id);
$bool = $db->update("familyinfo_new", $table_data);
$params = array($modeldata['education']);
$value = $db->rawQueryValue("SELECT edu_name FROM `edu_master` WHERE id=?", $params);
$table_data = array(
    "education_text" => $value[0]
);
$db->where("id",$rec_id);
$bool = $db->update("familyinfo_new", $table_data);
$params = array($modeldata['ration_card_type']);
$value = $db->rawQueryValue("SELECT retion_name FROM `retion_master` WHERE id=?", $params);
$table_data = array(
    "rationcard_text" => $value[0]
);
$db->where("id",$rec_id);
$bool = $db->update("familyinfo_new", $table_data);
$params = array($modeldata['type_of_house']);
$value = $db->rawQueryValue("SELECT house_name FROM `house_master` WHERE id=?", $params);
$table_data = array(
    "houseconstructiontype_text" => $value[0]
);
$db->where("id",$rec_id);
$bool = $db->update("familyinfo_new", $table_data);
$params = array($modeldata['state_of_house']);
$value = $db->rawQueryValue("SELECT house_info_type FROM `house_info_master` WHERE id=?", $params);
$table_data = array(
    "statusofhouse_text" => $value[0]
);
$db->where("id",$rec_id);
$bool = $db->update("familyinfo_new", $table_data);
		# End of after update statement
					$this->set_flash_msg(get_lang('record_updated_successfully'), "success");
					return $this->redirect("familyinfo_new");
				}
				else{
					if($db->getLastError()){
						$this->set_page_error();
					}
					elseif(!$numRows){
						//not an error, but no record was updated
						$page_error = get_lang('no_record_updated');
						$this->set_page_error($page_error);
						$this->set_flash_msg($page_error, "warning");
						return	$this->redirect("familyinfo_new");
					}
				}
			}
		}
		$db->where("familyinfo_new.id", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = get_lang('edit_familyinfo_new');
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("familyinfo_new/edit.php", $data);
	}
	/**
     * Delete record from the database
	 * Support multi delete by separating record id by comma.
     * @return BaseView
     */
	function delete($rec_id = null){
		Csrf::cross_check();
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$this->rec_id = $rec_id;
		//form multiple delete, split record id separated by comma into array
		$arr_rec_id = array_map('trim', explode(",", $rec_id));
		$db->where("familyinfo_new.id", $arr_rec_id, "in");
		$bool = $db->delete($tablename);
		if($bool){
			$this->set_flash_msg(get_lang('record_deleted_successfully'), "success");
		}
		elseif($db->getLastError()){
			$page_error = $db->getLastError();
			$this->set_flash_msg($page_error, "danger");
		}
		return	$this->redirect("familyinfo_new");
	}
}
