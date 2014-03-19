<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <base href="<?php echo base_url(); ?>" />
        <title><?php echo $this->config->item('company') . ' -- ' . $this->lang->line('common_powered_by') . ' PB Soft Point Of Sale' ?></title>
        <link rel="stylesheet" rev="stylesheet" href="<?php echo base_url(); ?>css/ospos.css" />
        <link rel="stylesheet" rev="stylesheet" href="<?php echo base_url(); ?>css/ospos_print.css"  media="print"/>
        <script>BASE_URL = '<?php echo site_url(); ?>';</script>
        <script src="<?php echo base_url(); ?>js/jquery-1.2.6.min.js" type="text/javascript" language="javascript" charset="UTF-8"></script>
        <script src="<?php echo base_url(); ?>js/jquery.color.js" type="text/javascript" language="javascript" charset="UTF-8"></script>
        <script src="<?php echo base_url(); ?>js/jquery.metadata.js" type="text/javascript" language="javascript" charset="UTF-8"></script>
        <script src="<?php echo base_url(); ?>js/jquery.form.js" type="text/javascript" language="javascript" charset="UTF-8"></script>
        <script src="<?php echo base_url(); ?>js/jquery.tablesorter.min.js" type="text/javascript" language="javascript" charset="UTF-8"></script>
        <script src="<?php echo base_url(); ?>js/jquery.ajax_queue.js" type="text/javascript" language="javascript" charset="UTF-8"></script>
        <script src="<?php echo base_url(); ?>js/jquery.bgiframe.min.js" type="text/javascript" language="javascript" charset="UTF-8"></script>
        <script src="<?php echo base_url(); ?>js/jquery.autocomplete.js" type="text/javascript" language="javascript" charset="UTF-8"></script>
        <script src="<?php echo base_url(); ?>js/jquery.validate.min.js" type="text/javascript" language="javascript" charset="UTF-8"></script>
        <script src="<?php echo base_url(); ?>js/jquery.jkey-1.1.js" type="text/javascript" language="javascript" charset="UTF-8"></script>
        <script src="<?php echo base_url(); ?>js/thickbox.js" type="text/javascript" language="javascript" charset="UTF-8"></script>
        <script src="<?php echo base_url(); ?>js/common.js" type="text/javascript" language="javascript" charset="UTF-8"></script>
        <script src="<?php echo base_url(); ?>js/manage_tables.js" type="text/javascript" language="javascript" charset="UTF-8"></script>
        <script src="<?php echo base_url(); ?>js/swfobject.js" type="text/javascript" language="javascript" charset="UTF-8"></script>
        <script src="<?php echo base_url(); ?>js/date.js" type="text/javascript" language="javascript" charset="UTF-8"></script>
        <script src="<?php echo base_url(); ?>js/datepicker.js" type="text/javascript" language="javascript" charset="UTF-8"></script>
        <script src="<?php echo base_url(); ?>js/bootstrap.js" type="text/javascript" language="javascript" charset="UTF-8"></script>
        <style type="text/css">
            html {
                overflow: auto;
            }
        </style>
        <script type="text/javascript">
            $(document).ready(function(){
                function PB_Update_Time() {
                    var today = new Date();
                    $('#headerclock').html(today.toLocaleString());
                    setTimeout(PB_Update_Time, 1000);
                }
                PB_Update_Time();
            });
        </script>
    </head>
    <body>
        <div id="menubar">
            <div id="menubar_container">
                <div id="menubar_company_info">
                    <span id="company_title"><?php echo $this->config->item('company'); ?></span><br />
                    <span style='font-size:8pt;'><?php echo $this->lang->line('common_powered_by') . ' PB Soft Point Of Sale'; ?></span>
                </div>

                <div id="menubar_navigation">
                    <?php
                    foreach ($allowed_modules->result() as $module) {
                        ?>
                        <div class="menu_item">
                            <a href="<?php echo site_url("$module->module_id"); ?>">
                                <img src="<?php echo base_url() . 'images/menubar/' . $module->module_id . '.png'; ?>" border="0" alt="Menubar Image" /><br />
                                <?php echo $this->lang->line("module_" . $module->module_id) ?></a>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <div id="menubar_footer">
            <div id="menubar_footer_container">
                <?php echo $this->lang->line('common_welcome') . " $user_info->first_name $user_info->last_name! | "; 
                echo anchor("home/logout", $this->lang->line("common_logout"));?>                
                <div id="menubar_date">
                    <?php 
                    if (isset($shiftstarted)){
                    echo anchor("shifts/end_shift/$person_id", 'End Shift'). ' | ';
                }
                
                    echo "<span id='headerclock'>".date('F d, Y h:i a')."</span>"; ?>
                </div>     
            </div>
        </div>
        <div id="content_area_wrapper">
            <div id="content_area">
