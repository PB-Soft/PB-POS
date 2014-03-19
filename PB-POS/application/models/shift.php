<?php

class Shift extends CI_Model {

    public function shift_open($employee_id) {
        $query = $this->db->get_where('shifts', array('employee_id' => $employee_id));
        if($query->num_rows() >= 1){
            if (array_reverse($query->result_array())[0]['end_time'] == '0000-00-00 00:00:00'){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    function start_shift($person_id, $start_amount) {
        if ($this->shift_open($person_id) == false) {
            $data = array(
                'employee_id' => $person_id,
                'start_amount' => $start_amount,
                'start_time' => date('Y-m-d H:i:s')
            );
            $this->db->insert('shifts', $data);
            return true;
        }else{
            return false;
        }
    }
    
    function close_shift($person_id){
        if ($this->shift_open($person_id) == true) {
            $data = array(
              'end_time' => date('Y-m-d H:i:s')
            );
            $this->db->where('employee_id', $person_id);
            $this->db->update('shifts', $data);
            return true;
        }else{
            return false;
        }
    }
    
    

}
