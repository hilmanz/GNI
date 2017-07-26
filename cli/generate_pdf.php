<?php
/*
* tool for generating PDF for all GNI data
*/
include_once "../bootstrap.php";


////CONFIGURATION/////////////
Logger::configure('logger.config.xml');
 
// Fetch a logger, it will inherit settings from the root logger
$log = Logger::getLogger('myLogger');
 
// Start logging

$log->info("Generate PDF.");    // Not logged because INFO < WARN


$start = 0;
$limit = 10;
$n_total = 0;
$output = $PDF_DOWNLOAD_DIR;


/////////END OF CONFIGURATIONS/////////////////

$html = "<table cellpadding=\"3\" border=\"1\"><tr>
			<td style=\"width:50px\">No.</td>
			<td></td>
			<td>No. Inventory</td>
			<td>Judul</td>
			<td>Artis</td>
			<td>Tahun</td>
			<td>Kondisi</td>
			<td>Status</td>
		</tr>";

$no = 1;


//tcpdf
// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetTitle('Koleksi Karya Seni Galeri Nasional Indonesia');
$pdf->SetSubject('Update Terakhir : '.date("d/m/Y H:i:s"));
$pdf->SetKeywords('GNI, Koleksi, karya, seni, data');

// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 006', PDF_HEADER_STRING);
$pdf->SetHeaderData(null, null, 'Koleksi Karya Seni Galeri Nasional Indonesia','Update Terakhir : '.date("d/m/Y H:i:s"));
// set header and footer fonts
//$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set font
$pdf->SetFont('dejavusans', '', 10);

while(1){
$collections = $db->query("SELECT a.id,a.name,slug, invent_no, matrial, 
				YEAR(create_date) AS yr, obtain, created,modified, image,
				b.name AS artist_name,b.descr AS artist_desc,
				c.name AS art_cond,
				d.name AS existance
				FROM collections a
				INNER JOIN artists b ON a.artist_id = b.id 
				INNER JOIN art_conditions c
				ON c.id = a.art_condition_id
				INNER JOIN exist_stats d
				ON d.id = a.exist_stat_id
				INNER JOIN storages e
				ON e.id = a.storage_id
				ORDER BY a.id LIMIT {$start},{$limit}");
	
	if(sizeof($collections)==0){
		$log->info('completed');
		
		break;
	}else{
		$str = $html;
		try{
			for($i=0;$i<sizeof($collections);$i++){
				set_time_limit(0);
				$filepath = '../public/content/'.$collections[$i]['image'];
				if(file_exists($filepath)){
					$img = '<img src="'.$filepath.'" width="100px"/>';	
				}else{
					$img = '';
				}
				$str.="<tr>\n<td width='40px' style='width:40px'>\n{$no}</td>\n
				<td>\n{$img}\n
				</td>\n
				<td>{$collections[$i]['invent_no']}</td>\n
				<td>{$collections[$i]['name']}</td>\n
				<td>{$collections[$i]['artist_name']}</td>\n
				<td>{$collections[$i]['yr']}</td>\n
				<td>{$collections[$i]['art_cond']}</td>\n
				<td>{$collections[$i]['existance']}</td>\n</tr>\n";

				$no++;
			}
		}catch(Exception $err){
			$log->error($err->message);
		}
		
		$str.="</table>\n";
		//pr($str);
		//add new page
		$pdf->AddPage();
		$pdf->writeHTML($str, true, false, true, false, '');
		$pdf->lastPage();

		$n_total+=sizeof($collections);
		$log->info('total : '.$n_total);
	}
	$start+=$limit;
	if($start>30){
		break;
	}
}

$log->info("generating file");
$log->info('File created : '.$output);
//Close and output PDF document
$pdf->Output($output, 'F');
?>