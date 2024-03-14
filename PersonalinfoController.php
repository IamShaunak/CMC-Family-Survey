<?php 
/**
 * Personalinfo Page Controller
 * @category  Controller
 */
class PersonalinfoController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "personalinfo";
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
			"family_id", 
			"name", 
			"age", 
			"gender", 
			"mobile_no", 
			"email_id", 
			"aadhar_number", 
			"voter_id", 
			"occupation_text", 
			"education_current_status", 
			"education_text", 
			"marital_status", 
			"income", 
			"are_you_disable", 
			"disabiity_percentage", 
			"disability_text", 
			"artha_yojana", 
			"samajikyojana_text", 
			"is_registered_construction_worker", 
			"bachat_gat", 
			"entry_date", 
			"user_id");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
	#Statement to execute before list record
	if(USER_ROLE!=3){
    $db->where("user_id",USER_ID);
}
	# End of before list statement
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				personalinfo.id LIKE ? OR 
				personalinfo.family_id LIKE ? OR 
				personalinfo.name LIKE ? OR 
				personalinfo.age LIKE ? OR 
				personalinfo.gender LIKE ? OR 
				personalinfo.mobile_no LIKE ? OR 
				personalinfo.email_id LIKE ? OR 
				personalinfo.aadhar_number LIKE ? OR 
				personalinfo.voter_id LIKE ? OR 
				personalinfo.occupation LIKE ? OR 
				personalinfo.occupation_text LIKE ? OR 
				personalinfo.education_current_status LIKE ? OR 
				personalinfo.education LIKE ? OR 
				personalinfo.education_text LIKE ? OR 
				personalinfo.marital_status LIKE ? OR 
				personalinfo.income LIKE ? OR 
				personalinfo.are_you_disable LIKE ? OR 
				personalinfo.disabiity_percentage LIKE ? OR 
				personalinfo.disability_type LIKE ? OR 
				personalinfo.disability_text LIKE ? OR 
				personalinfo.artha_yojana LIKE ? OR 
				personalinfo.artha_yojana_type LIKE ? OR 
				personalinfo.samajikyojana_text LIKE ? OR 
				personalinfo.is_registered_construction_worker LIKE ? OR 
				personalinfo.bachat_gat LIKE ? OR 
				personalinfo.entry_date LIKE ? OR 
				personalinfo.user_id LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "personalinfo/search.php";
		}
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("personalinfo.id", ORDER_TYPE);
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
		$page_title = $this->view->page_title = get_lang('personal');
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$this->render_view("personalinfo/list.php", $data); //render the full page
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
			"aadhar_number", 
			"voter_id", 
			"occupation", 
			"education", 
			"income", 
			"are_you_disable", 
			"disabiity_percentage", 
			"disability_type", 
			"artha_yojana", 
			"artha_yojana_type", 
			"marital_status", 
			"bachat_gat", 
			"family_id", 
			"occupation_text", 
			"education_text", 
			"disability_text", 
			"samajikyojana_text", 
			"entry_date", 
			"user_id", 
			"education_current_status", 
			"is_registered_construction_worker");
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("personalinfo.id", $rec_id);; //select record based on primary key
		}
		$record = $db->getOne($tablename, $fields );
		if($record){
			$page_title = $this->view->page_title = get_lang('view_personalinfo_new');
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
		return $this->render_view("personalinfo/view.php", $record);
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
			$fields = $this->fields = array("family_id","name","age","aadhar_number","gender","voter_id","mobile_no","email_id","occupation","education_current_status","education","marital_status","income","are_you_disable","disabiity_percentage","disability_type","artha_yojana","artha_yojana_type","is_registered_construction_worker","bachat_gat","entry_date","user_id");
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'name' => 'required',
				'age' => 'required|numeric',
				'aadhar_number' => 'numeric',
				'gender' => 'required',
				'mobile_no' => 'numeric',
				'email_id' => 'valid_email',
				'occupation' => 'required',
				'education_current_status' => 'required',
				'education' => 'required',
				'marital_status' => 'required',
				'income' => 'required|numeric',
				'are_you_disable' => 'required',
				'disabiity_percentage' => 'numeric',
				'artha_yojana' => 'required',
				'is_registered_construction_worker' => 'required',
				'bachat_gat' => 'required',
			);
			$this->sanitize_array = array(
				'family_id' => 'sanitize_string',
				'name' => 'sanitize_string',
				'age' => 'sanitize_string',
				'aadhar_number' => 'sanitize_string',
				'gender' => 'sanitize_string',
				'voter_id' => 'sanitize_string',
				'mobile_no' => 'sanitize_string',
				'email_id' => 'sanitize_string',
				'occupation' => 'sanitize_string',
				'education_current_status' => 'sanitize_string',
				'education' => 'sanitize_string',
				'marital_status' => 'sanitize_string',
				'income' => 'sanitize_string',
				'are_you_disable' => 'sanitize_string',
				'disabiity_percentage' => 'sanitize_string',
				'disability_type' => 'sanitize_string',
				'artha_yojana' => 'sanitize_string',
				'artha_yojana_type' => 'sanitize_string',
				'is_registered_construction_worker' => 'sanitize_string',
				'bachat_gat' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			$modeldata['entry_date'] = datetime_now();
$modeldata['user_id'] = USER_ID;
			if($this->validated()){
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
		# Statement to execute after adding record
//execute sql statement and return a single field value
$params = array($modeldata['family_id']);
$value = $db->rawQueryValue("SELECT count(*)as total  FROM `personalinfo` WHERE `family_id` = ?", $params);
$table_data = array(
    "personal_info_count" => $value[0]
);
$db->where("id", $modeldata['family_id']);
$bool = $db->update("familyinfo_new", $table_data);
$params = array($modeldata['occupation']);
$value = $db->rawQueryValue("SELECT occ_name FROM `occu_master` WHERE id=?", $params);
$table_data = array(
    "occupation_text" => $value[0]
);
$db->where("id",$rec_id);
$bool = $db->update("personalinfo", $table_data);
$params = array($modeldata['education']);
$value = $db->rawQueryValue("SELECT edu_name FROM `edu_master` WHERE id=?", $params);
$table_data = array(
    "education_text" => $value[0]
);
$db->where("id",$rec_id);
$bool = $db->update("personalinfo", $table_data);
$params = array($modeldata['disability_type']);
$value = $db->rawQueryValue("SELECT disability_type FROM `disability_master` WHERE id=?", $params);
$table_data = array(
    "disability_text" => $value[0]
);
$db->where("id",$rec_id);
$bool = $db->update("personalinfo", $table_data);
$params = array($modeldata['artha_yojana_type']);
$value = $db->rawQueryValue("SELECT artha_yojana_type FROM `artha_yojana_master` WHERE id=?", $params);
$table_data = array(
    "samajikyojana_text" => $value[0]
);
$db->where("id",$rec_id);
$bool = $db->update("personalinfo", $table_data);
		# End of after add statement
					$this->set_flash_msg(get_lang('record_added_successfully'), "success");
					return	$this->redirect("personalinfo");
				}
				else{
					$this->set_page_error();
				}
			}
		}
		$page_title = $this->view->page_title = get_lang('add_personalinfo_');
		$this->render_view("personalinfo/add.php");
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
		$fields = $this->fields = array("id","family_id","name","age","aadhar_number","gender","voter_id","mobile_no","email_id","occupation","education_current_status","education","marital_status","income","are_you_disable","disabiity_percentage","disability_type","artha_yojana","artha_yojana_type","is_registered_construction_worker","bachat_gat","entry_date","user_id");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'name' => 'required',
				'age' => 'required|numeric',
				'aadhar_number' => 'numeric',
				'gender' => 'required',
				'mobile_no' => 'numeric',
				'email_id' => 'valid_email',
				'occupation' => 'required',
				'education_current_status' => 'required',
				'education' => 'required',
				'marital_status' => 'required',
				'income' => 'required|numeric',
				'are_you_disable' => 'required',
				'disabiity_percentage' => 'numeric',
				'artha_yojana' => 'required',
				'is_registered_construction_worker' => 'required',
				'bachat_gat' => 'required',
			);
			$this->sanitize_array = array(
				'family_id' => 'sanitize_string',
				'name' => 'sanitize_string',
				'age' => 'sanitize_string',
				'aadhar_number' => 'sanitize_string',
				'gender' => 'sanitize_string',
				'voter_id' => 'sanitize_string',
				'mobile_no' => 'sanitize_string',
				'email_id' => 'sanitize_string',
				'occupation' => 'sanitize_string',
				'education_current_status' => 'sanitize_string',
				'education' => 'sanitize_string',
				'marital_status' => 'sanitize_string',
				'income' => 'sanitize_string',
				'are_you_disable' => 'sanitize_string',
				'disabiity_percentage' => 'sanitize_string',
				'disability_type' => 'sanitize_string',
				'artha_yojana' => 'sanitize_string',
				'artha_yojana_type' => 'sanitize_string',
				'is_registered_construction_worker' => 'sanitize_string',
				'bachat_gat' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			$modeldata['entry_date'] = datetime_now();
$modeldata['user_id'] = USER_ID;
			if($this->validated()){
				$db->where("personalinfo.id", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
		# Statement to execute after adding record
//execute sql statement and return a single field value
$params = array($modeldata['family_id']);
$value = $db->rawQueryValue("SELECT count(*)as total  FROM `personalinfo` WHERE `family_id` = ?", $params);
$table_data = array(
    "personal_info_count" => $value[0]
);
$db->where("id", $modeldata['family_id']);
$bool = $db->update("familyinfo_new", $table_data);
$params = array($modeldata['occupation']);
$value = $db->rawQueryValue("SELECT occ_name FROM `occu_master` WHERE id=?", $params);
$table_data = array(
    "occupation_text" => $value[0]
);
$db->where("id",$rec_id);
$bool = $db->update("personalinfo", $table_data);
$params = array($modeldata['education']);
$value = $db->rawQueryValue("SELECT edu_name FROM `edu_master` WHERE id=?", $params);
$table_data = array(
    "education_text" => $value[0]
);
$db->where("id",$rec_id);
$bool = $db->update("personalinfo", $table_data);
$params = array($modeldata['disability_type']);
$value = $db->rawQueryValue("SELECT disability_type FROM `disability_master` WHERE id=?", $params);
$table_data = array(
    "disability_text" => $value[0]
);
$db->where("id",$rec_id);
$bool = $db->update("personalinfo", $table_data);
$params = array($modeldata['artha_yojana_type']);
$value = $db->rawQueryValue("SELECT artha_yojana_type FROM `artha_yojana_master` WHERE id=?", $params);
$table_data = array(
    "samajikyojana_text" => $value[0]
);
$db->where("id",$rec_id);
$bool = $db->update("personalinfo", $table_data);
		# End of after update statement
					$this->set_flash_msg(get_lang('record_updated_successfully'), "success");
					return $this->redirect("personalinfo");
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
						return	$this->redirect("personalinfo");
					}
				}
			}
		}
		$db->where("personalinfo.id", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = get_lang('edit_personalinfo');
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("personalinfo/edit.php", $data);
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
		$db->where("personalinfo.id", $arr_rec_id, "in");
		$bool = $db->delete($tablename);
		if($bool){
			$this->set_flash_msg(get_lang('record_deleted_successfully'), "success");
		}
		elseif($db->getLastError()){
			$page_error = $db->getLastError();
			$this->set_flash_msg($page_error, "danger");
		}
		return	$this->redirect("personalinfo");
	}
}
