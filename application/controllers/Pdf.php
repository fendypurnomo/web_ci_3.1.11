<?php
	defined('BASEPATH') or exit('No direct script access allowed');

	/*
	|---------------------------------------------------------|
	| Ukuran Kertas	| Satuan mm	| Satuan cm		| Satuan inci		|
	|---------------------------------------------------------|
	| F4						| 210 x 330	| 21,0 x 33,0 | 8,27 x 12,99	|
	|---------------------------------------------------------|
	*/

	class Pdf extends CI_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->model('json_model');
		}

		public function html2pdf()
		{
			ob_start();
			$content = ob_get_clean();
			$content = "<table border='1' style='border-collapse:collapse;'><thead><tr><th>#</th><th>First</th><th>Last</th><th>Handle</th></tr></thead><tbody>";

			for ($i = 1; $i <= 1000; $i++) {
				$content .= "<tr><td>$i</td><td>$i</td><td>$i</td><td>$i</td></tr>";
			}

			$content .= "</tbody></table>";

			ob_clean();
			require_once('assets/html2pdf/html2pdf.class.php');
			try
			{
				$html2pdf = new HTML2PDF('P', 'F4', 'fr');
				$html2pdf->pdf->SetDisplayMode('fullpage');
				$html2pdf->WriteHTML($content, isset($_GET['vuehtml']));
				$html2pdf->Output('pdf.pdf');
			}
			catch(HTML2PDF_exception $e)
			{
				echo $e;
				exit;
			}
		}

		public function mpdf()
		{
			require_once APPPATH . '/third_party/mpdf/autoload.php';

			$q = $this->json_model->data_villages()->result_array();

			$output = array();

			foreach($q as $r)
			{
				$output[] = array(
					'district_code' => $r['district_code'],
					'district_name' => $r['district_name']
				);
			}

			$json = json_encode($output);
			$array = utf8_encode($json);
			$result = json_decode($array, true);

			$content = "<style>table {border:1px solid; border-collapse:collapse; border-spacing:0;} table thead tr th {border:1px solid; padding:3px;} table tbody tr td {border:1px solid; padding:3px;}</style>";
			$content .= "<table><thead><tr><th>No.</th><th>District Code</th><th>District Name</th></tr></thead><tbody>";

			$no = 1;

			foreach ($result as $row) {
				$content .= "<tr><td>$no</td><td>$row[district_code]</td><td>$row[district_name]</td></tr>";
				$no++;
			}

			$content .= "</tbody></table>";

			$mpdf = new \Mpdf\Mpdf([
				'mode'                => 'utf-8',
				'format'              => [210, 330], //F4
				'orientation'         => 'P',
				'margin_top'          => 10,
				'margin_right'        => 7,
				'margin_bottom'       => 10,
				'margin_left'         => 7,
				'setAutoBottomMargin' => 'stretch'
			]);
			$mpdf->setFooter('{PAGENO}');
			$mpdf->WriteHTML($content);
			$mpdf->Output();
		}

		public function tcpdf()
		{
			require_once APPPATH . '/third_party/tcpdf/tcpdf.php';

			// create new PDF document
			$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

			// set document information
			$pdf->SetCreator(PDF_CREATOR);
			$pdf->SetAuthor('Our Code World');
			$pdf->SetTitle('Example Write Html');

			// set default header data
			//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 006', PDF_HEADER_STRING);

			// set header and footer fonts
			$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
			$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

			// set default monospaced font
			$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

			// set margins
			$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
			//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
			$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

			// set auto page breaks
			$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

			// set image scale factor
			$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

			// add a page
			$pdf->AddPage();
			$html = '<h4>PDF Example</h4><br><p>Welcome to the Jungle</p>';
			
			$data = $this->json_model->data_villages()->result_array();

			$output = array();
			foreach($data as $row)
			{
				$output[] = array(
					'district_code' => $row['district_code'],
					'district_name' => $row['district_name']
				);
			}

			$json = json_encode($output);
			$array = utf8_encode($json);
			$result = json_decode($array, true);

			$html = "<style>table {border:1px solid; border-collapse:collapse; border-spacing:0;} table thead tr th {border:1px solid; padding:3px;} table tbody tr td {border:1px solid; padding:3px;}</style>";
			$html .= "<table><thead><tr><th>No.</th><th>District Code</th><th>District Name</th></tr></thead><tbody>";

			$no = 1;
			foreach ($result as $row) :
			$html .= "<tr><td>$no</td><td>$row[district_code]</td><td>$row[district_name]</td></tr>";
			$no++;
			endforeach;

			$html .= "</tbody></table>";

			$pdf->writeHTML($html, true, false, true, false, '');

			// reset pointer to the last page
			$pdf->lastPage();

			//Close and output PDF document
			$pdf->Output('example_006.pdf', 'I');
		}

		public function wkhtmltopdf()
		{
			
		}
	}
