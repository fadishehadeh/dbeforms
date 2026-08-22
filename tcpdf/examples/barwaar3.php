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
<tr><td width="1000" height="66" bgcolor="#24366F" align="center"  style="font-family:TrajanPro; font-size:17px; color:#ffffff;"><br><br> طلب تحويل أموال / شيك مصرفي معتمد </td></tr>
<tr><td width="1000" height="15"></td></tr>


<tr><td width="1000" height="612" border="1" bordercolor="#24366F" align="right" valign="top">
<table cellpadding="0" cellspacing="0" border="0" align="right">
<tr><td width="1000" height="10"></td></tr>
<tr><td width="1000" height="40" style="font-family:Tahoma; font-size:14px;color:#24366F;">
	<table cellpadding="0" cellspacing="0" border="0" align="right">
	<tr><td width="30" height="40"></td><td width="250" height="40" align="right"><b>نرجو التكرم بإصدار</b></td><td width="300" height="40" align="right">شيك مصرفي </td></tr>
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

 <tr><td width="30" height="31"></td><td width="400" height="25"><b>العملة</b></td><td width="600" height="25">'.(isset($_POST["currency"]) ? $_POST["currency"] : '').'</td></tr>
  <tr><td width="30" height="31"></td><td width="400" height="25"><b>المبلغ</b></td><td width="600" height="25">'.(isset($_POST["figures"]) ? number_format($_POST["figures"], 2, '.', ',') : '').'</td></tr>
  <tr><td width="30" height="31"></td><td width="400" height="25"><b>المبلغ بالكلمات</b></td><td width="600" height="25">'.(isset($_POST["words"]) ? $_POST["words"] : '').'</td></tr>

     <tr><td width="30" height="31"></td><td width="400" height="25"><b>اسم المستفيد</b></td><td width="600" height="25">'.(isset($_POST["bname"]) ? $_POST["bname"] : '').'</td></tr>

  </table>

 </td></tr>';

// Purpose code mapping for Corporate customers
$mainPurposeNames = array(
	"50" => "المصاريف التشغيلية",
	"51" => "السلع والخدمات",
	"52" => "الخدمات المالية",
	"53" => "الموارد البشرية",
	"54" => "خدمات التأمين",
	"55" => "مدفوعات المشاريع",
	"56" => "المسؤولية الاجتماعية",
	"57" => "المعاملات المؤسسية",
	"58" => "الخدمات الحكومية",
	"59" => "الاستثمارات",
	"60" => "مقدم خدمة الدفع",
	"61" => "الأعمال الخيرية",
	// Individual customer purpose codes (Arabic)
	"10" => "النفقات الشخصية والاسرية",
	"11" => "السلع والخدمات",
	"12" => "التعليم والتدريب",
	"13" => "المصاريف الطبية",
	"14" => "الترفيه (السياحة والسفر)",
	"15" => "مصاريف الأجور",
	"16" => "الاستثمارات",
	"17" => "الاعمال خيرية",
	"18" => "مدفوعات الفواتير",
	"19" => "الخدمات المالية",
	"20" => "الخدمات الحكومية"
);

