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
if (@file_exists(dirname(__FILE__).'/lang/ara.php')) {
	require_once(dirname(__FILE__).'/lang/ara.php');
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
<tr><td width="1000" height="20" align="left" style="font-family:Tahoma; font-size:14px;color:#24366F;" >';

$html.=(isset($_POST["currentdate"]) ? $_POST["currentdate"] : date('Y-m-d')).'</td></tr>
<tr><td width="1000" height="66" bgcolor="#24366F" align="center"  style="font-family:TrajanPro; font-size:17px; color:#ffffff;"><br><br> طلب تحويل أموال / حوالة داخلية ضمن بنك بروة</td></tr>
<tr><td width="1000" height="15"></td></tr>


<tr><td width="1000" height="612" border="1" bordercolor="#24366F" align="right" valign="top">
<table cellpadding="0" cellspacing="0" border="0" align="right">
<tr><td width="1000" height="10"></td></tr>
<tr><td width="1000" height="40" style="font-family:Tahoma; font-size:14px;color:#24366F;">
	<table cellpadding="0" cellspacing="0" border="0" align="right">
	<tr><td width="30" height="25"></td><td width="250" height="25" align="right"><b>نرجو التكرم بإصدار</b></td><td width="300" height="25" align="right">حوالة داخليه ضمن بنك بروة</td></tr>
	<tr><td width="30" height="25"></td><td width="250" height="25" align="right">&nbsp;</td><td width="300" height="25" align="right">'.(isset($_POST["issue2"]) ? $_POST["issue2"] : '').'</td></tr>
	</table>
</td></tr>


 <tr><td width="1000" height="46"  bgcolor="#24366F" align="right">
 
 <table cellpadding="0" cellspacing="0" border="0" align="right">
 <tr><td colspan="2" width="1000" height="15"></td></tr>
 <tr><td width="30" height="31"></td><td width="970" height="31" style="font-family:TrajanPro; font-size:15px; font-weight:normal; color:#ffffff;" align="right">بيانات المستفيد</td></tr>
  </table>
 
 </td></tr>
 
  <tr><td width="1000" height="15" align="right"> </td></tr>
  
   <tr><td width="1000"  align="right" style="font-family:Tahoma; font-size:14px;color:#24366F;">
 
 <table cellpadding="0" cellspacing="0" border="0" align="right">

 <tr><td width="30" height="31"></td><td width="300" height="25"><b>العملة</b></td><td width="400" height="25">'.(isset($_POST["currency"]) ? $_POST["currency"] : '').'</td></tr>
  <tr><td width="30" height="31"></td><td width="300" height="25"><b>المبلغ</b></td><td width="400" height="25">'.(isset($_POST["figures"]) ? number_format($_POST["figures"], 2, '.', ',') : '').'</td></tr>
  <tr><td width="30" height="31"></td><td width="300" height="25"><b>المبلغ بالكلمات</b></td><td width="600" height="25">'.(isset($_POST["words"]) ? $_POST["words"] : '').'</td></tr>

     
     <tr><td width="30" height="31"></td><td width="300" height="25"><b>اسم المستفيد</b></td><td width="400" height="25">'.(isset($_POST["bname"]) ? $_POST["bname"] : '').'</td></tr>
	
	    <tr><td width="30" height="31"></td><td width="300" height="25"><b>اسم بنك المستفيد</b></td><td width="400" height="25">'.(isset($_POST["bbn"]) ? $_POST["bbn"] : '').'</td></tr>
		 <tr><td width="30" height="31"></td><td width="300" height="25"><b>غرض الحوالة</b></td><td width="400" height="25">'.(isset($_POST["tp"]) ? $_POST["tp"] : '').'</td></tr>
	 <tr><td width="30" height="31"></td><td width="300" height="25"><b>رقم آيبان المستفيد / IBAN ('.(isset($_POST['acctype']) ? $_POST['acctype'] : 'IBAN').')</b></td><td width="400" height="25">'.(isset($_POST["bacc"]) ? $_POST["bacc"] : '').'</td></tr>
  </table>
 
 </td></tr>
 
 <tr><td width="1000" height="30"  align="right"> </td></tr>';
  if(isset($_POST["issue2"]) && $_POST["issue2"]=="Standing Order"){
	 $html.=' <tr><td width="1000" height="46"  bgcolor="#24366F" align="right">
 
 <table cellpadding="0" cellspacing="0" border="0">
 <tr><td colspan="2" width="1000" height="15"></td></tr>
 <tr><td width="30" height="31"></td><td width="970" height="31" style="font-family:TrajanPro; font-size:15px; font-weight:normal; color:#ffffff;">Standing Order Details</td></tr>
  </table>
 
 </td></tr>
 
  <tr><td width="1000" height="15"  align="right"> </td></tr>
  
   <tr><td width="1000"  align="left" style="font-family:Tahoma; font-size:14px;color:#24366F;">
 
 <table cellpadding="0" cellspacing="0" border="0" align="right">

 <tr><td width="30" height="31"></td><td width="300" height="25"><b>تاريخ البدء</b></td><td width="400" height="25">'.(isset($_POST["startdate"]) ? $_POST["startdate"] : '').'</td></tr>
  <tr><td width="30" height="31"></td><td width="300" height="25"><b>تاريخ الإنتهاء</b></td><td width="400" height="25">'.(isset($_POST["enddate"]) ? $_POST["enddate"] : '').'</td></tr>
   <tr><td width="30" height="31"></td><td width="300" height="25"><b>التردد</b></td><td width="700" height="25">'.(isset($_POST["paymentfreq"]) ? $_POST["paymentfreq"] : '').'</td></tr>
     <tr><td width="30" height="31"></td><td width="300" height="25"><b>عدد الحوالات</b></td><td width="400" height="25">'.(isset($_POST["numberoftransfer"]) ? $_POST["numberoftransfer"] : '').'</td></tr>
	  
	
  </table>
 
 </td></tr>
 
 <tr><td width="1000" height="30"  align="left"> </td></tr>';
	 }

 $html.='

 
 
  <tr><td width="1000"  align="right"  ><table cellpadding="0" cellspacing="0" border="0" align="right"><tr><td width="499" valign="top" align="right" ><table cellpadding="0" cellspacing="0" border="0" align="right">  
     <tr><td width="499" height="46"  bgcolor="#24366F" align="right"><table cellpadding="0" cellspacing="0" border="0" align="right">
 <tr><td colspan="2" width="499" height="15"></td></tr><tr><td width="30" height="31"></td><td width="469" height="31" style="font-family:TrajanPro; font-size:15px; font-weight:normal; color:#ffffff;" align="right">بيانات مقدم الطلب</td></tr>
  </table></td></tr>
 <tr><td width="499" height="15"  align="right"> </td></tr>
 
 <tr><td width="499"  align="left" style="font-family:Tahoma; font-size:14px;color:#24366F;">
 
 <table cellpadding="0" cellspacing="0" border="0" align="right"><tr><td width="30" height="31"></td><td width="200" height="25" align="right"><b>الاسم</b></td><td width="200" height="25">'.(isset($_POST["pname"]) ? $_POST["pname"] : '').'</td></tr><tr><td width="30" height="20"></td><td width="400" height="20" colspan="2"><b>قيدوا على رقم حسابي</b></td></tr><tr><td width="30" height="30"></td><td width="400" height="20" colspan="2">'.(isset($_POST["debit"]) ? $_POST["debit"] : '').'</td></tr><tr><td width="30" height="31"></td><td width="200" height="25"><b>رقم الهاتف / الجوال</b></td><td width="200" height="25">'.(isset($_POST["tel"]) ? $_POST["tel"] : '').'</td></tr><tr><td width="30" height="20"></td><td width="400" height="20" colspan="2"><b>مرجع مقدم الطلب</b></td></tr><tr><td width="30" height="30"></td><td width="400" height="20" colspan="2">'.(isset($_POST["ibanad"]) ? $_POST["ibanad"] : '').'</td></tr>
  </table></td></tr></table></td>
    <td width="1"><img src="'.dirname(__FILE__).DIRECTORY_SEPARATOR.'sep.jpg" width="1" /></td>
    <td width="500" valign="top" align="right"><table cellpadding="0" cellspacing="0" border="0"><tr><td width="500" height="46"  bgcolor="#24366F" align="right"><table cellpadding="0" cellspacing="0" border="0">
 <tr><td colspan="2" width="500" height="15"></td></tr>
 <tr><td width="30" height="31"></td><td width="470" height="31" style="font-family:TrajanPro; font-size:15px; font-weight:normal; color:#ffffff;">لاستخدام البنك فقط</td></tr> </table> </td></tr>
 <tr><td width="500" height="15"  align="right"> </td></tr>
 <tr><td width="500"  align="right" style="font-family:Tahoma; font-size:14px;color:#24366F;"><table cellpadding="0" cellspacing="0" border="0"><tr><td width="30" height="31"></td><td width="200" height="25"><b>سعر الصرف</b></td><td width="200" height="25">-------------------------------------</td></tr><tr><td width="30" height="31"></td><td width="200" height="25"><b></b></td><td width="200" height="25"></td></tr> <tr><td width="30" height="31"></td><td width="200" height="25"><b></b></td><td width="200" height="25"></td></tr><tr><td width="30" height="31"></td><td width="200" height="25"><b></b></td><td width="200" height="25"></td></tr></table></td></tr></table></td></tr></table> </td></tr><tr><td width="1000"  border="1"><table cellpadding="0" cellspacing="0" border="0"><tr>
 <td width="499" height="96"   align="right"><table cellpadding="0" cellspacing="0" border="0">
 <tr><td width="30" height="96"></td><td width="469" height="96" style="font-family:TrajanPro; font-size:15px; font-weight:normal; color:#24366F;">توقيع العميل </td></tr></table> </td><td width="500" height="96"   align="left" ><table cellpadding="0" cellspacing="0" border="1" align="right"><tr><td width="250" height="96" bgcolor="#f5ece3" style="font-family:TrajanPro; font-size:15px; font-weight:normal; color:#24366F;" align="right">&nbsp;&nbsp;روجع من قبل</td><td width="250" height="96" style="font-family:TrajanPro; font-size:15px; font-weight:normal; color:#24366F;"  bgcolor="#f5ece3" align="right">&nbsp;&nbsp;معتمد من </td></tr></table> </td>
 </tr>
 </table>
 </td></tr></table>
 </td></tr></table>
 
  <table cellpadding="0" cellspacing="0" border="0">
 <tr><td width="1000" height="20"></td></tr>
 <tr><td width="1000" height="20" align="right" style="font-family:Tahoma; font-size:14px; color:#24366F;">
 أنا أوافق/ نحن نوافق على تطبيق الشروط والأحكام العامة للبنك المتعلقة بعمليات الحسابات البنكية والخدمات المصرفية الإلكترونية المعمول بها في عمليات الدفع والتحويلات
  <br />
أنا أقبل / نحن نقبل  أن يقوم البنك فقط بتحويل الأموال وفقاً للمعلومات المطبوعة في هذه الاستمارة، ويجب تجاهل أي تعديل  أو إضافة  أدخلت على النموذج المطبوع يدوياً
<br>
 أنا أقبل / نحن نقبل أيضاً أن يستخدم بنك بروة رقم الحساب المقدم للقيام بالدفع دون التحقق أو الرجوع إلى اسم المستفيد أو أي تفاصيل أخرى مقدمة 
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
$pdf->Output('Internal_Transfer_Within_Dukhan_Bank_Ar.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
