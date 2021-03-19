<?php

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $html = prepareContent($id);
    //echo $html;
    printPDFInBrowser($html);
}

// require composer autoload
function prepareContent($id)
{
    $order = getFetchArray("select * from orders o, customer c  where o.sender_id = c.id and o.id=" . $id);
    
    $html = '
<html>
	<head>' . prepareHead() . '
	</head>
	<body>';
    $html .= prepareBody($order);
    $html .= '</body>
</html>
';
    return $html;
}

function printPDFInBrowser($html)
{
    require_once __DIR__ . '/mpdf/autoload.php';
    $mpdf = new \Mpdf\Mpdf(); // Create new mPDF Document

    // Beginning Buffer to save PHP variables and HTML tags
    ob_start();

    $mpdf = new \Mpdf\Mpdf([
        'margin_left' => 20,
        'margin_right' => 15,
        'margin_top' => 48,
        'margin_bottom' => 25,
        'margin_header' => 10,
        'margin_footer' => 10
    ]);

    $mpdf->SetProtection(array(
        'print'
    ));
    $mpdf->SetTitle("Saran Solutions - MTP");
    $mpdf->SetAuthor("Saran Solutions");
    $mpdf->SetWatermarkText("Active");
    $mpdf->showWatermarkText = false;
    $mpdf->watermark_font = 'DejaVuSansCondensed';
    $mpdf->watermarkTextAlpha = 0.1;
    $mpdf->SetDisplayMode('fullpage');

    $mpdf->WriteHTML($html);
    $mpdf->Output();
}

function prepareHead()
{
    return '<style>
body {font-family: sans-serif;
	font-size: 10pt;
}
p {	margin: 0pt; }
table.items {
	border: 0.1mm solid #000000;
}
td { vertical-align: top; }
.items td {
	border-left: 0.1mm solid #000000;
	border-right: 0.1mm solid #000000;
}
table thead td { background-color: #EEEEEE;
	text-align: center;
	border: 0.1mm solid #000000;
	font-variant: small-caps;
}
table tr td{
    border: 0.1mm solid #f2f2f2;
}
            
.items td.blanktotal {
	background-color: #EEEEEE;
	border: 0.1mm solid #000000;
	background-color: #FFFFFF;
	border: 0mm none #000000;
	border-top: 0.1mm solid #000000;
	border-right: 0.1mm solid #000000;
}
.items td.totals {
	text-align: right;
	border: 0.1mm solid #000000;
}
.items td.cost {
	text-align: "." center;
}
    </style>
';
}

function prepareBody($order)
{
    $html = '
    <!--mpdf
    '.prepareHeaderAndFooter().'
    <sethtmlpageheader name="myheader" value="on" show-this-page="1" />
    <sethtmlpagefooter name="myfooter" value="on" />
    mpdf-->
    <div style="text-align: right">Exported on: ' . date("d-m-Y") . '</div>
    <br>
    <table width="100%" style="border-collapse: collapse;font-family: sans;" cellpadding="5">
    <tr>
    <td colspan="2" style="text-align:left;font-weight:bold;background-color:#f2f2f2">
    Transfer details
    </td>
    </tr>
    <tr>
    <td>Sender Name</td>
    <td>' . $order[0]['first_name'] . ' ' . $order[0]['last_name'] . '</td>
    </tr>

    <tr><td>Sending Currency</td><td>' . $order[0]['scur'] . '</td></tr>
    
    <tr><td>Receiving Currency</td><td>' . $order[0]['rcur'] . '</td></tr>

    <tr><td>Exchange Rate</td><td>' . $order[0]['er'] . '</td></tr>

    <tr><td>Sending Amount</td><td>' . $order[0]['samount'] . ' '.$order[0]['scur'].' </td></tr>

    <tr><td>Service Charge</td><td>' . $order[0]['scharge'] . ' '.$order[0]['scur'].' </td></tr>

    <tr><td>Total</td><td>' . $order[0]['total_samount'] . ' '.$order[0]['scur'].'</td></tr>

    <tr><td>Receiving Amount</td><td>' . $order[0]['ramount'] . ' '.$order[0]['rcur'].' </td></tr>
    
    <tr>
    <td colspan="2" style="text-align:left;font-weight:bold;background-color:#f2f2f2">
    Sender details
    </td>
    </tr>
    <tr><td>Dob</td><td>' . $order[0]['DOB'] .' </td></tr>
    <tr><td>Phone</td><td>' . $order[0]['phone'] .' </td></tr>
    <tr><td>Handy</td><td>' . $order[0]['handy'] .' </td></tr>
    <tr><td>Address</td><td>' . $order[0]['no_street'] .' </td></tr>
    <tr><td>City</td><td>' . $order[0]['city'] .' </td></tr>
    <tr><td>Visa Expiry</td><td>' . $order[0]['visa_expiry'] .' </td></tr>
    
    <tr>
    <td colspan="2" style="text-align:left;font-weight:bold;background-color:#f2f2f2">
    Receiver details
    </td>
    </tr>
        
    </table>';
    
    
    
    return $html;
}

function prepareHeaderAndFooter(){
    return '
<htmlpageheader name="myheader">
	<table width="100%" cellpadding="5">
		<tr>
			<td width="100%" style="color:#0000BB;">
				<span style="font-weight: bold; font-size: 14pt;">Saran Solutions</span>
				<br />25, Keelaputhur Mainroad<br />Palakkarai<br />Trichy - 620001<br />
				<span style="font-family:dejavusanscondensed;">&#9742;</span> +91 74 88 444 76<br/>
				<span style="font-family:dejavusanscondensed;">&#174;</span>www.saransolutions.ch
            </td>
		</tr>
	</table>
</htmlpageheader>
<htmlpagefooter name="myfooter">
	<div style="border-top: 1px solid #000000; font-size: 9pt; text-align: center; padding-top: 3mm; ">
    Page {PAGENO} of {nb}
	</div>
	<div style=" font-weight:bold;font-size: 7pt; text-align: center; padding-top: 3mm; ">
    Saran Solutions
	</div>
</htmlpagefooter>';
}