$subPurposeNames = array(
	// Corporate purpose codes (Arabic - matching the form)
	"5000" => "مدفوعات الإيجار",
	"5001" => "مدفوعات الخدمات والرسوم والتكاليف (الصيانة والإصلاح والاستشارات)",
	"5002" => "فواتير المرافق (الكهرباء والمياه والغاز والتبريد)",
	"5050" => "شراء الأثاث والمعدات والمواد الخام واللوازم (اقتناء البضائع)",
	"5051" => "دفع رسوم الملكية الفكرية والعلامات التجارية أو العلامات التجارية",
	"5052" => "رسوم الاستيراد والتصدير",
	"5053" => "خدمات تكنولوجيا المعلومات وشراء البرمجيات",
	"5054" => "مدفوعات الشحن والنقل",
	"5055" => "التسويات القانونية",
	"5056" => "تطوير البنية التحتية",
	"5057" => "الطلبات / المشتريات عبر الإنترنت",
	"5100" => "مدفوعات القروض والفوائد",
	"5101" => "توزيع المساهمين / الأرباح",
	"5102" => "تمويل الاستثمار",
	"5103" => "المعاملات الائتمانية",
	"5104" => "عمليات الاندماج والاستحواذ",
	"5105" => "التحويلات النقدية",
	"5106" => "الرسوم والعمولات",
	"5150" => "الرواتب والأجور",
	"5151" => "مدفوعات المكافآت",
	"5152" => "البدلات الأخرى (تشمل بدل السفر وتسييل الإجازات)",
	"5153" => "رسوم المدرسة / الجامعة",
	"5154" => "دفع المعاش التقاعدي",
	"5155" => "التعويض",
	"5156" => "مساهمات الضمان الاجتماعي",
	"5157" => "مزايا نهاية الخدمة",
	"5200" => "التأمين العام",
	"5201" => "تأمين الموظفين",
	"5202" => "تأمين الأصول",
	"5203" => "تأمين المسؤولية",
	"5250" => "مدفوعات المشاريع الرأسمالية",
	"5251" => "مدفوعات البناء والتطوير",
	"5252" => "دفع الصيانة",
	"5253" => "الخدمات الاستشارية",
	"5300" => "المبادرات البيئية",
	"5350" => "الدفع داخل الشركة أو المجموعة (المعاملات بين المجموعات للشركة الأم أو الشركات التابعة الأخرى)",
	"5351" => "الاستثمارات المشتركة",
	"5352" => "معاملات الخزانة أي عمليات التحوط ووضع الودائع الثابتة ومعاملات المقايضة",
	"5353" => "صرف العملات",
	"5400" => "الخدمات الحكومية",
	"5401" => "مدفوعات المحاكم",
	"5402" => "مدفوعات الضرائب",
	"5403" => "مدفوعات الجمارك",
	"5450" => "الاستثمار في العقارات",
	"5451" => "الاستثمار في الأسهم / الأسهم / السندات",
	"5452" => "استثمارات أخرى",
	"5500" => "تسوية التاجر",
	// Individual customer sub-purpose codes (Arabic)
	"101000" => "مساعدات أسرية / أصدقاء",
	"101001" => "التحويلات بين الحسابات الشخصية / تغذية الحساب والتوفير",
	"101002" => "التسويات الشخصية",
	"101003" => "مدفوعات بطاقة الائتمان",
	"101004" => "تغذية النقدية (المحفظة الإلكترونية - البطاقات المدفوعة مسبقاً)",
	"101005" => "سحب نقدي - المحفظة الإلكترونية",
	"101006" => "طلبات الدفع المستمر",
	"111000" => "التسوق عبر الإنترنت",
	"111001" => "مشتريات التجزئة",
	"111002" => "الخدمات المهنية",
	"111003" => "الخدمات المنزلية",
	"111004" => "خدمات الاشتراك",
	"121000" => "الرسوم الدراسية",
	"121001" => "المواد التعليمية",
	"121002" => "دورات التدريب",
	"121003" => "برامج الشهادات",
	"131000" => "العلاج الطبي",
	"131001" => "الأدوية الموصوفة",
	"131002" => "التأمين الطبي",
	"131003" => "رعاية الأسنان",
	"131004" => "المكملات الصحية",
	"141000" => "مصاريف السفر",
	"141001" => "إقامة الفندق",
	"141002" => "تذاكر الطيران",
	"141003" => "فعاليات الترفيه",
	"141004" => "أنشطة الترفيه",
	"151000" => "مدفوعات الراتب",
	"151001" => "مدفوعات العمل الحر",
	"151002" => "مدفوعات المكافآت",
	"161000" => "شراء الأسهم",
	"161001" => "استثمارات الصناديق المشتركة",
	"161002" => "الاستثمار العقاري",
	"161003" => "استثمار العملة المشفرة",
	"181000" => "فواتير المرافق",
	"181001" => "فواتير الاتصالات",
	"181002" => "أقساط التأمين",
	"181003" => "مدفوعات القروض",
	"181004" => "فواتير بطاقة الائتمان",
	"191000" => "الخدمات المصرفية",
	"191001" => "خدمات الاستثمار",
	"191002" => "خدمات التأمين",
	"191003" => "الاستشارات المالية",
	"201000" => "الرسوم الحكومية",
	"201001" => "مدفوعات الضرائب",
	"201002" => "تجديد التراخيص",
	"201003" => "طلبات التصاريح"
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
         <tr><td width="30" height="31"></td><td width="400" height="25"><b>الغرض من الدفع (المتطلبات التنظيمية)</b></td><td width="600" height="25">'.$mainText.'</td></tr>
         <tr><td width="30" height="31"></td><td width="400" height="25"><b>تفاصيل الدفع</b></td><td width="600" height="25">'.$subText.'</td></tr>

  </table>

 </td></tr>
	 
  </table>
 
 </td></tr>';
 

 
  $html.='
 

 
 

 
 
 
 <tr><td width="1000" height="30"  align="left"> </td></tr>

 
 
  <tr><td width="1000"  align="right"  ><table cellpadding="0" cellspacing="0" border="0" align="right"><tr><td width="499" valign="top" align="right" ><table cellpadding="0" cellspacing="0" border="0" align="right">  
     <tr><td width="499" height="46"  bgcolor="#24366F" align="right"><table cellpadding="0" cellspacing="0" border="0" align="right">
 <tr><td colspan="2" width="499" height="15"></td></tr><tr><td width="30" height="31"></td><td width="469" height="31" style="font-family:TrajanPro; font-size:15px; font-weight:normal; color:#ffffff;" align="right">بيانات مقدم الطلب</td></tr>
  </table></td></tr>
 <tr><td width="499" height="15"  align="right"> </td></tr>
 
 <tr><td width="499"  align="left" style="font-family:Tahoma; font-size:14px;color:#24366F;">
 
 <table cellpadding="0" cellspacing="0" border="0" align="right"><tr><td width="30" height="31"></td><td width="200" height="25" align="right"><b>الاسم</b></td><td width="200" height="25">'.(isset($_POST["pname"]) ? $_POST["pname"] : '').'</td></tr><tr><td width="30" height="20"></td><td width="400" height="20" colspan="2"><b>قيدوا على رقم حسابي</b></td></tr><tr><td width="30" height="30"></td><td width="400" height="20" colspan="2">'.(isset($_POST["debit"]) ? $_POST["debit"] : '').'</td></tr><tr><td width="30" height="31"></td><td width="200" height="25"><b>رقم الهاتف / الجوال</b></td><td width="200" height="25">'.(isset($_POST["tel"]) ? $_POST["tel"] : '').'</td></tr>
  </table></td></tr></table></td>
    <td width="1"><img src="'.dirname(__FILE__).DIRECTORY_SEPARATOR.'sep.jpg" width="1" /></td>
    <td width="500" valign="top" align="right"><table cellpadding="0" cellspacing="0" border="0"><tr><td width="500" height="46"  bgcolor="#24366F" align="right"><table cellpadding="0" cellspacing="0" border="0">
 <tr><td colspan="2" width="500" height="15"></td></tr>
 <tr><td width="30" height="31"></td><td width="470" height="31" style="font-family:TrajanPro; font-size:15px; font-weight:normal; color:#ffffff;">لاستخدام البنك فقط</td></tr> </table> </td></tr>
 <tr><td width="500" height="15"  align="right"> </td></tr>
 <tr><td width="500"  align="right" style="font-family:Tahoma; font-size:14px;color:#24366F;"><table cellpadding="0" cellspacing="0" border="0"><tr><td width="30" height="31"></td><td width="200" height="25"><b>رقم المرجع</b></td><td width="200" height="25">-------------------------------------</td></tr><tr><td width="30" height="31"></td><td width="200" height="25"><b></b></td><td width="200" height="25"></td></tr> <tr><td width="30" height="31"></td><td width="200" height="25"><b></b></td><td width="200" height="25"></td></tr><tr><td width="30" height="31"></td><td width="200" height="25"><b></b></td><td width="200" height="25"></td></tr></table></td></tr></table></td></tr></table> </td></tr><tr><td width="1000"  border="1"><table cellpadding="0" cellspacing="0" border="0"><tr>
 <td width="499" height="96"   align="right"><table cellpadding="0" cellspacing="0" border="0">
 <tr><td width="30" height="96"></td><td width="469" height="96" style="font-family:TrajanPro; font-size:15px; font-weight:normal; color:#24366F;">توقيع العميل </td></tr></table> </td><td width="500" height="96"   align="left" ><table cellpadding="0" cellspacing="0" border="1" align="right"><tr><td width="250" height="46" bgcolor="#f5ece3" style="font-family:TrajanPro; font-size:15px; font-weight:normal; color:#24366F;" align="right">&nbsp;&nbsp;روجع من قبل</td><td width="250" height="96" style="font-family:TrajanPro; font-size:15px; font-weight:normal; color:#24366F;"  bgcolor="#f5ece3" align="right">&nbsp;&nbsp;معتمد من </td></tr></table> </td>
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
$pdf->Output('Manager_Cheque_Request_Ar.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
