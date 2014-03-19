<div class="field_row clearfix">	
    <?php echo form_label($this->lang->line('common_first_name') . ':', 'first_name', array('class' => 'required')); ?>
    <div >
        <?php
        echo form_input(array(
            'name' => 'first_name',
            'class' => 'form-control',
            'style' => 'width: 160px;',
            'id' => 'first_name',
            'value' => $person_info->first_name)
        );
        ?>
    </div>
</div>
<div class="field_row clearfix">	
    <?php echo form_label($this->lang->line('common_last_name') . ':', 'last_name', array('class' => 'required')); ?>
    <div>
        <?php
        echo form_input(array(
            'name' => 'last_name',
            'id' => 'last_name',
            'class' => 'form-control', 'style' => 'width: 160px;',
            'value' => $person_info->last_name)
        );
        ?>
    </div>
</div>

<div class="field_row clearfix">	
    <?php echo form_label($this->lang->line('common_email') . ':', 'email'); ?>
    <div>
        <?php
        echo form_input(array(
            'name' => 'email',
            'id' => 'email',
            'class' => 'form-control', 'style' => 'width: 160px;',
            'value' => $person_info->email)
        );
        ?>
    </div>
</div>

<div class="field_row clearfix">	
    <?php echo form_label($this->lang->line('common_phone_number') . ':', 'phone_number'); ?>
    <div >
        <?php
        echo form_input(array(
            'name' => 'phone_number',
            'id' => 'phone_number',
            'class' => 'form-control', 'style' => 'width: 160px;',
            'value' => $person_info->phone_number));
        ?>
    </div>
</div>

<div class="field_row clearfix">	
    <?php echo form_label($this->lang->line('common_address_1') . ':', 'address_1'); ?>
    <div >
        <?php
        echo form_input(array(
            'name' => 'address_1',
            'id' => 'address_1',
            'class' => 'form-control', 'style' => 'width: 160px;',
            'value' => $person_info->address_1));
        ?>
    </div>
</div>

<div class="field_row clearfix">	
    <?php echo form_label($this->lang->line('common_address_2') . ':', 'address_2'); ?>
    <div >
        <?php
        echo form_input(array(
            'name' => 'address_2',
            'id' => 'address_2',
            'class' => 'form-control', 'style' => 'width: 160px;',
            'value' => $person_info->address_2));
        ?>
    </div>
</div>

<div class="field_row clearfix">	
    <?php echo form_label($this->lang->line('common_city') . ':', 'city'); ?>
    <div >
        <?php
        echo form_input(array(
            'name' => 'city',
            'id' => 'city',
            'class' => 'form-control', 'style' => 'width: 160px;',
            'value' => $person_info->city));
        ?>
    </div>
</div>

<div class="field_row clearfix">	
    <?php echo form_label($this->lang->line('common_state') . ':', 'state'); ?>
    <div >
        <?php
        echo form_input(array(
            'name' => 'state',
            'id' => 'state',
            'class' => 'form-control', 'style' => 'width: 160px;',
            'value' => $person_info->state));
        ?>
    </div>
</div>

<div class="field_row clearfix">	
    <?php echo form_label($this->lang->line('common_zip') . ':', 'zip'); ?>
    <div >
        <?php
        echo form_input(array(
            'name' => 'zip',
            'id' => 'zip',
            'class' => 'form-control', 'style' => 'width: 160px;',
            'value' => $person_info->zip));
        ?>
    </div>
</div>

<div class="field_row clearfix">	
    <?php echo form_label($this->lang->line('common_country') . ':', 'country'); ?>
    <div >
        <?php
        echo form_input(array(
            'name' => 'country',
            'class' => 'form-control', 'style' => 'width: 160px;',
            'id' => 'country',
            'value' => $person_info->country));
        ?>
    </div>
</div>

<div class="field_row clearfix">	
    <?php echo form_label($this->lang->line('common_comments') . ':', 'comments'); ?>
    <div >
        <?php
        echo form_textarea(array(
            'name' => 'comments',
            'id' => 'comments',
            'class' => 'form-control', 'style' => 'width: 160px;',
            'value' => $person_info->comments)
        );
        ?>
    </div>
</div>