<?php
defined('BASEPATH') OR exit ('No direct script access allowed');

class Emp extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('emp_model');
    }

    function index(){
        $this->load->view('emp_table');
    }

    function load_data(){
        $data=$this->emp_model->load_data();
        echo json_encode($data);
    }

    function insert(){
        $data=array(
            'fname'=>$this->input->post('fname'),
			'lname'=>$this->input->post('lname'),
			'gender'=>$this->input->post('gender'),
            'mobile_no'=>$this->input->post('mobile_no')
        );
        $this->emp_model->insert($data);
    }

    function update(){
        $data = array(
			$this->input->post('table_column')	=>	$this->input->post('value')
        );
		$this->emp_model->update($data, $this->input->post('id'));
    }

    function delete()
	{
		$this->emp_model->delete($this->input->post('id'));
	}

	function search()
	{
		$data=$this->emp_model->search($this->input->post('search_keyword'));
		echo json_encode($data);

	}
	
}