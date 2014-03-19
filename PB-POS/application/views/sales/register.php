<?php $this->load->view("partial/header"); ?>
<div id="page_title" style="margin-bottom:8px;"><?php echo $this->lang->line('sales_register'); ?></div>
<?php
if (isset($error)) {
    echo "<div class='error_message'>" . $error . "</div>";
}

if (isset($warning)) {
    echo "<div class='warning_mesage'>" . $warning . "</div>";
}

if (isset($success)) {
    echo "<div class='success_message'>" . $success . "</div>";
}
?>
<div id="register_wrapper">
    <?php
    if (!$shiftstarted) {
        echo anchor("sales/startshift/$person_id/width:425", "<div class='btn btn-lg btn-primary ' id='startshifthidden' style='margin: 15px 0 45px 380px;'>" . 'Start Shift' . "</div>", array('class' => 'thickbox none', 'title' => 'Start Shift'));
        echo '</div>';        
    } else {
        echo form_open("sales/change_mode", array('id' => 'mode_form'));
        ?>
        <span><?php echo $this->lang->line('sales_mode') ?></span>
        <?php
        echo '<div class="btn-group btn-group-sm" style="margin-left: 10px;">';
        foreach ($modes as $key => $indmode) {
            echo '<label for="pbmode_' . $key . '" class="btn btn-default" style="width: 100px;">';
            echo form_radio('mode', $key, ($mode == $key), 'onchange="$(\'#mode_form\').submit();" id="pbmode_' . $key . '" class="pbbtn-radio"');
            echo $indmode . '</label>';
        }
        echo '</div>'
        ?>
    <?php
    echo anchor("sales/suspended/width:425", "<div class='btn btn-xs btn-primary ' style='float:right; margin-right:5px; margin-top: 5px;'>" . $this->lang->line('sales_suspended_sales') . "</div>", array('class' => 'thickbox none', 'title' => $this->lang->line('sales_suspended_sales')));
    echo anchor("sales/viewrecent/width:425", "<div class='btn btn-xs btn-primary ' style='float:right; margin-right:5px; margin-top: 5px;'>" . $this->lang->line('sales_recent_sales') . "</div>", array('class' => 'thickbox none', 'title' => $this->lang->line('sales_recent_sales')));
    ?>

    </form>
    <?php echo form_open("sales/add", array('id' => 'add_item_form')); ?>
    <label id="item_label" for="item">

        <?php
        if ($mode == 'sale') {
            echo $this->lang->line('sales_find_or_scan_item');
        } else {
            echo $this->lang->line('sales_find_or_scan_item_or_receipt');
        }
        ?>
    </label>
    <?php echo form_input(array('name' => 'item', 'id' => 'item', 'class' => 'form-control', 'style' => 'width:300px; display: inline', 'placeholder' => $this->lang->line('sales_start_typing_item_name'))); ?>

    <?php
    echo anchor("items/view/-1/width:360", "<div class='btn-sm btn btn-primary' id='new_item_button_register'>" . $this->lang->line('sales_new_item') . "</div>", array('class' => 'thickbox none', 'title' => $this->lang->line('sales_new_item')));
    ?>

    </form>
    <table id="register">
        <thead>
            <tr>
                <th style="width:11%;"><?php echo $this->lang->line('common_delete'); ?></th>
                <th style="width:25%;"><?php echo $this->lang->line('sales_item_number'); ?></th>
                <th style="width:30%;"><?php echo $this->lang->line('sales_item_name'); ?></th>
                <th style="width:16%;"><?php echo $this->lang->line('sales_price'); ?></th>
                <th style="width:11%;"><?php echo $this->lang->line('sales_quantity'); ?></th>
                <th style="width:11%;"><?php echo $this->lang->line('sales_discount'); ?></th>
                <th style="width:15%;"><?php echo $this->lang->line('sales_total'); ?></th>
                <th style="width:11%;"></th>
            </tr>
        </thead>
        <tbody id="cart_contents">
            <?php
            if (count($cart) == 0) {
                ?>
                <tr><td colspan='8'>
                        <div class='warning_message' style='padding:7px;'><?php echo $this->lang->line('sales_no_items_in_cart'); ?></div>
                </tr></tr>
                <?php
            } else {
                foreach (array_reverse($cart, true) as $line => $item) {
                    $cur_item_info = $this->Item->get_info($item['item_id']);
                    echo form_open("sales/edit_item/$line");
                    ?>
                    <tr>
                        <td><?php echo anchor("sales/delete_item/$line", 'X', 'class="btn btn-danger" style="border-radius: 30px; font-size: 24px;line-height:32px; font-weight: bold; padding: 0; height:32px; width: 32px; text-align: center"'); ?></td>
                        <td><?php echo $item['item_number']; ?></td>
                        <td style="align:center;"><?php echo $item['name']; ?><br /> [<?php echo $cur_item_info->quantity; ?> in stock]</td>



                        <?php
                        if ($items_module_allowed || ($cur_item_info->is_editable)) {
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
                            if ($item['is_serialized'] == 1) {
                                echo $item['quantity'];
                                echo form_hidden('quantity', $item['quantity']);
                            } else {
                                echo form_input(array('name' => 'quantity', 'class' => 'form-control input-sm', 'value' => $item['quantity'], 'size' => '2'));
                            }
                            ?>
                        </td>

                        <td><?php echo form_input(array('name' => 'discount', 'value' => $item['discount'], 'size' => '3', 'class' => 'form-control input-sm')); ?></td>
                        <td><?php echo to_currency($item['price'] * $item['quantity'] - $item['price'] * $item['quantity'] * $item['discount'] / 100); ?></td>
                        <td><?php echo form_submit("edit_item", $this->lang->line('sales_update_item'), 'class="btn btn-default"'); ?></td>
                    </tr>
                    <tr>
                        <td style="color:#2F4F4F";><?php echo $this->lang->line('sales_description_abbrv') . ':'; ?></td>
                        <td colspan=2 style="text-align:left;">

                            <?php
                            if ($item['allow_alt_description'] == 1) {
                                echo form_input(array('name' => 'description', 'value' => $item['description'], 'size' => '20'));
                            } else {
                                if ($item['description'] != '') {
                                    echo $item['description'];
                                    echo form_hidden('description', $item['description']);
                                } else {
                                    echo 'None';
                                    echo form_hidden('description', '');
                                }
                            }
                            ?>
                        </td>
                        <td>&nbsp;</td>
                        <td style="color:#2F4F4F";>
                            <?php
                            if ($item['is_serialized'] == 1) {
                                echo $this->lang->line('sales_serial') . ':';
                            }
                            ?>
                        </td>
                        <td colspan=3 style="text-align:left;">
                            <?php
                            if ($item['is_serialized'] == 1) {
                                echo form_input(array('name' => 'serialnumber', 'value' => $item['serialnumber'], 'size' => '20'));
                            } else {
                                echo form_hidden('serialnumber', '');
                            }
                            ?>
                        </td>


                    </tr>
                    <tr style="height:3px">
                        <td colspan=8 style="background-color:white"> </td>
                    </tr>		</form>
                    <?php
                }
            }
            ?>
        </tbody>
    </table>
    </div>


    <div id="overall_sale">
        <?php
        if ($this->Appconfig->get('use_customers')) {

            if (isset($customer)) {
                echo $this->lang->line("sales_customer") . ': <b>' . $customer . '</b><br />';
                echo anchor("sales/remove_customer", '[' . $this->lang->line('common_remove') . ' ' . $this->lang->line('customers_customer') . ']');
            } else {
                echo form_open("sales/select_customer", array('id' => 'select_customer_form'));
                ?>
                <label id="customer_label" for="customer"><?php echo $this->lang->line('sales_select_customer'); ?></label>
                <?php echo form_input(array('name' => 'customer', 'id' => 'customer', 'class' => 'form-control input-sm', 'size' => '30', 'value' => $this->lang->line('sales_start_typing_customer_name'))); ?>
            </form>
            <div style="padding:5px 0 15px; margin:0 -5px; text-align:center; border-bottom: 1px solid #2D6391">
                <h3 style="margin: 5px 0 5px 0"><?php echo $this->lang->line('common_or'); ?></h3>
                <?php
                echo anchor("customers/view/-1/width:350", "<div class='btn btn-default btn-small' style='margin:0 auto;'><span>" . $this->lang->line('sales_new_customer') . "</span></div>", array('class' => 'thickbox none', 'title' => $this->lang->line('sales_new_customer')));
                ?>
            </div>
            <?php
        }
    }
    ?>

    <div id='sale_details'>
        <div>
            <div  style="width:50%;"><?php echo $this->lang->line('sales_sub_total'); ?>:</div>
            <div style="width:45%;font-weight:bold;"><?php echo to_currency($subtotal); ?></div>
        </div>
        <?php foreach ($taxes as $name => $value) { ?>
            <div>
                <div  style='width:50%;'><?php echo $name; ?>:</div>
                <div  style="width:45%;font-weight: bold; "><?php echo to_currency($value); ?></div>
            </div>
        <?php }; ?>
        <div style="background-color: #ffffff; margin-top: 5px;">
            <div style='width:50%; vertical-align: middle;'><?php echo $this->lang->line('sales_total'); ?>:</div>
            <div  style="width:45%;font-weight:600; font-size: 24px; vertical-align: middle;"><?php echo to_currency($total); ?></div>
        </div>
    </div>




    <?php
// Only show this part if there are Items already in the sale.
    if (count($cart) > 0) {
        ?>

        <div id="Cancel_sale" >
            <?php echo form_open("sales/cancel_sale", array('id' => 'cancel_sale_form')); ?>

            <div class='btn btn-danger btn-sm' id='cancel_sale_button' style="width: 49%">
                <?php echo $this->lang->line('sales_cancel_sale'); ?>
            </div>
            <?php echo "<div class='btn btn-warning btn-sm' id='suspend_sale_button' style='width: 49%' >" . $this->lang->line('sales_suspend_sale') . "</div>"; ?>
        </div>
        </form>
        <?php
        // Only show this part if there is at least one payment entered.
        if (count($payments) > 0) {
            ?>
            <div id="finish_sale">
                <?php echo form_open("sales/complete", array('id' => 'finish_sale_form')); ?>
                <label id="comment_label" for="comment"><?php echo $this->lang->line('common_comments'); ?>:</label>
                <?php echo form_textarea(array('name' => 'comment', 'id' => 'comment', 'value' => $comment, 'rows' => '4', 'cols' => '23', 'class' => 'form-control')); ?>
                <br />

                <?php
                if (!empty($customer_email)) {
                    echo $this->lang->line('sales_email_receipt') . ': ' . form_checkbox(array(
                        'name' => 'email_receipt',
                        'id' => 'email_receipt',
                        'value' => '1',
                        'checked' => (boolean) $email_receipt,
                    )) . '<br />(' . $customer_email . ')<br />';
                }

                if ($payments_cover_total) {
                    echo "<div class='btn btn-success btn-lg btn-block' id='finish_sale_button' >" . $this->lang->line('sales_complete_sale') . "</div>";
                }
                ?>
            </div>
            </form>
            <?php
        }
        ?>





        <div id="Payment_Types" >
            <div id='sale_details'>
                <div>
                    <div  style="width:50%;"><?php echo 'Total Payments:' ?>:</div>
                    <div style="width:45%;font-weight:bold; display:"><?php echo to_currency($payments_total); ?></div>
                </div>

                <div style="margin-top: 5px;">
                    <div style='width:50%; vertical-align: middle;'><?php echo 'Amount Due:' ?></div>
                    <div  style="width:45%;font-weight:600; font-size: 24px; vertical-align: middle;"><?php echo to_currency($amount_due); ?></div>
                </div>

                <?php echo form_open("sales/add_payment", array('id' => 'add_payment_form')); ?>
                <div style="margin-top: 5px;">
                    <div style='width:50%; vertical-align: middle;'>
                        <?php echo $this->lang->line('sales_payment') . ':   '; ?>
                    </div>
                    <div style='width:45%; vertical-align: middle;' class="btn-group btn-group-vertical">
                        <?php
                        //echo form_dropdown('payment_type', $payment_options, array(), 'id="payment_types"'); 
                        foreach ($payment_options as $key => $payopt) {
                            if ($key != 'Gift Card' || $this->Appconfig->get('use_giftcards')) {
                                echo '<label for="pbpayopt_' . $key . '" class="btn btn-default btn-block">';
                                echo form_radio('payment_type', $key, ($key === 'Cash'), 'id="pbpayopt_' . $key . '" class="pbbtn-radio"');
                                echo $payopt . '</label>';
                            }
                        }
                        ?>
                    </div>
                </div>
                <div style="margin-top: 5px;">
                    <div style='width:50%; vertical-align: middle;'>
                        <span id="amount_tendered_label"><?php echo $this->lang->line('sales_amount_tendered') . ': '; ?></span>
                    </div>
                    <div style='width:45%; vertical-align: middle;'>
                        <?php echo form_input(array('name' => 'amount_tendered', 'id' => 'amount_tendered', 'value' => to_currency_no_money($amount_due), 'class' => 'form-control')); ?>
                    </div>
                </div>
                <div class='btn btn-lg btn-info btn-block' id='add_payment_button' style="margin-top: 5px;">
                    <?php echo $this->lang->line('sales_add_payment'); ?>
                </div>
            </div>
            </form>

            <?php
            // Only show this part if there is at least one payment entered.
            if (count($payments) > 0) {
                ?>
                <table id="register">
                    <thead>
                        <tr>
                            <th style="width:11%;"><?php echo $this->lang->line('common_delete'); ?></th>
                            <th style="width:60%;"><?php echo 'Type'; ?></th>
                            <th style="width:18%;"><?php echo 'Amount'; ?></th>


                        </tr>
                    </thead>
                    <tbody id="payment_contents">
                        <?php
                        foreach ($payments as $payment_id => $payment) {
                            echo form_open("sales/edit_payment/$payment_id", array('id' => 'edit_payment_form' . $payment_id));
                            ?>
                            <tr>
                                <td><?php echo anchor("sales/delete_payment/$payment_id", $this->lang->line('common_delete'), 'class="btn btn-link"'); ?></td>

                                <td><?php echo $payment['payment_type']; ?></td>
                                <td style="text-align:right;"><?php echo to_currency($payment['payment_amount']); ?></td>


                            </tr>
                            </form>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
                <br />
                <?php
            }
            ?>



        </div>

        <?php
    }
    ?>
    </div>
    <div class="clearfix" style="margin-bottom:30px;">&nbsp;</div>

<?php } ?>
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
        $("#item").autocomplete('<?php echo site_url("sales/item_search"); ?>',
                {
                    minChars: 0,
                    max: 100,
                    selectFirst: false,
                    delay: 10,
                    formatItem: function(row) {
                        return row[1];
                    }
                });

        $("#item").result(function(event, data, formatted)
        {
            $("#add_item_form").submit();
        });

        $('#item').focus();

        

        $("#customer").autocomplete('<?php echo site_url("sales/customer_search"); ?>',
                {
                    minChars: 0,
                    delay: 10,
                    max: 100,
                    formatItem: function(row) {
                        return row[1];
                    }
                });

        $("#customer").result(function(event, data, formatted)
        {
            $("#select_customer_form").submit();
        });

        $('#customer').blur(function()
        {
            $(this).attr('value', "<?php echo $this->lang->line('sales_start_typing_customer_name'); ?>");
        });

        $('#comment').change(function()
        {
            $.post('<?php echo site_url("sales/set_comment"); ?>', {comment: $('#comment').val()});
        });

        $('#email_receipt').change(function()
        {
            $.post('<?php echo site_url("sales/set_email_receipt"); ?>', {email_receipt: $('#email_receipt').is(':checked') ? '1' : '0'});
        });


        $("#finish_sale_button").click(function()
        {
            $('#finish_sale_form').submit();
        });

        $("#suspend_sale_button").click(function()
        {
            if (confirm('<?php echo $this->lang->line("sales_confirm_suspend_sale"); ?>'))
            {
                $('#cancel_sale_form').attr('action', '<?php echo site_url("sales/suspend"); ?>');
                $('#cancel_sale_form').submit();
            }
        });

        $("#cancel_sale_button").click(function()
        {
            if (confirm('<?php echo $this->lang->line("sales_confirm_cancel_sale"); ?>'))
            {
                $('#cancel_sale_form').attr('action', '<?php echo site_url("sales/cancel_sale"); ?>');
                $('#cancel_sale_form').submit();
            }
        });

        $("#add_payment_button").click(function()
        {
            $('#add_payment_form').submit();
        });

        $("#payment_types").change(checkPaymentTypeGiftcard).ready(checkPaymentTypeGiftcard);
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
            $("#customer").attr("value", response.person_id);
            $("#select_customer_form").submit();
        }
    }

    function checkPaymentTypeGiftcard()
    {
        if ($("#payment_types").val() == "<?php echo $this->lang->line('sales_giftcard'); ?>")
        {
            $("#amount_tendered_label").html("<?php echo $this->lang->line('sales_giftcard_number'); ?>");
            $("#amount_tendered").val('');
            $("#amount_tendered").focus();
        }
        else
        {
            $("#amount_tendered_label").html("<?php echo $this->lang->line('sales_amount_tendered'); ?>");
        }
    }

</script>
