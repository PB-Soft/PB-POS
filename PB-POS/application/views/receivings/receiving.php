<?php $this->load->view("partial/header"); ?>

<div id="page_title" style="margin-bottom:8px;"><?php echo $this->lang->line('recvs_register'); ?></div>

<?php
if (isset($error)) {
    echo "<div class='error_message'>" . $error . "</div>";
}
?>



<div id="register_wrapper">
    <?php echo form_open("receivings/change_mode", array('id' => 'mode_form')); ?>
    <span><?php echo $this->lang->line('recvs_mode') ?></span>
    <?php
    echo '<div class="btn-group btn-group-sm" style="margin-left: 10px;">';
    foreach ($modes as $key => $indmode) {
        echo '<label for="pbmode_' . $key . '" class="btn btn-default" style="width: 100px;">';
        echo form_radio('mode', $key, ($mode == $key), 'onchange="$(\'#mode_form\').submit();" id="pbmode_' . $key . '" class="pbbtn-radio"');
        echo $indmode . '</label>';
    }
    ?>
</div>
</form>
<?php echo form_open("receivings/add", array('id' => 'add_item_form')); ?>
<label id="item_label" for="item">

    <?php
    if ($mode == 'receive') {
        echo $this->lang->line('recvs_find_or_scan_item');
    } else {
        echo $this->lang->line('recvs_find_or_scan_item_or_receipt');
    }
    ?>
</label>
<?php echo form_input(array('name' => 'item', 'class' => 'form-control input-sm', 'style' => 'width: 300px; display: inline-block', 'id' => 'item', 'size' => '6')); ?>
<div id="new_item_button_register" >
    <?php
    echo anchor("items/view/-1/width:360", "<div class='btn-sm btn btn-primary'>" . $this->lang->line('sales_new_item') . "</div>", array('class' => 'thickbox none', 'title' => $this->lang->line('sales_new_item')));
    ?>
</div>

</form>

<!-- Receiving Items List -->

<table id="register">
    <thead>
        <tr>
            <th style="width:11%;"><?php echo $this->lang->line('common_delete'); ?></th>

            <th style="width:30%;"><?php echo $this->lang->line('recvs_item_name'); ?></th>
            <th style="width:11%;"><?php echo $this->lang->line('recvs_cost'); ?></th>
            <th style="width:11%;"><?php echo $this->lang->line('recvs_quantity'); ?></th>
            <th style="width:11%;"><?php echo $this->lang->line('recvs_discount'); ?></th>
            <th style="width:15%;"><?php echo $this->lang->line('recvs_total'); ?></th>
            <th style="width:11%;"><?php echo $this->lang->line('recvs_edit'); ?></th>
        </tr>
    </thead>
    <tbody id="cart_contents">
        <?php
        if (count($cart) == 0) {
            ?>
            <tr><td colspan='7'>
                    <div class='warning_message' style='padding:7px;'><?php echo $this->lang->line('sales_no_items_in_cart'); ?></div>
            </tr></tr>
            <?php
        } else {
            foreach (array_reverse($cart, true) as $line => $item) {
                echo form_open("receivings/edit_item/$line");
                ?>
                <tr>
                    <td><?php echo anchor("receivings/delete_item/$line", 'X', 'class="btn btn-danger" style="border-radius: 30px; font-size: 24px;line-height:32px; font-weight: bold; padding: 0; height:32px; width: 32px; text-align: center"'); ?></td>

                    <td style="align:center;"><?php echo $item['name']; ?><br />

                        <?php
                        echo $item['description'];
                        echo form_hidden('description', $item['description']);
                        ?>
                        <br />


                        <?php
                        if ($items_module_allowed) {
                            ?>
                        <td><?php echo form_input(array('name' => 'price', 'class' => 'form-control input-sm', 'value' => $item['price'], 'size' => '6')); ?></td>
                        <?php
                    } else {
                        ?>
                        <td><?php echo $item['price']; ?></td>
                        <?php echo form_hidden('price', $item['price']); ?>
                        <?php
                    }
                    ?>
                    <td>
                        <?php
                        echo form_input(array('name' => 'quantity', 'class' => 'form-control input-sm', 'value' => $item['quantity'], 'size' => '2'));
                        ?>
                    </td>


                    <td><?php echo form_input(array('name' => 'discount', 'class' => 'form-control input-sm', 'value' => $item['discount'], 'size' => '3')); ?></td>
                    <td><?php echo to_currency($item['price'] * $item['quantity'] - $item['price'] * $item['quantity'] * $item['discount'] / 100); ?></td>
                    <td><?php echo form_submit("edit_item", $this->lang->line('sales_edit_item'), 'class="btn btn-default"'); ?></td>
                </tr>
                </form>
                <?php
            }
        }
        ?>
    </tbody>
