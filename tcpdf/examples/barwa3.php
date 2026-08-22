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
<tr><td width="1000" height="66" bgcolor="#24366F" align="center"  style="font-family:TrajanPro; font-size:17px; color:#ffffff;"><br><br>Funds Transfer / Manager Cheque Request</td></tr>
<tr><td width="1000" height="15"></td></tr>


<tr><td width="1000" height="612" border="1" bordercolor="#24366F" align="left" valign="top">
<table cellpadding="0" cellspacing="0" border="0" align="left">
<tr><td width="1000" height="10"></td></tr>
<tr><td width="1000" height="40" style="font-family:Tahoma; font-size:14px;color:#24366F;">
	<table cellpadding="0" cellspacing="0" border="0">
	<tr><td width="30" height="40"></td><td width="250" height="40"><b>Please Issue</b></td><td width="300" height="40">Manager Cheque</td></tr>
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

  <tr><td width="30" height="31"></td><td width="400" height="25"><b>Currency</b></td><td width="580" height="25">'.(isset($_POST["currency"]) ? $_POST["currency"] : '').'</td></tr>

  <tr><td width="30" height="31"></td><td width="400" height="25"><b>Amount</b></td><td width="580" height="25">'.(isset($_POST["figures"]) ? number_format($_POST["figures"], 2, '.', ',') : '').'</td></tr>

   <tr><td width="30" height="31"></td><td width="400" height="25"><b>Amount in Words</b></td><td width="580" height="25">'.(isset($_POST["words"]) ? $_POST["words"] : '').'</td></tr>

     <tr><td width="30" height="31"></td><td width="400" height="25"><b>Beneficiary Name</b></td><td width="580" height="25">'.(isset($_POST["bname"]) ? $_POST["bname"] : '').'</td></tr>';
     

			
			// Purpose code mapping for Corporate customers
			$mainPurposeNames = array(
				"50" => "Operational Expenses",
				"51" => "Goods & Services",
				"52" => "Financial Services",
				"53" => "Human Resources",
				"54" => "Insurance Services",
				"55" => "Projects Payments",
				"56" => "Social Responsibility",
				"57" => "Corporate Transactions",
				"58" => "Government Services",
				"59" => "Investments",
				"60" => "Payment Service Provider",
				// Individual customer purpose codes
				"10" => "Personal and Family Expenses",
				"11" => "Goods & Services",
				"12" => "Education and Training",
				"13" => "Medical Expenses",
				"14" => "Entertainment (Travel & Tourism)",
				"15" => "Salaries and Wages Expenses",
				"16" => "Investments",
				"18" => "Bill Payments",
				"19" => "Financial Services",
				"20" => "Government Services"
			);

			$subPurposeNames = array(
				// Corporate purpose codes (matching the form)
				"5000" => "Rent Payments",
				"5001" => "Service, Fees and Charges Payments (Maintenance, Repair, Consulting)",
				"5002" => "Utility Bills (Electricity, Water, Gas, Cooling)",
				"5050" => "Buying of Furniture, Equipment, Raw Materials and Supplies (Acquisition of Goods)",
				"5051" => "Payment of Royalty Fees, Brands or Trademarks",
				"5052" => "Import and Export Charges",
				"5053" => "IT Services & Software Purchases",
				"5054" => "Shipping and Freight Payments",
				"5055" => "Legal Settlements",
				"5056" => "Infrastructure Development",
				"5057" => "Online Orders / Purchases",
				"5100" => "Loan & Interest Payments",
				"5101" => "Shareholder Distribution / Dividends",
				"5102" => "Investment Funding",
				"5103" => "Credit Transactions",
				"5104" => "Mergers and Acquisitions",
				"5105" => "Cash Remittance",
				"5106" => "Fees and Commissions",
				"5150" => "Salaries and Wages",
				"5151" => "Bonus Payments",
				"5152" => "Other Allowances (Includes Travel Allowance and Leave Encashment)",
				"5153" => "School / University Fees",
				"5154" => "Payment of Pension",
				"5155" => "Compensation",
				"5156" => "Social Security Contributions",
				"5157" => "End of Services Benefits",
				"5200" => "General Insurance",
				"5201" => "Employees Insurance",
				"5202" => "Asset Insurance",
				"5203" => "Liability Insurance",
				"5250" => "Payments for Capital Projects",
				"5251" => "Construction and Development Payments",
				"5252" => "Maintenance Payment",
				"5253" => "Consulting Services",
				"5300" => "Environmental Initiatives",
				"5350" => "Payment within Company or Group (Inter-Group Transactions to Parent or Other Subsidiaries)",
				"5351" => "Joint Investments",
				"5352" => "Treasury Transactions i.e. Hedging Operation, FD placement & Swap Transactions",
				"5353" => "Currency Exchange",
				"5400" => "Government Services",
				"5401" => "Courts Payments",
				"5402" => "Tax Payments",
				"5403" => "Customs Payments",
				"5450" => "Investment in Real Estate",
				"5451" => "Investment in Shares / Equities / Bonds",
				"5452" => "Other Investments",
				"5500" => "Merchant Settlement",
				// Individual customer sub-purpose codes
				"101000" => "Family & Friends Payments",
				"101001" => "Transfer to Own Account",
				"101002" => "Personal Settlements",
				"101003" => "Credit Card Payments",
				"101004" => "Pre-Paid Cards and E-Wallet Top Up",
				"101005" => "E-Wallet Cash-Out",
				"101006" => "Standing Order",
				"111000" => "Online Shopping",
				"111001" => "Retail Purchases",
				"111002" => "Professional Services",
				"111003" => "Home Services",
				"111004" => "Subscription Services",
				"121000" => "Tuition Fees",
				"121001" => "Educational Materials",
				"121002" => "Training Courses",
				"121003" => "Certification Programs",
				"131000" => "Medical Treatment",
				"131001" => "Prescription Medications",
				"131002" => "Medical Insurance",
				"131003" => "Dental Care",
				"131004" => "Health Supplements",
				"141000" => "Travel Expenses",
				"141001" => "Hotel Accommodation",
				"141002" => "Flight Tickets",
				"141003" => "Entertainment Events",
				"141004" => "Recreation Activities",
				"151000" => "Salary Payments",
				"151001" => "Freelance Payments",
				"151002" => "Bonus Payments",
				"161000" => "Stock Purchases",
				"161001" => "Mutual Fund Investments",
				"161002" => "Real Estate Investment",
				"161003" => "Cryptocurrency Investment",
				"181000" => "Utility Bills",
				"181001" => "Telecommunications Bills",
				"181002" => "Insurance Premiums",
				"181003" => "Loan Payments",
				"181004" => "Credit Card Bills",
				"191000" => "Banking Services",
				"191001" => "Investment Services",
				"191002" => "Insurance Services",
				"191003" => "Financial Advisory",
				"201000" => "Government Fees",
				"201001" => "Tax Payments",
				"201002" => "License Renewals",
				"201003" => "Permit Applications"
			);

			// Get purpose fields for display
			$mainText = '';
			$subText = '';
			if (isset($_POST["main_purpose"]) && $_POST["main_purpose"]) {
				$mainText = isset($mainPurposeNames[$_POST["main_purpose"]]) ? $mainPurposeNames[$_POST["main_purpose"]] : $_POST["main_purpose"];
			}
			if (isset($_POST["sub_purpose"]) && $_POST["sub_purpose"]) {
				$subText = isset($subPurposeNames[$_POST["sub_purpose"]]) ? $subPurposeNames[$_POST["sub_purpose"]] : $_POST["sub_purpose"];
			}

			$html.='
				         <tr><td width="30" height="31"></td><td width="400" height="25"><b>Payment Purpose (Regulatory Requirement)</b></td><td width="580" height="25">'.$mainText.'</td></tr>
				         <tr><td width="30" height="31"></td><td width="400" height="25"><b>Payment Details</b></td><td width="580" height="25">'.$subText.'</td></tr>
	 
  </table>
 
 </td></tr>';
 
 
 $html.='
 
 
 
 <tr><td width="1000" height="30"  align="left"> </td></tr>

 
 
  <tr><td width="1000"  align="left"  ><table cellpadding="0" cellspacing="0" border="0" align="left"><tr><td width="499" valign="top" align="left" ><table cellpadding="0" cellspacing="0" border="0">  
     <tr><td width="499" height="46"  bgcolor="#24366F" align="left"><table cellpadding="0" cellspacing="0" border="0">
 <tr><td colspan="2" width="499" height="15"></td></tr><tr><td width="30" height="31"></td><td width="469" height="31" style="font-family:TrajanPro; font-size:15px; font-weight:normal; color:#ffffff;">Applicant Details</td></tr>
  </table></td></tr>
 <tr><td width="499" height="15"  align="left"> </td></tr>
 
 <tr><td width="499"  align="left" style="font-family:Tahoma; font-size:14px;color:#24366F;">
 
 <table cellpadding="0" cellspacing="0" border="0"><tr><td width="30" height="31"></td><td width="200" height="25"><b>Name</b></td><td width="200" height="25">'.(isset($_POST["pname"]) ? $_POST["pname"] : '').'</td></tr><tr><td width="30" height="20"></td><td width="400" height="20" colspan="2"><b>Debit my Account No</b></td></tr><tr><td width="30" height="30"></td><td width="400" height="20" colspan="2">'.(isset($_POST["debit"]) ? $_POST["debit"] : '').'</td></tr><tr><td width="30" height="31"></td><td width="200" height="25"><b>Tel / Mobile Number</b></td><td width="200" height="25">'.(isset($_POST["tel"]) ? $_POST["tel"] : '').'</td></tr>
  </table></td></tr></table></td>
    <td width="1"><img src="'.dirname(__FILE__).DIRECTORY_SEPARATOR.'sep.jpg" width="1" /></td>
    <td width="500" valign="top"><table cellpadding="0" cellspacing="0" border="0"><tr><td width="500" height="46"  bgcolor="#24366F" align="left"><table cellpadding="0" cellspacing="0" border="0">
 <tr><td colspan="2" width="500" height="15"></td></tr>
 <tr><td width="30" height="31"></td><td width="470" height="31" style="font-family:TrajanPro; font-size:15px; font-weight:normal; color:#ffffff;">For Bank Use Only</td></tr> </table> </td></tr>
 <tr><td width="500" height="15"  align="left"> </td></tr>
 <tr><td width="500"  align="left" style="font-family:Tahoma; font-size:14px;color:#24366F;"><table cellpadding="0" cellspacing="0" border="0"><tr><td width="30" height="31"></td><td width="200" height="25"><b>Reference No</b></td><td width="200" height="25">-------------------------------------</td></tr><tr><td width="30" height="31"></td><td width="200" height="25"></td><td width="200" height="25"></td></tr> <tr><td width="30" height="31"></td><td width="200" height="25"></td><td width="200" height="25"></td></tr><tr><td width="30" height="31"></td><td width="200" height="25"></td><td width="200" height="25"></td></tr></table></td></tr></table></td></tr></table> </td></tr><tr><td width="1000"  border="1"><table cellpadding="0" cellspacing="0" border="0"><tr>
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
$pdf->Output('Manager_Cheque_Request.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+