<?php


// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'A3', true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Alaa Haidar');
$pdf->SetTitle('Barwabank');
$pdf->SetSubject('Barwabank');
$pdf->SetKeywords('Barwabank');

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
<tr><td width="1000" height="75" align="center" ><img src="http://talking222.com/clients/BarwaBank/forms/new/images/logo2.jpg" border="0" height="75"  /></td></tr>
<tr><td width="1000" height="20" align="right" style="font-family:Tahoma; font-size:14px;color:#bf863f;" >';

$html.=$_POST["currentdate"].'</td></tr>
<tr><td width="1000" height="66" bgcolor="#bf863f" align="center"  style="font-family:TrajanPro; font-size:17px; color:#ffffff;"><br><br>Funds Transfer / Electronic Payment</td></tr>
<tr><td width="1000" height="15"></td></tr>


<tr><td width="1000" height="612" border="1" bordercolor="#bf863f" align="left" valign="top">
<table cellpadding="0" cellspacing="0" border="0" align="left">
<tr><td width="1000" height="10"></td></tr>
<tr><td width="1000" height="40" style="font-family:Tahoma; font-size:14px;color:#bf863f;">
	<table cellpadding="0" cellspacing="0" border="0">
	<tr><td width="30" height="25"></td><td width="250" height="25"><b>Please Issue</b></td><td width="300" height="25">Electronic Payment</td></tr>
		<tr><td width="30" height="25"></td><td width="250" height="25" >&nbsp;</td><td width="300" height="25" >'.$_POST["issue2"].'</td></tr>
	</table>
