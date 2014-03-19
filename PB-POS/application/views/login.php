<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" rev="stylesheet" href="<?php echo base_url(); ?>css/login.css" />
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <title>Open Source Point Of Sale <?php echo $this->lang->line('login_login'); ?></title>
        <script src="<?php echo base_url(); ?>js/jquery-1.2.6.min.js" type="text/javascript" language="javascript" charset="UTF-8"></script>
        <script type="text/javascript">
            $(document).ready(function()
            {
                $("#login_form input:first").focus();
            });
        </script>
    </head>
    <body>
        <h1>PB Point Of Sale <?php echo $this->config->item('application_version'); ?></h1>


        <div id="container">
            <?php echo validation_errors(); ?>
            <div id="top">
                <h4><?php echo $this->lang->line('login_login'); ?></h4>
            </div>
            <div id="login_form">
                <?php echo form_open('login', 'class="form-horizontal" role="form"') ?>
                <div class="form-group">
                    <label class="control-label col-sm-3" for="username"><?php echo $this->lang->line('login_username'); ?></label>
                    <div class="col-sm-9">
                        <?php
                        echo form_input(array(
                            'name' => 'username',
                            'id' => 'username',
                            'class' => 'form-control',
                            'style' => ''));
                        ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3" for="password"><?php echo $this->lang->line('login_password'); ?></label>
                    <div class="col-sm-9">
                        <?php
                        echo form_password(array(
                            'name' => 'password',
                            'id' => 'password',
                            'class' => 'form-control',
                            'style' => ''));
                        ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9" style="text-align: right;">
                        <?php echo form_submit('loginButton', 'Login', 'class="btn btn-success"'); ?>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>

    </body>
</html>