</table>
</div>

<!-- Overall Receiving -->

<div id="overall_sale">
    <?php
    if (isset($supplier)) {
        echo $this->lang->line("recvs_supplier") . ': <b>' . $supplier . '</b><br />';
        echo anchor("receivings/delete_supplier", '[' . $this->lang->line('common_delete') . ' ' . $this->lang->line('suppliers_supplier') . ']');
    } else {
        echo form_open("receivings/select_supplier", array('id' => 'select_supplier_form'));
        ?>
        <label id="supplier_label" for="supplier"><?php echo $this->lang->line('recvs_select_supplier'); ?></label>
        <?php echo form_input(array('name' => 'supplier', 'id' => 'supplier', 'size' => '30', 'value' => $this->lang->line('recvs_start_typing_supplier_name'))); ?>
    </form>
    <div style="margin-top:5px;text-align:center;">
        <h3 style="margin: 5px 0 5px 0"><?php echo $this->lang->line('common_or'); ?></h3>
        <?php
        echo anchor("suppliers/view/-1/width:350", "<div class='btn btn-default btn-small' style='margin:0 auto;'><span>" . $this->lang->line('recvs_new_supplier') . "</span></div>", array('class' => 'thickbox none', 'title' => $this->lang->line('recvs_new_supplier')));
        ?>
    </div>
    <div class="clearfix">&nbsp;</div>
    <?php
}
?>

<div id='sale_details'>
    <div style="background-color: #ffffff;">
        <div style='width:50%;vertical-align: middle;'><?php echo $this->lang->line('sales_total'); ?>:</div>
        <div style="width:45%;font-weight:600; font-size: 24px; vertical-align: middle;"><?php echo to_currency($total); ?></div>
    </div>
</div>
<?php
if (count($cart) > 0) {
    ?>
    <div id="finish_sale">
        <?php echo form_open("receivings/complete", array('id' => 'finish_sale_form')); ?>
        <br />
        <label id="comment_label" for="comment"><?php echo $this->lang->line('common_comments'); ?>:</label>
        <?php echo form_textarea(array('name' => 'comment','class' => 'form-control', 'value' => '', 'rows' => '4', 'cols' => '23')); ?>
        <br />
        <div style="margin-top: 5px;">
            <div style='width:50%; vertical-align: middle; display: inline-block'>
                <?php echo $this->lang->line('sales_payment') . ':   '; ?>
            </div>
            <div style='width:45%; vertical-align: middle;' class="btn-group btn-group-vertical">
                    <?php
                    //echo form_dropdown('payment_type', $payment_options);
                    foreach ($payment_options as $key => $payopt) {
                        echo '<label for="pbpayopt_' . $key . '" class="btn btn-default btn-block">';
                        echo form_radio('payment_type', $key, ($key === 'Cash'), 'id="pbpayopt_' . $key . '" class="pbbtn-radio"');
                        echo $payopt . '</label>';
                    }
                    ?>
                    </div>
        </div>
        <div style="margin-top: 5px;">
            <div style='width:50%; vertical-align: middle;display: inline-block;'>
                <?php echo $this->lang->line('sales_amount_tendered') . ':   '; ?>
            </div>
            <div style='width:45%; vertical-align: middle; display: inline-block'>
                <?php
                    echo form_input(array('name' => 'amount_tendered','class' => 'form-control', 'value' => '', 'size' => '10'));
                    ?>
            </div>
        </div>
        
        <br />
        
    </div>
    
    </form>

    <?php echo form_open("receivings/cancel_receiving", array('id' => 'cancel_sale_form','style'=>'display:inline-block; width: 49%')); ?>
    <div class='btn btn-danger' id='cancel_sale_button' style='width: 100%;margin-top:5px;'>
        Cancel
    </div>
    </form>
    <?php echo "<div class='btn btn-success' id='finish_sale_button' style='width: 49%;margin-top:5px;'>" . $this->lang->line('recvs_complete_receiving') . "</div>";
        ?>
    </div>
    <?php
}
?>

