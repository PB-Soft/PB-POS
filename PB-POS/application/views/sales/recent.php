<table id="suspended_sales_table">
    <tr>
        <th><?php echo $this->lang->line('sales_sale_id'); ?></th>
        <th><?php echo $this->lang->line('sales_date'); ?></th>
        <th><?php echo $this->lang->line('sales_numofitems'); ?></th>
        <th><?php echo $this->lang->line('sales_employee'); ?></th>
        <th><?php echo $this->lang->line('sales_total'); ?></th>
        <th><?php echo $this->lang->line('sales_viewreceipt'); ?></th>
    </tr>

    <?php
    foreach (array_reverse($recent_sales['summary']) as $recent_sale) {
        ?>
        <tr>
            <td><?php echo $recent_sale['sale_id']; ?></td>
            <td><?php echo date('m/d/Y', strtotime($recent_sale['sale_date'])); ?></td>
            <td><?php echo $recent_sale['items_purchased']; ?></td>
            <td><?php echo $recent_sale['employee_name']; ?></td>
            <td><?php echo $recent_sale['total']; ?></td>
            <td>
                <?php echo anchor(site_url("sales/receipt/{$recent_sale['sale_id']}"), "<div class='btn btn-xs btn-success'>View Receipt</div>") ?>
        </tr>
        <?php
    }
    ?>

</table>