<?php
class Emp_model extends CI_Controller
{
    function load_data(){
        $this->db->select('employee.fname,employee.lname,employee.date_of_birth,address.add_line1,address.add_line2,address.country,address.state,address.pincode');
		$this->db->from('employee');
        $this->db->join('emp_address_mapping','employee.eid=emp_address_mapping.eid');
		$this->db->join('address','address.aid=emp_address_mapping.aid');
		$this->db->order_by('employee.eid', 'DESC');
		$data = $this->db->get()->result_array();
		return $data;
    }

    function insert($data){
        $emp_address_mapping=["eid"=>"","aid"=>""];
        foreach($data as $key=>$value){
            if ($key == 'fname' || $key == 'lname' || $key == 'gender' || $key == 'mobile_no') {
                $this->db->insert('employee', array($key => $value));
                echo $this->db->last_query();
                $insert_id = $this->db->insert_id();
                $employee_address_mapping['eid'] = $insert_id;
            }
            if ($key == 'add_line1' || $key == 'add_line2' || $key == 'country' || $key == 'state' || $key == 'pincode') {
                $this->db->insert('address', array($key => $value));
                echo $this->db->last_query();
                $insert_id = $this->db->insert_id();
                $employee_address_mapping['aid'] = $insert_id;
            }
            $this->db->insert('emp_address_mapping', $employee_address_mapping);
            echo $this->db->last_query();    
        }
    }

    function update($data, $id){
        $employee_data = [];
        $address_data = [];
        foreach ($data as $key => $value) {
            if ($key == 'fname' || $key == 'lname' || $key == 'gender' || $key == 'mobile_no') {
                $employee_data[$key] = $value;
            }
            if ($key == 'add_line1' || $key == 'add_line2' || $key == 'country' || $key == 'state' || $key == 'pincode') {
                $address_data[$key] = $value;
            }
        }
        if (!empty($employee_data)) {
            $this->db->where('eid', $id);
            $this->db->update('employee', $employee_data);
            echo $this->db->last_query();
        }
        if (!empty($address_data)) {
            $this->db->where('aid', $id);
            $this->db->update('address', $address_data);
            echo $this->db->last_query();
        }
    }

    function delete($id){
        $this->db->where('eid', $id);
        $this->db->delete('employee');
        echo $this->db->last_query();
        $this->db->where('aid', $id);
        $this->db->delete('address');
        echo $this->db->last_query();
    }

    function search($search_keyword){
        $this->db->select('employee.fname, employee.lname, employee.gender, employee.mobile_no, address.add_line1, address.add_line2, address.country, address.state, address.pincode');
        $this->db->from('employee');
        $this->db->join('emp_address_mapping', 'employee.eid = emp_address_mapping.eid');
        $this->db->join('address', 'address.aid = emp_address_mapping.aid');
        $this->db->like('employee.fname', $search_keyword);
        $this->db->or_like('employee.lname', $search_keyword);
        $this->db->or_like('employee.gender', $search_keyword);
        $this->db->or_like('employee.mobile_no', $search_keyword);
        $this->db->or_like('address.add_line1', $search_keyword);
        $this->db->or_like('address.add_line2', $search_keyword);
        $this->db->or_like('address.country', $search_keyword);
        $this->db->or_like('address.state', $search_keyword);
        $this->db->or_like('address.pincode', $search_keyword);
        $data = $this->db->get()->result_array();
        return $data;
    }
}