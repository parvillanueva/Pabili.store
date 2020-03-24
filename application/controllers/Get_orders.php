<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Get_orders extends CI_Controller {

	public function view()
	{
		$token = $this->uri->segment(2);

		$token_check = $this->db->query("SELECT * FROM tbl_admin WHERE token = '" . $token . "' AND status = 1")->result();
		if(count($token_check) == 0) {
			echo "Token Incorrect / Unauthorized Access";
		} else {
			$this->generate_report($token_check[0]->area_id);
		}
	}

	function generate_report($area_id){
		$orders = $this->db->query("SELECT * FROM tbl_orders WHERE lugar = '" . $area_id . "' AND status = 0")->result();
		
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

			$html = '<table border="0" cellpadding="5">
						<thead>
							<tr>
								<th style="width: 400px;">
			';
			$html .= "
				<strong>Order No. </strong>".$value->order_no."<br />
				<strong>Order Date </strong>".date("F d, Y h:i a",strtotime($value->order_date))."<br /><br />
				<strong>Pangalan : </strong>".$value->name."<br />
				<strong>Contact No : </strong>".$value->contact."<br />
				<strong>Address : </strong>".$value->address."<br />
				<strong>Lugar : </strong>".$area[0]->area."";

				$html .= '</th>
							<th style="border: 1px solid #000;width: 140px;">Isulat ang perang ipinadala sa provider
							</th>
						</tr>
						</thead>
						</table>

						<br /><br />
							';
			

			$html .= '<table border="0" cellpadding="5">
						<thead>
							<tr>
								<th style="line-height:10px; border: 1px solid #000;width: 50px;">QTY</th>
								<th style="line-height:10px; border: 1px solid #000;width: 80px;"></th>
								<th style="line-height:10px; border: 1px solid #000;width: 300px;">ITEM</th>
								<th style="line-height:10px; border: 1px solid #000;width: 80px;">PRESYO</th>
							</tr>
						</thead>
						<tbody>
			';
			$order_list = json_decode($value->order);
			foreach ($order_list as $a => $b) {
				$html .= "<tr>";
				$html .= '	<td style="border-bottom: 1px solid #000;width: 50px;">' . $b->qty ."</td>";
				$html .= '	<td style="border-bottom: 1px solid #000;width: 80px;">' . $b->sukat  ."</td>";
				$html .= '	<td style="border-bottom: 1px solid #000;width: 300px;">' . $b->item . "</td>";
				$html .= '	<td style="border-bottom: 1px solid #000;width: 80px;"></td>';
				$html .= "</tr>";
			}

			$html .= "</tbody></table>Kailangan isulat ng PROVIDER ang presyo nang nabiling produkto sa form na ito.<br /><br /><br /><br />";

			$html .= '<table cellpadding="5">
							<tr>
								<th style="width: 100px;">PROVIDER</th>
								<th style="border-bottom: 1px solid #000;width: 200px;"></th>
							</tr>
							<tr>
								<th style="width: 100px;"></th>
								<th style="line-height:10px;width: 200px;">Printed Name / Signature</th>
							</tr>
							<tr>
								<th style="width: 100px;"></th>
								<th style="width: 300px;"></th>
							</tr>
							<tr>
								<th style="width: 100px;"></th>
								<th style="width: 300px;"></th>
							</tr>
							<tr>
								<th style="width: 100px;">RECEIVED</th>
								<th style="border-bottom: 1px solid #000;width: 200px;">'.$value->name.'</th>
							</tr>
							<tr>
								<th style="width: 100px;"></th>
								<th style="line-height:10px;width: 200px;">Printed Name / Signature</th>
							</tr>
					</table>
			';

			$pdf->AddPage('P', 'LETTER');
			$pdf->SetFont('helvetica', '', 10);
			$pdf->writeHTML($html, true, false, false, false, '');
		}
		$pdf->Output( $area[0]->area . "-" . date("Y-m-d") . '.pdf', 'I');

	}

}