<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Get_orders extends CI_Controller {

	public function view(){
		$token = $this->uri->segment(2);

		$token_check = $this->db->query("SELECT * FROM tbl_admin WHERE token = '" . $token . "' AND status = 1")->result();
		if(count($token_check) == 0) {
			echo "Token Incorrect / Unauthorized Access";
		} else {
			$this->view_admin($token_check[0]->area_id, $token);
		}
	}

	public function view_admin($area_id, $token){
		$orders = $this->db->query("SELECT * FROM tbl_orders WHERE lugar = '" . $area_id . "' AND status = 0")->result();
		$ongoing_orders = $this->db->query("SELECT * FROM tbl_orders WHERE lugar = '" . $area_id . "' AND status = 1")->result();
		if(count($orders) > 0){
			$area = $this->db->query("SELECT * FROM tbl_areas WHERE id = " . $orders[0]->lugar)->result();
			$data['area'] = $area[0]->area;

		}

		$data['order_list'] = $orders;
		$data['order_list_ongoing'] = $ongoing_orders;
		$data['orders'] = count($orders);
		$data['token'] = $token;
		$data['content'] = "order/admin";
		$this->load->view('template/layout', $data);
	}

	public function download()
	{
		$token = $this->uri->segment(2);

		$token_check = $this->db->query("SELECT * FROM tbl_admin WHERE token = '" . $token . "' AND status = 1")->result();
		if(count($token_check) == 0) {
			echo "Token Incorrect / Unauthorized Access";
		} else {
			$this->generate_report($token_check[0]->area_id,$token_check[0]->adminname);
		}
		redirect(base_url("get-orders/") . $token);
	}

	function generate_report($area_id, $official){
		$orders = $this->db->query("SELECT * FROM tbl_orders WHERE lugar = '" . $area_id . "' AND status = 0")->result();
		$this->db->query("UPDATE tbl_orders SET status = 1 WHERE lugar = '" . $area_id . "' AND status = 0");
		$area = $this->db->query("SELECT * FROM tbl_areas WHERE id = " . $orders[0]->lugar)->result();
		
		// print_r($orders);

		// die();
		
		$this->load->library("Pdf");
		$pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('ULISYS');
		$pdf->SetTitle(date("Y-m-d H:i:s"));

		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		// add a page

		foreach ($orders as $key => $value) {
		
			$html = '<table>
						<tr>
							<td style="width: 50%;">';

			$html .= '
			<img src="./logo.png" width="100px;"/><br/>
			<table border="0" cellpadding="5">
						<thead>
							<tr>
								<th style="width: 200px;">
			';
			$html .= "
				<strong>Order No. </strong>".$value->order_no."<br />
				<strong>Order Date </strong>".date("F d, Y h:i a",strtotime($value->order_date))."<br /><br />
				<strong>Pangalan : </strong>".$value->name."<br />
				<strong>Contact No : </strong>".$value->contact."<br />
				<strong>Address : </strong>".$value->address."<br />
				<strong>Lugar : </strong>".$area[0]->area."";

				$html .= '</th>
							<th style="border: 1px solid #000;width: 100px;">Isulat ang perang ipinadala sa provider
							</th>
						</tr>
						</thead>
						</table>

						<br /><br />
							';
			

			$html .= '<table border="0" cellpadding="5">
						<thead>
							<tr>
								<th style="line-height:10px; border: 1px solid #000;width: 30px;">QTY</th>
								<th style="line-height:10px; border: 1px solid #000;width: 30px;"></th>
								<th style="line-height:10px; border: 1px solid #000;width: 200px;">ITEM</th>
								<th style="line-height:10px; border: 1px solid #000;width: 50px;">PRESYO</th>
							</tr>
						</thead>
						<tbody>
			';
			$order_list = json_decode($value->order);
			$item_count = count($order_list);
			$service_top = 20;
			$transportation = 30;
			$total = $transportation + $service_top;


			foreach ($order_list as $a => $b) {
				$html .= "<tr>";
				$html .= '	<td style="border-bottom: 1px solid #000;width: 30px;">' . $b->qty ."</td>";
				$html .= '	<td style="border-bottom: 1px solid #000;width: 30px;">' . $b->sukat  ."</td>";
				$html .= '	<td style="border-bottom: 1px solid #000;width: 200px;">' . $b->item . "</td>";
				$html .= '	<td style="border-bottom: 1px solid #000;width: 50px;"></td>';
				$html .= "</tr>";
			}

			$html .= "</tbody></table>Kailangan isulat ng PROVIDER ang presyo nang nabiling produkto sa form na ito.<br /><br /><br />";

			$html .= '
			<strong>Service and Transportation Fee\'s</strong><br />
			<table cellpadding="1">
						<tr>
							<td style="width: 100px;">Delivery Fee : </td>
							<td style="width: 100px;"></td>
							<td style="width: 50px;">P '.number_format($transportation, 2).'</td>
						</tr>
						<tr>
							<td style="width: 100px;">Service Tip : </td>
							<td style="width: 100px;"></td>
							<td style="width: 50px;">P '.number_format($service_top, 2).'</td>
						</tr>
						<tr>
							<td style="width: 100px;"><b>TOTAL : </b></td>
							<td style="width: 100px;"></td>
							<td style="width: 50px;"><b>P '.number_format($total, 2).'</b></td>
						</tr>
						
					</table>
					<br /><br /><br /><br />
			';
			$html .= '<table cellpadding="5">
						<tr>
							<th style="line-height:10px;width: 150px; border-top: 1px solid #000;">RECEIVED : Prointed Name / Signature</th>
							<th style="line-height:10px;width: 10px;"></th>
							<th style="line-height:10px;width: 150px; border-top: 1px solid #000;">PROVIDER : Printed Name / Signature</th>
						</tr>
					</table>
			';


			$html .= '</td><td style="width: 50%;">';

			$html .= '
			<img src="./logo.png" width="100px;"/><br/>
			<table border="0" cellpadding="5">
						<thead>
							<tr>
								<th style="width: 200px;">
			';
			$html .= "
				<strong>Order No. </strong>".$value->order_no."<br />
				<strong>Order Date </strong>".date("F d, Y h:i a",strtotime($value->order_date))."<br /><br />
				<strong>Pangalan : </strong>".$value->name."<br />
				<strong>Contact No : </strong>".$value->contact."<br />
				<strong>Address : </strong>".$value->address."<br />
				<strong>Lugar : </strong>".$area[0]->area."";

				$html .= '</th>
							<th style="border: 1px solid #000;width: 100px;">Isulat ang perang ipinadala sa provider
							</th>
						</tr>
						</thead>
						</table>

						<br /><br />
							';
			

			$html .= '<table border="0" cellpadding="5">
						<thead>
							<tr>
								<th style="line-height:10px; border: 1px solid #000;width: 30px;">QTY</th>
								<th style="line-height:10px; border: 1px solid #000;width: 30px;"></th>
								<th style="line-height:10px; border: 1px solid #000;width: 200px;">ITEM</th>
								<th style="line-height:10px; border: 1px solid #000;width: 50px;">PRESYO</th>
							</tr>
						</thead>
						<tbody>
			';
			$order_list = json_decode($value->order);
			foreach ($order_list as $a => $b) {
				$html .= "<tr>";
				$html .= '	<td style="border-bottom: 1px solid #000;width: 30px;">' . $b->qty ."</td>";
				$html .= '	<td style="border-bottom: 1px solid #000;width: 30px;">' . $b->sukat  ."</td>";
				$html .= '	<td style="border-bottom: 1px solid #000;width: 200px;">' . $b->item . "</td>";
				$html .= '	<td style="border-bottom: 1px solid #000;width: 50px;"></td>';
				$html .= "</tr>";
			}

			$html .= "</tbody></table>Kailangan isulat ng PROVIDER ang presyo nang nabiling produkto sa form na ito.<br /><br /><br />";

			$html .= '
			<strong>Service and Transportation Fee\'s</strong><br />
			<table cellpadding="1">
						<tr>
							<td style="width: 100px;">Delivery Fee : </td>
							<td style="width: 100px;"></td>
							<td style="width: 50px;">P '.number_format($transportation, 2).'</td>
						</tr>
						<tr>
							<td style="width: 100px;">Service Tip : </td>
							<td style="width: 100px;"></td>
							<td style="width: 50px;">P '.number_format($service_top, 2).'</td>
						</tr>
						<tr>
							<td style="width: 100px;"><b>TOTAL : </b></td>
							<td style="width: 100px;"></td>
							<td style="width: 50px;"><b>P '.number_format($total, 2).'</b></td>
						</tr>
						
					</table>
					<br /><br /><br /><br />
			';

			$html .= '<table cellpadding="5">
						<tr>
							<th style="line-height:10px;width: 150px; border-top: 1px solid #000;">RECEIVED : Prointed Name / Signature</th>
							<th style="line-height:10px;width: 10px;"></th>
							<th style="line-height:10px;width: 150px; border-top: 1px solid #000;">PROVIDER : Printed Name / Signature</th>
						</tr>
					</table>
			';


			$html .= "</td></tr></table>";

			$pdf->AddPage('L', 'LETTER');


			$pdf->SetFont('helvetica', '', 7);
			$pdf->writeHTML($html, true, false, false, false, '');
		}
		$pdf->Output( $area[0]->area . "-" . date("Y-m-d") . '.pdf', 'D');

	}


	public function complete()
	{
		$token = $this->uri->segment(2);

		$this->db->query("UPDATE tbl_orders SET status = 2 WHERE order_no = '" . $token . "'");

	}

	public function cancel()
	{
		$token = $this->uri->segment(2);

		$this->db->query("UPDATE tbl_orders SET status = -2 WHERE order_no = '" . $token . "'");

	}


}