<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Track extends CI_Controller {

	public function view()
	{
		$orderno = $this->uri->segment(2);
		$order_details = $this->db->query("SELECT * FROM tbl_orders WHERE order_no = '" . $orderno . "'")->result();


		$data['order_details'] = $order_details;
		$data['orderno'] = $orderno;
		$data['content'] = "order/track";
		$this->load->view('template/layout', $data);
	}
}