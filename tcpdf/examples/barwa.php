<?php

// Suppress warnings to prevent PDF generation errors
error_reporting(E_ERROR | E_PARSE);

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'A3', true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Alaa Haidar');
$pdf->SetTitle('Dukhanbank');
$pdf->SetSubject('Dukhanbank');
$pdf->SetKeywords('Dukhanbank');

$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);



// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(7, 0, 7);



$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('dejavusans', '', 10);

// add a page
$pdf->AddPage();

// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)

// create some HTML content
$html = '
<table cellpadding="0" cellspacing="0" border="0" align="center">
<tr><td width="1000" height="210" ><img src="https://www.dukhanbank.com/e-forms/logonew.jpg" border="0"  /></td></tr>
<tr><td width="1000" height="20" align="right" style="font-family:Tahoma; font-size:14px;color:#24366F;" >';

$html.=(isset($_POST["currentdate"]) ? $_POST["currentdate"] : date('Y-m-d')).'</td></tr>
<tr><td width="1000" height="66" bgcolor="#24366F" align="center"  style="font-family:TrajanPro; font-size:17px; color:#ffffff;"><br><br>Funds Transfer / Internal Transfer Within Dukhan Bank</td></tr>
<tr><td width="1000" height="15"></td></tr>


<tr><td width="1000" height="612" border="1" bordercolor="#24366F" align="left" valign="top">
<table cellpadding="0" cellspacing="0" border="0" align="left">
<tr><td width="1000" height="10"></td></tr>
<tr><td width="1000" height="40" style="font-family:Tahoma; font-size:14px;color:#24366F;">
	<table cellpadding="0" cellspacing="0" border="0">
	<tr><td width="30" height="25"></td><td width="250" height="25"><b>Please Issue</b></td><td width="300" height="25">Internal Transfer Within Dukhan Bank</td></tr>
	<tr><td width="30" height="25"></td><td width="250" height="25" >&nbsp;</td><td width="300" height="25" >'.$_POST["issue2"].'</td></tr>
	</table>
