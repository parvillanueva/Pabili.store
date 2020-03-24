<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {

	public function index()
	{
		$data['content'] = "order/policy";
		$this->load->view('template/layout', $data);
	}

	public function form()
	{

		$this->manage_order($_POST);
		
	}

	public function order_details(){
		$lugar= $this->db->query("SELECT id, town FROM tbl_towns WHERE status = 1")->result();
		$list_lugar = array();
		foreach ($lugar as $key => $value) {
			$brgy = $this->db->query("SELECT id,  area FROM tbl_areas WHERE town_id = " . $value->id)->result();
			$list_lugar[] = array(
				"Town"	=> $value->town,
				"Brgy"	=> $brgy
			);
		}

		$data['lugar'] = $list_lugar;
		$data['content'] = "order/form";
		$this->load->view('template/layout', $data);
	}

	public function list(){
		$data['content'] = "order/listing";
		$this->load->view('template/layout', $data);
	}

	function manage_order($post){
		$count = count($post['qty']);
		$order = array();
		for ($i=0; $i <$count ; $i++) { 
			$order[] = array(
				"qty"	=> $post['qty'][$i],
				"sukat"	=> $post['sukat'][$i],
				"item"	=> $post['item'][$i]
			);
		}
		$this->session->set_userdata('order_list', json_encode($order));
		redirect(base_url("order/order_details"));
	}

	public function submit(){
		echo "<pre>";
		$data = array(
			"order_date"	=> date("Y-m-d H:i:s"),
			"order_no"		=> time(),
			"name"			=> $this->input->post("pangalan"),
			"contact"		=> $this->input->post("contactno"),
			"lugar"			=> $this->input->post("lugar"),
			"address"		=> $this->input->post("address"),
			"order"			=> $this->session->userdata('order_list'),
			"status"		=> 0
		);

		$this->db->insert('tbl_orders', $data);

		$this->session->sess_destroy();

		redirect(base_url("order/thankyou"));

	}

	public function thankyou(){
		$data['content'] = "order/thankyou";
		$this->load->view('template/layout', $data);
	}
}
