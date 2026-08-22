<?php

// Debug: Check if this file is being executed
// Remove this debug line after testing
error_log("barwa2.php is being executed at " . date('Y-m-d H:i:s'));

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
<tr><td width="1000" height="75" align="center" ><img src="https://www.dukhanbank.com/e-forms/logonew.jpg" border="0" height="75"  /></td></tr>
<tr><td width="1000" height="20" align="right" style="font-family:Tahoma; font-size:14px;color:#24366F;" >';

$html.=(isset($_POST["currentdate"]) ? $_POST["currentdate"] : date('Y-m-d')).'</td></tr>
<tr><td width="1000" height="66" bgcolor="#24366F" align="center"  style="font-family:TrajanPro; font-size:17px; color:#ffffff;"><br><br>Funds Transfer / Electronic Payment</td></tr>
<tr><td width="1000" height="15"></td></tr>


<tr><td width="1000" height="612" border="1" bordercolor="#24366F" align="left" valign="top">
<table cellpadding="0" cellspacing="0" border="0" align="left">
<tr><td width="1000" height="10"></td></tr>
<tr><td width="1000" height="40" style="font-family:Tahoma; font-size:14px;color:#24366F;">
	<table cellpadding="0" cellspacing="0" border="0">
	<tr><td width="30" height="25"></td><td width="250" height="25"><b>Please Issue</b></td><td width="300" height="25">Electronic Payment</td></tr>
		<tr><td width="30" height="25"></td><td width="250" height="25" >&nbsp;</td><td width="300" height="25" >'.(isset($_POST["issue2"]) ? $_POST["issue2"] : '').'</td></tr>
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
 <tr><td width="30" height="31"></td><td width="400" height="25"><b>Beneficiary\'s Country</b></td><td width="580" height="25">'.(isset($_POST["country"]) ? $_POST["country"] : '').'</td></tr>
 <tr><td width="30" height="31"></td><td width="400" height="25"><b>Transfer Channel</b></td><td width="580" height="25">'.(isset($_POST["transfer_channel"]) ? $_POST["transfer_channel"] : '').'</td></tr>
  <tr><td width="30" height="31"></td><td width="400" height="25"><b>Amount</b></td><td width="580" height="25">'.(isset($_POST["figures"]) ? number_format($_POST["figures"], 2, '.', ',') : '').'</td></tr>

  <tr><td width="30" height="31"></td><td width="400" height="25"><b>Amount in Words</b></td><td width="580" height="25">'.(isset($_POST["amountinwords"]) ? $_POST["amountinwords"] : '').'</td></tr>

     <tr><td width="30" height="31"></td><td width="400" height="25"><b>Beneficiary Full Name</b></td><td width="580" height="25">'.(isset($_POST["bname"]) ? $_POST["bname"] : '').'</td></tr>

	<tr><td width="30" height="31"></td><td width="400" height="25"><b>Beneficiary Address</b></td><td width="580" height="25">'.(isset($_POST["baddress"]) ? $_POST["baddress"] : '').'</td></tr>

	<tr><td width="30" height="31"></td><td width="400" height="25"><b>Beneficiary City</b></td><td width="580" height="25">'.(isset($_POST["bcity"]) ? $_POST["bcity"] : '').'</td></tr>

	 <tr><td width="30" height="31"></td><td width="400" height="25"><b>Beneficiary Account No / IBAN ('.(isset($_POST['acctype']) ? $_POST['acctype'] : 'IBAN').')</b></td><td width="580" height="25">'.(isset($_POST["bacc"]) ? $_POST["bacc"] : '').'</td></tr>

	 <tr><td width="30" height="31"></td><td width="400" height="25"><b>Beneficiary Bank Name</b></td><td width="580" height="25">'.(isset($_POST["bbname"]) ? $_POST["bbname"] : '').'</td></tr>

	 <tr><td width="30" height="31"></td><td width="400" height="25"><b>Beneficiary Bank Address</b></td><td width="580" height="25">'.(isset($_POST["bbadd"]) ? $_POST["bbadd"] : '').'</td></tr>

	    <tr><td width="30" height="31"></td><td width="400" height="25"><b>Beneficiary Bank BIC Code</b></td><td width="580" height="25">'.(isset($_POST["bbn"]) ? strtoupper($_POST["bbn"]) : '').'</td></tr>
      
            ';
			
			if(isset($_POST["bct"]) && $_POST["bct"]!=""){
				$html.='<tr><td width="30" height="31"></td><td width="400" height="25"><b>Bank Code Type</b></td><td width="580" height="25">'.$_POST["bct"].' / '.(isset($_POST["bctt"]) ? $_POST["bctt"] : '').'</td></tr>';
				}
			
			
			$html.='
				 <tr><td width="30" height="31"></td><td width="400" height="25"><b>Beneficiary Reference</b></td><td width="580" height="25">'.(isset($_POST["tp"]) ? $_POST["tp"] : '').'</td></tr>';

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
				"111050" => "Online Orders/ Purchases",
				"111051" => "Insurance Services",
				"111052" => "Construction, Maintenance & Consulting Services",
				"111053" => "Rent Payments",
				"111054" => "Automobile Services (Including Automobile Repair and Maintenance)",
				"111055" => "POS Purchases",
				"121100" => "School/University Fees",
				"121101" => "Tutoring Sessions",
				"121102" => "Training Courses",
				"131150" => "Doctor Consultations",
				"131151" => "Medical Tests & Treatments",
				"141200" => "Transportation Fees",
				"141201" => "Travel & Tourism Fees",
				"141202" => "Accommodation Fees",
				"141203" => "Visa and Ticket Expenses",
				"151250" => "Salaries and Wages",
				"151251" => "Other Allowances (Travel Allowance, Leave Encashment)",
				"151252" => "Bonus Payments",
				"161300" => "Investment in Real Estate",
				"161301" => "Investment in Shares/Equities/Bonds",
				"161302" => "Other Investments",
				"181403" => "Subscriptions (Internet, Mobile, etc.)",
				"181404" => "Utility Bills (Electricity, Water, Gas, Cooling)",
				"191450" => "Loan & Interest Payments",
				"191451" => "General Insurance",
				"191452" => "Cash Remittance",
				"191453" => "Fees and Commissions",
				"201500" => "Government Services",
				"201501" => "Courts Payments",
				"201502" => "Tax Payments",
				"201503" => "Customs Payments",
				// Non-Qatar (SWIFT) sub-purpose codes
				"B1B01" => "Advance payment for imports",
				"B1B02" => "Import payment / invoice settlement",
				"B1B03" => "Diplomatic missions imports",
				"B1B04" => "Intermediary trade",
				"B2A01" => "Surplus Freight/Passenger Fare - Foreign Shipping Cos.",
				"B2A02" => "Operating Expenses - Qatari Shipping Cos. Abroad",
				"B2A03" => "Freight on Imports - Shipping Cos.",
				"B2A05" => "Operational Leasing with Crew - Shipping",
				"B2A06" => "Passage Bookings Abroad - Shipping",
				"B2A07" => "Surplus Freight/Passenger Fare - Foreign Airlines",
				"B2A08" => "Operating Expenses - Qatari Airlines",
				"B2A09" => "Freight on Imports - Airlines",
				"B2A11" => "Operational Leasing with Crew - Airlines",
				"B2A12" => "Passage Bookings Abroad - Airlines",
				"B2A13" => "Other Transport Services (Stevedoring/Demurrage/Handling)",
				"B2B01" => "Business travel",
				"B2B02" => "General travel",
				"B2B03" => "Pilgrimage travel",
				"B2B04" => "Medical travel",
				"B2B05" => "Education travel",
				"B2B06" => "Other travel (international cards)",
				"B2B07" => "Foreign currency sold / issued to residents for investment purposes",
				"B2B08" => "Foreign currency sold / issued to residents for travel purposes",
				"B2B09" => "Transactions abroad on credit cards issued by the reporting bank",
				"B2B10" => "Transactions abroad on debit cards issued by the reporting bank",
				"B3A02" => "Deposits",
				"B3A03" => "Profit on non-resident deposits",
				"B3A04" => "Profit on Non-Resident Loans",
				"B3A05" => "Profit on debt securities",
				"B3A06" => "Bank profit payments (Vostro/Nostro)",
				"B3A07" => "Repatriation of profits",
				"B4B07" => "Dividend payments / repatriation",
				"B2G01" => "Maintenance of Qatari Embassies Abroad",
				"B2G02" => "Remittances by Foreign Embassies in Qatar",
				"B2K01" => "Postal claims settlement",
				"B2K02" => "Courier claims settlement",
				"B2K03" => "Telecom claims settlement",
				"B2K04" => "Satellite services",
				"B2D01" => "Construction costs for Qatari projects abroad",
				"B2D02" => "Construction costs for foreign companies in Qatar",
				"B2C01" => "Life insurance premium",
				"B2C02" => "Freight insurance",
				"B2C03" => "General insurance premium",
				"B2C04" => "Reinsurance premium",
				"B2C05" => "Insurance auxiliary services (commission)",
				"B2C06" => "Insurance claim settlement",
				"B2F01" => "Financial intermediation (excl. investment banking)",
				"B2F02" => "Investment banking services",
				"B2F03" => "Auxiliary financial services (regulatory, custodial, depository fees)",
				"B2G07" => "Government services (outgoing remittances)",
				"B2E01" => "Hardware consultancy",
				"B2E02" => "Software implementation",
				"B2E03" => "Database / data processing charges",
				"B2E04" => "Computer/software repair & maintenance",
				"B2E05" => "News agency services",
				"B2E06" => "Other information services (subscriptions)",
				"B2H01" => "Audiovisual services (production, rentals, talent fees)",
				"B2H02" => "Personal cultural services (museums, libraries, archives, sports)",
				"B2J01" => "Merchanting (net payments)",
				"B2J02" => "Trade-related commissions (exports/imports)",
				"B2J03" => "Operational leasing (no crew), including charter hire",
				"B2J04" => "Legal services",
				"B2J05" => "Accounting, auditing, bookkeeping, and tax services",
				"B2J06" => "Business and management consultancy and PR services",
				"B2J07" => "Advertising, market research, and opinion polling services",
				"B2J08" => "Research and development services",
				"B2J09" => "Architectural, engineering, and technical services",
				"B2J10" => "Agricultural, mining, and on-site processing services",
				"B2J11" => "Office maintenance abroad",
				"B2J12" => "Distribution services",
				"B2J13" => "Environmental services",
				"B2J19" => "Other services not classified",
				"B2R01" => "Franchise and IP usage fees (patents, copyrights, trademarks, industrial processes)",
				"B2R02" => "Licensing fees for original works or prototypes (manuscripts, films, etc.)",
				"B4A01" => "Family Maintenance & Savings",
				"B4B05" => "Government Contributions to International Institutions",
				"B4B06" => "Tax Payments / Refunds",
				"B5A17" => "Purchase of Intangible Assets (Patents/Trademarks/Copyrights)",
				"B6C12" => "Repayment of Long/Medium-Term Loans",
				"B6C13" => "Repayment of Short-Term Loans",
				"B6C11" => "Loans Extended to Non-Residents",
				"B6C15" => "Remittances to Bank's Own Account Abroad",
				"B6B01" => "Qatari Investment Abroad - Equity",
				"B6B02" => "Qatari Investment Abroad - Debt Securities",
				"B6A03" => "Investment in Branches/Wholly-Owned Subsidiaries",
				"B6A04" => "Investment in Subsidiaries/Associates",
				"B6A05" => "Investment in Real Estate Abroad",
				"B6A06" => "Repatriation of FDI in Qatar - Equity",
				"B6A07" => "Repatriation of FDI in Qatar - Debt Securities",
				"B6A08" => "Repatriation of FDI in Qatar - Real Estate",
				"B6B09" => "Repatriation of Foreign Portfolio Investment - Equity",
				"B6B10" => "Repatriation of Foreign Portfolio Investment - Debt Securities",
				"B6C14" => "Repatriation of Non-Resident Deposits",
				"B6C18" => "Other Capital Payments Not Classified",
				"B7A01" => "Export Refunds / Invoice Reductions",
				"B7B02" => "Reversal of Wrong Entries",
				"B7C03" => "Resident-to-Resident Payments"
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
 
 </td></tr>
 
 <tr><td width="1000" height="10"  align="left"> </td></tr>';
 
 if(isset($_POST["issue2"]) && $_POST["issue2"]=="Standing Order"){
	 $html.=' <tr><td width="1000" height="46"  bgcolor="#24366F" align="left">
 
 <table cellpadding="0" cellspacing="0" border="0">
 <tr><td colspan="2" width="1000" height="15"></td></tr>
 <tr><td width="30" height="31"></td><td width="970" height="31" style="font-family:TrajanPro; font-size:15px; font-weight:normal; color:#ffffff;">Standing Order Details</td></tr>
  </table>
 
 </td></tr>
 
  <tr><td width="1000" height="15"  align="left"> </td></tr>
  
   <tr><td width="1000"  align="left" style="font-family:Tahoma; font-size:14px;color:#24366F;">
 
 <table cellpadding="0" cellspacing="0" border="0">

 <tr><td width="30" height="31"></td><td width="300" height="25"><b>Start Date</b></td><td width="400" height="25">'.(isset($_POST["startdate"]) ? $_POST["startdate"] : '').'</td></tr>
  <tr><td width="30" height="31"></td><td width="300" height="25"><b>End Date</b></td><td width="400" height="25">'.(isset($_POST["enddate"]) ? $_POST["enddate"] : '').'</td></tr>
   <tr><td width="30" height="31"></td><td width="300" height="25"><b>Payment Frequency</b></td><td width="700" height="25">'.(isset($_POST["paymentfreq"]) ? $_POST["paymentfreq"] : '').'</td></tr>
     <tr><td width="30" height="31"></td><td width="300" height="25"><b>Number of Transfer</b></td><td width="400" height="25">'.(isset($_POST["numberoftransfer"]) ? $_POST["numberoftransfer"] : '').'</td></tr>
	  
	
  </table>
 
 </td></tr>
 
 <tr><td width="1000" height="10"  align="left"> </td></tr>';
	 }

 
 
 
 $html.='
 <tr><td width="1000" height="46"  bgcolor="#24366F" align="left">
 
 <table cellpadding="0" cellspacing="0" border="0">
 <tr><td colspan="2" width="1000" height="15"></td></tr>
 <tr><td width="30" height="31"></td><td width="970" height="31" style="font-family:TrajanPro; font-size:15px; font-weight:normal; color:#ffffff;">Charges</td></tr>
  </table>
 
 </td></tr>
 
 <tr><td width="1000" height="15"  align="left"> </td></tr>
 
 
 <tr><td width="1000"  align="left" style="font-family:Tahoma; font-size:14px;color:#24366F;">
 
 <table cellpadding="0" cellspacing="0" border="0">

 <tr><td width="30" height="31"></td><td width="300" height="25"><b>Correspondent Bank Charges </b></td><td width="700" height="25">'.(isset($_POST["cbc"]) ? $_POST["cbc"] : '').'</td></tr>
 <tr><td width="30" height="31"></td><td width="300" height="25"><b>Dukhan Bank Charges</b></td><td width="700" height="25">'.(isset($_POST["cbc1"]) ? $_POST["cbc1"] : '').'</td></tr>
</table>
 
 </td></tr>
 
 
 
 <tr><td width="1000" height="10"  align="left"> </td></tr>

 
 
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
 <tr><td width="500"  align="left" style="font-family:Tahoma; font-size:14px;color:#24366F;"><table cellpadding="0" cellspacing="0" border="0"><tr><td width="30" height="31"></td><td width="200" height="25"><b>FX Rate</b></td><td width="200" height="25">-------------------------------------</td></tr><tr><td width="30" height="31"></td><td width="200" height="25"><b>Reference No</b></td><td width="200" height="25">-------------------------------------</td></tr> <tr><td width="30" height="31"></td><td width="200" height="25"></td><td width="200" height="25"></td></tr><tr><td width="30" height="31"></td><td width="200" height="25"></td><td width="200" height="25"></td></tr></table></td></tr></table></td></tr></table> </td></tr><tr><td width="1000"  border="1"><table cellpadding="0" cellspacing="0" border="0"><tr>
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
$pdf->Output('Electronic_Payment.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
