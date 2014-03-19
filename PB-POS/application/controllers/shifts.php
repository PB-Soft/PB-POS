<?php

require_once ("secure_area.php");

class Shifts extends Secure_area {

    function __construct() {
        parent::__construct('sales');
    }

    function start_shift($person_id) {
        $data = array(
                'employee_id' => $person_id,
                'start_amount' => $this->input->post('cashamount'),
                'start_time' => date('Y-m-d H:i:s')
            );
            $this->db->insert('shifts', $data);
          
            redirect('sales');
    }
    
    function end_shift($person_id) {
        $data = array(
                'end_time' => date('Y-m-d H:i:s')
            );
            $this->db->where('employee_id', $person_id);
            $this->db->update('shifts', $data);
          
            redirect('sales');
    }
}
