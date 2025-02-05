<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("user_info/add");
$can_edit = ACL::is_allowed("user_info/edit");
$can_view = ACL::is_allowed("user_info/view");
$can_delete = ACL::is_allowed("user_info/delete");
?>
<?php
$comp_model = new SharedController;
$page_element_id = "view-page-" . random_str();
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
//Page Data Information from Controller
$data = $this->view_data;
//$rec_id = $data['__tableprimarykey'];
$page_id = $this->route->page_id; //Page id from url
$view_title = $this->view_title;
$show_header = $this->show_header;
$show_edit_btn = $this->show_edit_btn;
$show_delete_btn = $this->show_delete_btn;
$show_export_btn = $this->show_export_btn;
?>
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="view"  data-display-type="table" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col ">
                    <h4 class="record-title"><?php print_lang('view_user_info'); ?></h4>
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
                <div class="col-md-12 comp-grid">
                    <?php $this :: display_page_errors(); ?>
                    <div  class="card animated fadeIn page-content">
                        <?php
                        $counter = 0;
                        if(!empty($data)){
                        $rec_id = (!empty($data['id']) ? urlencode($data['id']) : null);
                        $counter++;
                        ?>
                        <div id="page-report-body" class="">
                            <table class="table table-hover table-borderless table-striped">
                                <!-- Table Body Start -->
                                <tbody class="page-data" id="page-data-<?php echo $page_element_id; ?>">
                                    <tr  class="td-id">
                                        <th class="title"> <?php print_lang('id'); ?>: </th>
                                        <td class="value"> <?php echo $data['id']; ?></td>
                                    </tr>
                                    <tr  class="td-name">
                                        <th class="title"> <?php print_lang('name'); ?>: </th>
                                        <td class="value"> <?php echo $data['name']; ?></td>
                                    </tr>
                                    <tr  class="td-mobile_no">
                                        <th class="title"> <?php print_lang('mobile_no'); ?>: </th>
                                        <td class="value"> <?php echo $data['mobile_no']; ?></td>
                                    </tr>
                                    <tr  class="td-email_id">
                                        <th class="title"> <?php print_lang('email_id'); ?>: </th>
                                        <td class="value"> <?php echo $data['email_id']; ?></td>
                                    </tr>
                                    <tr  class="td-user_role_id">
                                        <th class="title"> <?php print_lang('user_role_id'); ?>: </th>
                                        <td class="value"> <?php echo $data['user_role_id']; ?></td>
                                    </tr>
                                </tbody>
                                <!-- Table Body End -->
                            </table>
                        </div>
                        <div class="p-3 d-flex">
                            <?php if($can_edit){ ?>
                            <a class="btn btn-sm btn-info"  href="<?php print_link("user_info/edit/$rec_id"); ?>">
                                <i class="icon-pencil"></i> <?php print_lang('edit'); ?>
                            </a>
                            <?php } ?>
                            <?php if($can_delete){ ?>
                            <a class="btn btn-sm btn-danger record-delete-btn mx-1"  href="<?php print_link("user_info/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal">
                                <i class="icon-close"></i> <?php print_lang('delete'); ?>
                            </a>
                            <?php } ?>
                        </div>
                        <?php
                        }
                        else{
                        ?>
                        <!-- Empty Record Message -->
                        <div class="text-muted p-3">
                            <i class="icon-ban"></i> <?php print_lang('no_record_found'); ?>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