</td></tr>


 <tr><td width="1000" height="46"  bgcolor="#bf863f" align="left">
 
 <table cellpadding="0" cellspacing="0" border="0">
 <tr><td colspan="2" width="1000" height="15"></td></tr>
 <tr><td width="30" height="31"></td><td width="970" height="31" style="font-family:TrajanPro; font-size:15px; font-weight:normal; color:#ffffff;">Payment and Beneficiary Details</td></tr>
  </table>
 
 </td></tr>
 
  <tr><td width="1000" height="15"  align="left"> </td></tr>
  
   <tr><td width="1000"  align="left" style="font-family:Tahoma; font-size:14px;color:#bf863f;">
 
 <table cellpadding="0" cellspacing="0" border="0">

  <tr><td width="30" height="31"></td><td width="400" height="25"><b>Currency</b></td><td width="580" height="25">'.$_POST["currency"].'</td></tr>
 <tr><td width="30" height="31"></td><td width="400" height="25"><b>Beneficiary\'s Country</b></td><td width="580" height="25">'.$_POST["country"].'</td></tr>
  <tr><td width="30" height="31"></td><td width="400" height="25"><b>Amount</b></td><td width="580" height="25">'.number_format($_POST["figures"], 2, '.', ',').'</td></tr>

     <tr><td width="30" height="31"></td><td width="400" height="25"><b>Beneficiary Name</b></td><td width="580" height="25">'.$_POST["bname"].'</td></tr>
     <tr><td width="30" height="31"></td><td width="400" height="25"><b>Beneficiary Account No / IBAN</b></td><td width="580" height="25">'.$_POST["bacc"].'</td></tr>

	    <tr><td width="30" height="31"></td><td width="400" height="25"><b>Beneficiary Bank BIC Code</b></td><td width="580" height="25">'.strtoupper($_POST["bbn"]).'</td></tr>
      
            ';
			
			if($_POST["bct"]!=""){
				$html.='<tr><td width="30" height="31"></td><td width="400" height="25"><b>Bank Code Type</b></td><td width="580" height="25">'.$_POST["bct"].' / '.$_POST["bctt"].'</td></tr>';
				}
			
			
			$html.='
				 <tr><td width="30" height="31"></td><td width="400" height="25"><b>Beneficiary Reference</b></td><td width="580" height="25">'.$_POST["tp"].'</td></tr>
         <tr><td width="30" height="31"></td><td width="400" height="25"><b>Purpose of Payment (for Regulatory Purpose)</b></td><td width="580" height="25">'.$_POST["ppf"].'</td></tr>
	 
  </table>
 
 </td></tr>
 
 <tr><td width="1000" height="10"  align="left"> </td></tr>';
 
 if($_POST["issue2"]=="Standing Order"){
	 $html.=' <tr><td width="1000" height="46"  bgcolor="#bf863f" align="left">
 
 <table cellpadding="0" cellspacing="0" border="0">
 <tr><td colspan="2" width="1000" height="15"></td></tr>
 <tr><td width="30" height="31"></td><td width="970" height="31" style="font-family:TrajanPro; font-size:15px; font-weight:normal; color:#ffffff;">Standing Order Details</td></tr>
  </table>
 
 </td></tr>
 
  <tr><td width="1000" height="15"  align="left"> </td></tr>
  
   <tr><td width="1000"  align="left" style="font-family:Tahoma; font-size:14px;color:#bf863f;">
 
 <table cellpadding="0" cellspacing="0" border="0">

 <tr><td width="30" height="31"></td><td width="300" height="25"><b>Start Date</b></td><td width="400" height="25">'.$_POST["startdate"].'</td></tr>
  <tr><td width="30" height="31"></td><td width="300" height="25"><b>End Date</b></td><td width="400" height="25">'.$_POST["enddate"].'</td></tr>
   <tr><td width="30" height="31"></td><td width="300" height="25"><b>Payment Frequency</b></td><td width="700" height="25">'.$_POST["paymentfreq"].'</td></tr>
     <tr><td width="30" height="31"></td><td width="300" height="25"><b>Number of Transfer</b></td><td width="400" height="25">'.$_POST["numberoftransfer"].'</td></tr>
	  
	
  </table>
 
 </td></tr>
 
 <tr><td width="1000" height="10"  align="left"> </td></tr>';
	 }

 
 
 
 $html.='
 <tr><td width="1000" height="46"  bgcolor="#bf863f" align="left">
 
 <table cellpadding="0" cellspacing="0" border="0">
 <tr><td colspan="2" width="1000" height="15"></td></tr>
 <tr><td width="30" height="31"></td><td width="970" height="31" style="font-family:TrajanPro; font-size:15px; font-weight:normal; color:#ffffff;">Charges</td></tr>
  </table>
 
 </td></tr>
 
 <tr><td width="1000" height="15"  align="left"> </td></tr>
 
 
 <tr><td width="1000"  align="left" style="font-family:Tahoma; font-size:14px;color:#bf863f;">
 
 <table cellpadding="0" cellspacing="0" border="0">

 <tr><td width="30" height="31"></td><td width="300" height="25"><b>Correspondent Bank Charges </b></td><td width="700" height="25">'.$_POST["cbc"].'</td></tr>
 <tr><td width="30" height="31"></td><td width="300" height="25"><b>Barwa Bank Charges</b></td><td width="700" height="25">'.$_POST["cbc1"].'</td></tr>
