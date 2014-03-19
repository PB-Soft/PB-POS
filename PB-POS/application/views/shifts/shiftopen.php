<?php echo form_open("shifts/start_shift/$person_id", array('id' => 'shiftopenform', 'role' => 'form', 'class'=> 'form-horizontal')); ?>  
<div class="form-group">
        <label for="cashamount" class="col-md-4 control-label">Cash in Drawer</label>
        <div class="col-md-8">
            <input type="text" class="form-control" id="cashamount" name="cashamount" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-4 control-label">Start Time</label>
        <div class="col-md-8">
            <p class="form-control-static"><?php echo date('F d, Y  g:i A') . $person_id ?></p>
        </div>
    </div>
    <div class="form-group">
    <div class="col-md-offset-8 col-md-4">
      <button class="btn btn-success float_right">Start Shift</button>
    </div>
  </div>
<?php form_close(); ?>