</div>
<div class="clearfix" style="margin-bottom:30px;">&nbsp;</div>


<?php $this->load->view("partial/footer"); ?>


<script type="text/javascript" language="javascript">
    $(document).ready(function()
    {
        $('.pbbtn-radio').each(function() {

            if ($(this).attr('checked')) {
                $(this).parents('label').css('color', 'rgb(51, 51, 51)');
                $(this).parents('label').css('background-color', 'rgb(235, 235, 235)');
                $(this).parents('label').css('border-color', 'rgb(173, 173, 173)');
            } else {
                $(this).parents('label').css('color', 'rgb(51, 51, 51)');
                $(this).parents('label').css('background-color', 'rgb(255, 255, 255)');
                $(this).parents('label').css('border-color', 'rgb(204, 204, 204)');
            }
        });
        $('.pbbtn-radio').change(function() {
            if ($(this).attr('checked')) {
                var name = $(this).attr('name');
                $('.pbbtn-radio[name=' + name + ']').each(function() {
                    $(this).parents('label').css('color', 'rgb(51, 51, 51)');
                    $(this).parents('label').css('background-color', 'rgb(255, 255, 255)');
                    $(this).parents('label').css('border-color', 'rgb(204, 204, 204)');
                });
                $(this).parents('label').css('color', 'rgb(51, 51, 51)');
                $(this).parents('label').css('background-color', 'rgb(235, 235, 235)');
                $(this).parents('label').css('border-color', 'rgb(173, 173, 173)');
            } else {
                $(this).parents('label').css('color', 'rgb(51, 51, 51)');
                $(this).parents('label').css('background-color', 'rgb(255, 255, 255)');
                $(this).parents('label').css('border-color', 'rgb(204, 204, 204)');
            }
        });
        $("#item").autocomplete('<?php echo site_url("receivings/item_search"); ?>',
                {
                    minChars: 0,
                    max: 100,
                    delay: 10,
                    selectFirst: false,
                    formatItem: function(row) {
                        return row[1];
                    }
                });

        $("#item").result(function(event, data, formatted)
        {
            $("#add_item_form").submit();
        });

        $('#item').focus();

        $('#item').blur(function()
        {
            $(this).attr('value', "<?php echo $this->lang->line('sales_start_typing_item_name'); ?>");
        });

        $('#item,#supplier').click(function()
        {
            $(this).attr('value', '');
        });

        $("#supplier").autocomplete('<?php echo site_url("receivings/supplier_search"); ?>',
                {
                    minChars: 0,
                    delay: 10,
                    max: 100,
                    formatItem: function(row) {
                        return row[1];
                    }
                });

        $("#supplier").result(function(event, data, formatted)
        {
            $("#select_supplier_form").submit();
        });

        $('#supplier').blur(function()
        {
            $(this).attr('value', "<?php echo $this->lang->line('recvs_start_typing_supplier_name'); ?>");
        });

        $("#finish_sale_button").click(function()
        {
            if (confirm('<?php echo $this->lang->line("recvs_confirm_finish_receiving"); ?>'))
            {
                $('#finish_sale_form').submit();
            }
        });

        $("#cancel_sale_button").click(function()
        {
            if (confirm('<?php echo $this->lang->line("recvs_confirm_cancel_receiving"); ?>'))
            {
                $('#cancel_sale_form').submit();
            }
        });


    });

    function post_item_form_submit(response)
    {
        if (response.success)
        {
            $("#item").attr("value", response.item_id);
            $("#add_item_form").submit();
        }
    }

    function post_person_form_submit(response)
    {
        if (response.success)
        {
            $("#supplier").attr("value", response.person_id);
            $("#select_supplier_form").submit();
        }
    }

</script>