</table>
 
 </td></tr>
 
 
 
 <tr><td width="1000" height="10"  align="left"> </td></tr>

 
 
  <tr><td width="1000"  align="left"  ><table cellpadding="0" cellspacing="0" border="0" align="left"><tr><td width="499" valign="top" align="left" ><table cellpadding="0" cellspacing="0" border="0">  
     <tr><td width="499" height="46"  bgcolor="#bf863f" align="left"><table cellpadding="0" cellspacing="0" border="0">
 <tr><td colspan="2" width="499" height="15"></td></tr><tr><td width="30" height="31"></td><td width="469" height="31" style="font-family:TrajanPro; font-size:15px; font-weight:normal; color:#ffffff;">Applicant Details</td></tr>
  </table></td></tr>
 <tr><td width="499" height="15"  align="left"> </td></tr>
 
 <tr><td width="499"  align="left" style="font-family:Tahoma; font-size:14px;color:#bf863f;">
 
 <table cellpadding="0" cellspacing="0" border="0"><tr><td width="30" height="31"></td><td width="200" height="25"><b>Name</b></td><td width="200" height="25">'.$_POST["pname"].'</td></tr><tr><td width="30" height="20"></td><td width="400" height="20" colspan="2"><b>Debit my Account No</b></td></tr><tr><td width="30" height="30"></td><td width="400" height="20" colspan="2">'.$_POST["debit"].'</td></tr><tr><td width="30" height="31"></td><td width="200" height="25"><b>Tel / Mobile Number</b></td><td width="200" height="25">'.$_POST["tel"].'</td></tr><tr><td width="30" height="20"></td><td width="400" height="20" colspan="2"><b>Applicant Reference No</b></td></tr><tr><td width="30" height="30"></td><td width="400" height="20" colspan="2">'.$_POST["ibanad"].'</td></tr>
  </table></td></tr></table></td>
    <td width="1"><img src="sep.jpg" width="1" /></td>
    <td width="500" valign="top"><table cellpadding="0" cellspacing="0" border="0"><tr><td width="500" height="46"  bgcolor="#bf863f" align="left"><table cellpadding="0" cellspacing="0" border="0">
 <tr><td colspan="2" width="500" height="15"></td></tr>
 <tr><td width="30" height="31"></td><td width="470" height="31" style="font-family:TrajanPro; font-size:15px; font-weight:normal; color:#ffffff;">For Bank Use Only</td></tr> </table> </td></tr>
 <tr><td width="500" height="15"  align="left"> </td></tr>
 <tr><td width="500"  align="left" style="font-family:Tahoma; font-size:14px;color:#bf863f;"><table cellpadding="0" cellspacing="0" border="0"><tr><td width="30" height="31"></td><td width="200" height="25"><b>FX Rate</b></td><td width="200" height="25">-------------------------------------</td></tr><tr><td width="30" height="31"></td><td width="200" height="25"><b>Reference No</b></td><td width="200" height="25">-------------------------------------</td></tr> <tr><td width="30" height="31"></td><td width="200" height="25"></td><td width="200" height="25"></td></tr><tr><td width="30" height="31"></td><td width="200" height="25"></td><td width="200" height="25"></td></tr></table></td></tr></table></td></tr></table> </td></tr><tr><td width="1000"  border="1"><table cellpadding="0" cellspacing="0" border="0"><tr>
 <td width="499" height="96"   align="left"><table cellpadding="0" cellspacing="0" border="0">
 <tr><td width="30" height="96"></td><td width="469" height="96" style="font-family:TrajanPro; font-size:15px; font-weight:normal; color:#bf863f;">Applicant\'s Signature </td></tr></table> </td><td width="500" height="96"   align="left" ><table cellpadding="0" cellspacing="0" border="1"><tr><td width="250" height="96" bgcolor="#f5ece3" style="font-family:TrajanPro; font-size:15px; font-weight:normal; color:#bf863f;">&nbsp;&nbsp;Reviewed By</td><td width="250" height="96" style="font-family:TrajanPro; font-size:15px; font-weight:normal; color:#bf863f;"  bgcolor="#f5ece3">&nbsp;&nbsp;Authorized By </td></tr></table> </td>
 </tr>
 </table>
 </td></tr></table>
 </td></tr></table>

 <table cellpadding="0" cellspacing="0" border="0">
 <tr><td width="1000" height="20"></td></tr>
 <tr><td width="1000" height="20" style="font-family:Tahoma; font-size:14px; color:#bf863f;">
 I / We accept that the Bank’s General Terms and Conditions for the Operation of Accounts and Electronic Banking Services are applicable to payments and transfers. I / We understand and fully accept that the Bank shall only process this funds transfer instruction as per the information PRINTED in this Form, and shall disregard any hand written amendment and/or insertions made to the printed form.  I further accept that Barwa Bank will use the account number provided as the basis for the payment and will not check or refer to the beneficiary name or other beneficiary details provided.
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
$pdf->Output('Electronic_Payment.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
