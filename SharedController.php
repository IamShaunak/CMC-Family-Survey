<?php 

/**
 * SharedController Controller
 * @category  Controller / Model
 */
class SharedController extends BaseController{
	
	/**
     * familyinfo_new_ward_name_option_list Model Action
     * @return array
     */
	function familyinfo_new_ward_name_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id AS value,ward_name AS label FROM ward_master ORDER BY ward_name";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * familyinfo_new_category_option_list Model Action
     * @return array
     */
	function familyinfo_new_category_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id AS value,category_name AS label FROM category_master ORDER BY id ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * familyinfo_new_occupation_option_list Model Action
     * @return array
     */
	function familyinfo_new_occupation_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id AS value,occ_name AS label FROM occu_master ORDER BY id ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * familyinfo_new_education_option_list Model Action
     * @return array
     */
	function familyinfo_new_education_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id AS value,edu_name AS label FROM edu_master ORDER BY id ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * familyinfo_new_no_of_family_member_option_list Model Action
     * @return array
     */
	function familyinfo_new_no_of_family_member_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id AS value,count AS label FROM family_members_master ORDER BY id ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * familyinfo_new_female_option_list Model Action
     * @return array
     */
	function familyinfo_new_female_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT count AS value,count AS label FROM family_members_master";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * familyinfo_new_male_option_list Model Action
     * @return array
     */
	function familyinfo_new_male_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT count AS value,count AS label FROM family_members_master";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * familyinfo_new_other_fmember_count_option_list Model Action
     * @return array
     */
	function familyinfo_new_other_fmember_count_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT count AS value,count AS label FROM family_members_master";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * familyinfo_new_ration_card_type_option_list Model Action
     * @return array
     */
	function familyinfo_new_ration_card_type_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id AS value,retion_name AS label FROM retion_master ORDER BY id ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * familyinfo_new_type_of_house_option_list Model Action
     * @return array
     */
	function familyinfo_new_type_of_house_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id AS value,house_name AS label FROM house_master ORDER BY id ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * familyinfo_new_state_of_house_option_list Model Action
     * @return array
     */
	function familyinfo_new_state_of_house_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id AS value,state_of_house_name AS label FROM state_of_house_master ORDER BY id ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * personalinfo_occupation_option_list Model Action
     * @return array
     */
	function personalinfo_occupation_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id AS value,occ_name AS label FROM occu_master ORDER BY id ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * personalinfo_education_option_list Model Action
     * @return array
     */
	function personalinfo_education_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id AS value,edu_name AS label FROM edu_master ORDER BY id ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * personalinfo_marital_status_option_list Model Action
     * @return array
     */
	function personalinfo_marital_status_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id AS value,martial_status_type AS label FROM martial_master ORDER BY id ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * personalinfo_disability_type_option_list Model Action
     * @return array
     */
	function personalinfo_disability_type_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id AS value,disability_type AS label FROM disability_master ORDER BY id ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * personalinfo_artha_yojana_type_option_list Model Action
     * @return array
     */
	function personalinfo_artha_yojana_type_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id AS value,artha_yojana_type AS label FROM artha_yojana_master ORDER BY id ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * user_info_name_value_exist Model Action
     * @return array
     */
	function user_info_name_value_exist($val){
		$db = $this->GetModel();
		$db->where("name", $val);
		$exist = $db->has("user_info");
		return $exist;
	}

	/**
     * user_info_email_id_value_exist Model Action
     * @return array
     */
	function user_info_email_id_value_exist($val){
		$db = $this->GetModel();
		$db->where("email_id", $val);
		$exist = $db->has("user_info");
		return $exist;
	}

	/**
     * user_info_user_role_id_option_list Model Action
     * @return array
     */
	function user_info_user_role_id_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT role_id AS value, role_name AS label FROM roles";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

}
