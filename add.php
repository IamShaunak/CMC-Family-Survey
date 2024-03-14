<?php
$comp_model = new SharedController;
$page_element_id = "add-page-" . random_str();
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
$show_header = $this->show_header;
$view_title = $this->view_title;
$redirect_to = $this->redirect_to;
?>
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="add"  data-display-type="" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col ">
                    <h4 class="record-title"><?php print_lang('add_new_user_info'); ?></h4>
                </div>
            </div>
        </div>
    </div>
    <?php
    }
    ?>
    <div  class="">
        <div class="container">
            <div class="row ">
                <div class="col-md-7 comp-grid">
                    <?php $this :: display_page_errors(); ?>
                    <div  class="bg-light p-3 animated fadeIn page-content">
                        <form id="user_info-add-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-horizontal needs-validation" action="<?php print_link("user_info/add?csrf_token=$csrf_token") ?>" method="post">
                            <div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="name"><?php print_lang('name'); ?> <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="">
                                                <input id="ctrl-name"  value="<?php  echo $this->set_field_value('name',""); ?>" type="text" placeholder="<?php print_lang('enter_name'); ?>"  required="" name="name"  data-url="api/json/user_info_name_value_exist/" data-loading-msg="<?php print_lang('checking_availability_'); ?>" data-available-msg="<?php print_lang('available'); ?>" data-unavailable-msg="<?php print_lang('not_available'); ?>" class="form-control  ctrl-check-duplicate" />
                                                    <div class="check-status"></div> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="mobile_no"><?php print_lang('mobile_no'); ?> <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input id="ctrl-mobile_no"  value="<?php  echo $this->set_field_value('mobile_no',""); ?>" type="text" placeholder="<?php print_lang('enter_mobile_no'); ?>"  required="" name="mobile_no"  class="form-control " />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label class="control-label" for="email_id"><?php print_lang('email_id'); ?> <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="">
                                                        <input id="ctrl-email_id"  value="<?php  echo $this->set_field_value('email_id',""); ?>" type="email" placeholder="<?php print_lang('enter_email_id'); ?>"  required="" name="email_id"  data-url="api/json/user_info_email_id_value_exist/" data-loading-msg="<?php print_lang('checking_availability_'); ?>" data-available-msg="<?php print_lang('available'); ?>" data-unavailable-msg="<?php print_lang('not_available'); ?>" class="form-control  ctrl-check-duplicate" />
                                                            <div class="check-status"></div> 
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <label class="control-label" for="password"><?php print_lang('password'); ?> <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <div class="input-group">
                                                            <input id="ctrl-password"  value="<?php  echo $this->set_field_value('password',""); ?>" type="password" placeholder="<?php print_lang('enter_password'); ?>" maxlength="255"  required="" name="password"  class="form-control  password password-strength" />
                                                                <div class="input-group-append cursor-pointer btn-toggle-password">
                                                                    <span class="input-group-text"><i class="icon-eye"></i></span>
                                                                </div>
                                                            </div>
                                                            <div class="password-strength-msg">
                                                                <small class="font-weight-bold"><?php print_lang('should_contain'); ?></small>
                                                                <small class="length chip">6 <?php print_lang('characters_minimum'); ?></small>
                                                                <small class="caps chip"><?php print_lang('capital_letter'); ?></small>
                                                                <small class="number chip"><?php print_lang('number'); ?></small>
                                                                <small class="special chip"><?php print_lang('symbol'); ?></small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <label class="control-label" for="confirm_password"><?php print_lang('confirm_password'); ?> <span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <div class="input-group">
                                                                <input id="ctrl-password-confirm" data-match="#ctrl-password"  class="form-control password-confirm " type="password" name="confirm_password" required placeholder="<?php print_lang('confirm_password'); ?>" />
                                                                    <div class="input-group-append cursor-pointer btn-toggle-password">
                                                                        <span class="input-group-text"><i class="icon-eye"></i></span>
                                                                    </div>
                                                                    <div class="invalid-feedback">
                                                                        Password does not match
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <label class="control-label" for="user_role_id"><?php print_lang('user_role_id'); ?> <span class="text-danger">*</span></label>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <div class="">
                                                                    <select required=""  id="ctrl-user_role_id" name="user_role_id"  placeholder="<?php print_lang('select_a_value_'); ?>"    class="custom-select" >
                                                                        <option value=""><?php print_lang('select_a_value_'); ?></option>
                                                                        <?php 
                                                                        $user_role_id_options = $comp_model -> user_info_user_role_id_option_list();
                                                                        if(!empty($user_role_id_options)){
                                                                        foreach($user_role_id_options as $option){
                                                                        $value = (!empty($option['value']) ? $option['value'] : null);
                                                                        $label = (!empty($option['label']) ? $option['label'] : $value);
                                                                        $selected = $this->set_field_selected('user_role_id',$value, "");
                                                                        ?>
                                                                        <option <?php echo $selected; ?> value="<?php echo $value; ?>">
                                                                            <?php echo $label; ?>
                                                                        </option>
                                                                        <?php
                                                                        }
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group form-submit-btn-holder text-center mt-3">
                                                    <div class="form-ajax-status"></div>
                                                    <button class="btn btn-primary" type="submit">
                                                        <?php print_lang('submit'); ?>
                                                        <i class="icon-paper-plane"></i>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
