<?php
echo form_open('employees/save/' . $person_info->person_id, array('id' => 'employee_form'));
?>
<div id="required_fields_message"><?php echo $this->lang->line('common_fields_required_message'); ?></div>
<ul id="error_message_box"></ul>
<fieldset id="employee_basic_info">
    <h4><?php echo $this->lang->line("employees_basic_information"); ?></h4>
    <?php $this->load->view("people/form_basic_info"); ?>
</fieldset>

<fieldset id="employee_login_info">
    <h4><?php echo $this->lang->line("employees_login_info"); ?></h4>
    <div class="field_row clearfix">	
        <?php echo form_label($this->lang->line('employees_username') . ':', 'username', array('class' => 'required')); ?>
        <div >
            <?php
            echo form_input(array(
                'name' => 'username',
                'class' => 'form-control',
                'style' => 'width: 160px;',
                'id' => 'username',
                'value' => $person_info->username));
            ?>
        </div>
    </div>

    <?php
    $password_label_attributes = $person_info->person_id == "" ? array('class' => 'required') : array();
    ?>

    <div class="field_row clearfix">	
        <?php echo form_label($this->lang->line('employees_password') . ':', 'password', $password_label_attributes); ?>
        <div >
            <?php
            echo form_password(array(
                'name' => 'password',
                'class' => 'form-control',
                'style' => 'width: 160px;',
                'id' => 'password'
            ));
            ?>
        </div>
    </div>


    <div class="field_row clearfix">	
        <?php echo form_label($this->lang->line('employees_repeat_password') . ':', 'repeat_password', $password_label_attributes); ?>
        <div >
            <?php
            echo form_password(array(
                'name' => 'repeat_password',
                'class' => 'form-control',
                'style' => 'width: 160px;',
                'id' => 'repeat_password'
            ));
            ?>
        </div>
    </div>
    <div class="field_row clearfix">
        <?php echo form_label('Authorization:', 'authlevel'); ?>
        <div>
        <?php
        
        echo form_dropdown('authlevel', array('0'=>'Owner', '1' => 'Manager', '2' => 'Employee'), $this->Employee->get_auth($person_info->person_id), 'class="form-control" style="width:160px;"');
        ?>
        </div>
    </div>
</fieldset>

<fieldset id="employee_permission_info">
    <h4><?php echo $this->lang->line("employees_permission_info"); ?></h4>
    <p><?php echo $this->lang->line("employees_permission_desc"); ?></p>

    <ul id="permission_list" style="width: 300px;">
        <?php
        foreach ($all_modules->result() as $module) {
            ?>
            <li>	
                <?php echo form_checkbox("permissions[]", $module->module_id, $this->Employee->has_permission($module->module_id, $person_info->person_id), "id=\"$module->module_id\" style=\"vertical-align: middle; margin: auto 0;\""); ?>
                <label for="<?php echo $module->module_id; ?>" style="vertical-align: middle; margin: auto 0; cursor: pointer;">
                    <span class="medium"><?php echo $this->lang->line('module_' . $module->module_id); ?>:</span>
                    <span class="small"><?php echo $this->lang->line('module_' . $module->module_id . '_desc'); ?></span>
                </label>
            </li>
            <?php
        }
        ?>
    </ul>
    <?php
    echo form_submit(array(
        'name' => 'submit',
        'id' => 'submit',
        'value' => $this->lang->line('common_submit'),
        'class' => 'btn btn-success float_right')
    );
    ?>
</fieldset>
<?php
echo form_close();
?>
<script type='text/javascript'>

//validation and submit handling
    $(document).ready(function()
    {
    $('#employee_form').validate({
    submitHandler:function(form)
    {
    $(form).ajaxSubmit({
    success:function(response)
    {
    tb_remove();
            post_person_form_submit(response);
    },
            dataType:'json'
    });
    },
            errorLabelContainer: "#error_message_box",
            wrapper: "li",
            rules:
    {
    first_name: "required",
            last_name: "required",
            username:
    {
    required:true,
            minlength: 5
    },
            password:
    {
<?php
if ($person_info->person_id == "") {
    ?>
        required:true,
    <?php
}
?>
    minlength: 8
    },
            repeat_password:
    {
    equalTo: "#password"
    },
            email: "email"
    },
            messages:
    {
    first_name: "<?php echo $this->lang->line('common_first_name_required'); ?>",
            last_name: "<?php echo $this->lang->line('common_last_name_required'); ?>",
            username:
    {
    required: "<?php echo $this->lang->line('employees_username_required'); ?>",
            minlength: "<?php echo $this->lang->line('employees_username_minlength'); ?>"
    },
            password:
    {
<?php
if ($person_info->person_id == "") {
    ?>
        required:"<?php echo $this->lang->line('employees_password_required'); ?>",
    <?php
}
?>
    minlength: "<?php echo $this->lang->line('employees_password_minlength'); ?>"
    },
            repeat_password:
    {
    equalTo: "<?php echo $this->lang->line('employees_password_must_match'); ?>"
    },
            email: "<?php echo $this->lang->line('common_email_invalid_format'); ?>"
    }
    });
    });
</script>