</td></tr>


 <tr><td width="1000" height="46"  bgcolor="#24366F" align="left">
 
 <table cellpadding="0" cellspacing="0" border="0">
 <tr><td colspan="2" width="1000" height="15"></td></tr>
 <tr><td width="30" height="31"></td><td width="970" height="31" style="font-family:TrajanPro; font-size:15px; font-weight:normal; color:#ffffff;">Payment and Beneficiary Details</td></tr>
  </table>
 
 </td></tr>
 
  <tr><td width="1000" height="15"  align="left"> </td></tr>
  
   <tr><td width="1000"  align="left" style="font-family:Tahoma; font-size:14px;color:#24366F;">
 
 <table cellpadding="0" cellspacing="0" border="0">

 <tr><td width="30" height="31"></td><td width="300" height="25"><b>Currency</b></td><td width="400" height="25">'.(isset($_POST["currency"]) ? $_POST["currency"] : '').'</td></tr>
  <tr><td width="30" height="31"></td><td width="300" height="25"><b>Amount</b></td><td width="400" height="25">'.(isset($_POST["figures"]) ? number_format($_POST["figures"], 2, '.', ',') : '').'</td></tr>
    <tr><td width="30" height="31"></td><td width="300" height="25"><b>Amount in Words</b></td><td width="400" height="25">'.(isset($_POST["words"]) ? $_POST["words"] : '').'</td></tr>
     <tr><td width="30" height="31"></td><td width="300" height="25"><b>Beneficiary Name</b></td><td width="400" height="25">'.(isset($_POST["bname"]) ? $_POST["bname"] : '').'</td></tr>

	    <tr><td width="30" height="31"></td><td width="300" height="25"><b>Beneficiary Bank Name</b></td><td width="400" height="25">'.(isset($_POST["bbn"]) ? $_POST["bbn"] : '').'</td></tr>
		    <tr><td width="30" height="31"></td><td width="300" height="25"><b>Beneficiary Reference</b></td><td width="400" height="25">'.(isset($_POST["tp"]) ? $_POST["tp"] : '').'</td></tr>
		 <tr><td width="30" height="31"></td><td width="300" height="25"><b>Beneficiary Account No / IBAN ('.(isset($_POST['acctype']) ? $_POST['acctype'] : 'IBAN').')</b></td><td width="400" height="25">'.(isset($_POST["bacc"]) ? $_POST["bacc"] : '').'</td></tr>
	 
  </table>
 
 </td></tr>
 
 <tr><td width="1000" height="30"  align="left"> </td></tr>';
 
 if($_POST["issue2"]=="Standing Order"){
	 $html.=' <tr><td width="1000" height="46"  bgcolor="#24366F" align="left">
 
 <table cellpadding="0" cellspacing="0" border="0">
 <tr><td colspan="2" width="1000" height="15"></td></tr>
 <tr><td width="30" height="31"></td><td width="970" height="31" style="font-family:TrajanPro; font-size:15px; font-weight:normal; color:#ffffff;">Standing Order Details</td></tr>
  </table>
 
 </td></tr>
 
  <tr><td width="1000" height="15"  align="left"> </td></tr>
  
   <tr><td width="1000"  align="left" style="font-family:Tahoma; font-size:14px;color:#24366F;">
 
 <table cellpadding="0" cellspacing="0" border="0">

 <tr><td width="30" height="31"></td><td width="300" height="25"><b>Start Date</b></td><td width="400" height="25">'.$_POST["startdate"].'</td></tr>
  <tr><td width="30" height="31"></td><td width="300" height="25"><b>End Date</b></td><td width="400" height="25">'.$_POST["enddate"].'</td></tr>
   <tr><td width="30" height="31"></td><td width="300" height="25"><b>Payment Frequency</b></td><td width="700" height="25">'.$_POST["paymentfreq"].'</td></tr>
     <tr><td width="30" height="31"></td><td width="300" height="25"><b>Number of Transfer</b></td><td width="400" height="25">'.$_POST["numberoftransfer"].'</td></tr>
	  
	
  </table>
 
 </td></tr>
 
 <tr><td width="1000" height="30"  align="left"> </td></tr>';
	 }

 $html.='
 
  <tr><td width="1000"  align="left"  ><table cellpadding="0" cellspacing="0" border="0" align="left"><tr><td width="499" valign="top" align="left" ><table cellpadding="0" cellspacing="0" border="0">  
     <tr><td width="499" height="46"  bgcolor="#24366F" align="left"><table cellpadding="0" cellspacing="0" border="0">
 <tr><td colspan="2" width="499" height="15"></td></tr><tr><td width="30" height="31"></td><td width="469" height="31" style="font-family:TrajanPro; font-size:15px; font-weight:normal; color:#ffffff;">Applicant Details</td></tr>
  </table></td></tr>
 <tr><td width="499" height="15"  align="left"> </td></tr>
 
 <tr><td width="499"  align="left" style="font-family:Tahoma; font-size:14px;color:#24366F;">
 
 <table cellpadding="0" cellspacing="0" border="0"><tr><td width="30" height="31"></td><td width="200" height="25"><b>Name</b></td><td width="200" height="25">'.(isset($_POST["pname"]) ? $_POST["pname"] : '').'</td></tr><tr><td width="30" height="20"></td><td width="400" height="20" colspan="2"><b>Debit my Account No</b></td></tr><tr><td width="30" height="30"></td><td width="400" height="20" colspan="2">'.(isset($_POST["debit"]) ? $_POST["debit"] : '').'</td></tr><tr><td width="30" height="31"></td><td width="200" height="25"><b>Tel / Mobile Number</b></td><td width="200" height="25">'.(isset($_POST["tel"]) ? $_POST["tel"] : '').'</td></tr><tr><td width="30" height="20"></td><td width="400" height="20" colspan="2"><b>Applicant Reference No</b></td></tr><tr><td width="30" height="30"></td><td width="400" height="20" colspan="2">'.(isset($_POST["ibanad"]) ? $_POST["ibanad"] : '').'</td></tr>
  </table></td></tr></table></td>
    <td width="1"><img src="'.dirname(__FILE__).DIRECTORY_SEPARATOR.'sep.jpg" width="1" /></td>
    <td width="500" valign="top"><table cellpadding="0" cellspacing="0" border="0"><tr><td width="500" height="46"  bgcolor="#24366F" align="left"><table cellpadding="0" cellspacing="0" border="0">
 <tr><td colspan="2" width="500" height="15"></td></tr>
 <tr><td width="30" height="31"></td><td width="470" height="31" style="font-family:TrajanPro; font-size:15px; font-weight:normal; color:#ffffff;">For Bank Use Only</td></tr> </table> </td></tr>
 <tr><td width="500" height="15"  align="left"> </td></tr>
 <tr><td width="500"  align="left" style="font-family:Tahoma; font-size:14px;color:#24366F;"><table cellpadding="0" cellspacing="0" border="0"><tr><td width="30" height="31"></td><td width="200" height="25"><b>FX Rate</b></td><td width="200" height="25">-------------------------------------</td></tr><tr><td width="30" height="31"></td><td width="200" height="25"></td><td width="200" height="25"></td></tr> <tr><td width="30" height="31"></td><td width="200" height="25"></td><td width="200" height="25"></td></tr><tr><td width="30" height="31"></td><td width="200" height="25"></td><td width="200" height="25"></td></tr></table></td></tr></table></td></tr></table> </td></tr><tr><td width="1000"  border="1"><table cellpadding="0" cellspacing="0" border="0"><tr>
 <td width="499" height="96"   align="left"><table cellpadding="0" cellspacing="0" border="0">
 <tr><td width="30" height="96"></td><td width="469" height="96" style="font-family:TrajanPro; font-size:15px; font-weight:normal; color:#24366F;">Applicant\'s Signature </td></tr></table> </td><td width="500" height="96"   align="left" ><table cellpadding="0" cellspacing="0" border="1"><tr><td width="250" height="96" bgcolor="#f5ece3" style="font-family:TrajanPro; font-size:15px; font-weight:normal; color:#24366F;">&nbsp;&nbsp;Reviewed By</td><td width="250" height="96" style="font-family:TrajanPro; font-size:15px; font-weight:normal; color:#24366F;"  bgcolor="#f5ece3">&nbsp;&nbsp;Authorized By </td></tr></table> </td>
 </tr>
 </table>
 </td></tr></table>
 </td></tr></table>
 
 
 <table cellpadding="0" cellspacing="0" border="0">
 <tr><td width="1000" height="20"></td></tr>
 <tr><td width="1000" height="20" style="font-family:Tahoma; font-size:14px; color:#24366F;">
 I / We accept that the Bank’s General Terms and Conditions for the Operation of Accounts and Electronic Banking Services are applicable to payments and transfers. I / We understand and fully accept that the Bank shall only process this funds transfer instruction as per the information PRINTED in this Form, and shall disregard any hand written amendment and/or insertions made to the printed form.  I further accept that Dukhan Bank will use the account number provided as the basis for the payment and will not check or refer to the beneficiary name or other beneficiary details provided.
 </td></tr>
 </table>


';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');







// reset pointer to the last page
$pdf->lastPage();

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// Print a table












//Close and output PDF document
$pdf->Output('Internal_Transfer_Within_Dukhan_Bank.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
