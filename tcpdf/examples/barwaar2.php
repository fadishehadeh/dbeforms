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
<tr><td width="1000" height="75" align="center" ><img src="https://www.dukhanbank.com/e-forms/logonew.jpg" border="0" height="75"  /></td></tr>
<tr><td width="1000" height="20" align="left" style="font-family:Tahoma; font-size:14px;color:#24366F;" >';

$html.=(isset($_POST["currentdate"]) ? $_POST["currentdate"] : date('Y-m-d')).'</td></tr>
<tr><td width="1000" height="66" bgcolor="#24366F" align="center"  style="font-family:TrajanPro; font-size:17px; color:#ffffff;"><br><br>طلب تحويل أموال / الدفع الالكتروني</td></tr>
<tr><td width="1000" height="15"></td></tr>


<tr><td width="1000" height="612" border="1" bordercolor="#24366F" align="right" valign="top">
<table cellpadding="0" cellspacing="0" border="0" align="right">
<tr><td width="1000" height="10"></td></tr>
<tr><td width="1000" height="40" style="font-family:Tahoma; font-size:14px;color:#24366F;">
	<table cellpadding="0" cellspacing="0" border="0" align="right">
	<tr><td width="30" height="25"></td><td width="250" height="25" align="right"><b>نرجو التكرم بإصدار</b></td><td width="300" height="25" align="right">حوالة خارجية</td></tr>
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

 <tr><td width="30" height="31"></td><td width="400" height="25"><b>العملة</b></td><td width="600" height="25">'.(isset($_POST["currency"]) ? $_POST["currency"] : '').'</td></tr>
 <tr><td width="30" height="31"></td><td width="400" height="25"><b>بلد المستفيد</b></td><td width="580" height="25">'.(isset($_POST["country"]) ? $_POST["country"] : '').'</td></tr>
 <tr><td width="30" height="31"></td><td width="400" height="25"><b>قناة التحويل</b></td><td width="580" height="25">'.(isset($_POST["transfer_channel"]) ? $_POST["transfer_channel"] : '').'</td></tr>
  <tr><td width="30" height="31"></td><td width="400" height="25"><b>المبلغ</b></td><td width="600" height="25">'.(isset($_POST["figures"]) ? number_format($_POST["figures"], 2, '.', ',') : '').'</td></tr>
<tr><td width="30" height="31"></td><td width="400" height="25"><b>المبلغ بالكلمات</b></td><td width="600" height="25">'.(isset($_POST["words"]) ? $_POST["words"] : '').'</td></tr>
<tr><td width="30" height="31"></td><td width="400" height="25"><b>الاسم الكامل للمستفيد</b></td><td width="600" height="25">'.(isset($_POST["bname"]) ? $_POST["bname"] : '').'</td></tr>
	 
	 <tr><td width="30" height="31"></td><td width="400" height="25"><b>عنوان المستفيد</b></td><td width="600" height="25">'.(isset($_POST["baddress"]) ? $_POST["baddress"] : '').'</td></tr>
	 <tr><td width="30" height="31"></td><td width="400" height="25"><b>مدينة المستفيد</b></td><td width="600" height="25">'.(isset($_POST["bcity"]) ? $_POST["bcity"] : '').'</td></tr>
	  
	 <tr><td width="30" height="31"></td><td width="400" height="25"><b>رقم آيبان المستفيد / IBAN ('.(isset($_POST['acctype']) ? $_POST['acctype'] : 'IBAN').')</b></td><td width="600" height="25">'.(isset($_POST["bacc"]) ? $_POST["bacc"] : '').'</td></tr>
	    <tr><td width="30" height="31"></td><td width="400" height="25"><b>رمز السويفت </b></td><td width="600" height="25">'.(isset($_POST["bbn"]) ? strtoupper($_POST["bbn"]) : '').'</td></tr>

		<tr><td width="30" height="31"></td><td width="400" height="25"><b>اسم بنك المستفيد </b></td><td width="600" height="25">'.(isset($_POST["bbname"]) ? strtoupper($_POST["bbname"]) : '').'</td></tr>

		<tr><td width="30" height="31"></td><td width="400" height="25"><b>عنوان بنك المستفيد </b></td><td width="600" height="25">'.(isset($_POST["bbadd"]) ? strtoupper($_POST["bbadd"]) : '').'</td></tr>
	
		
      
            ';
			
			
			if(isset($_POST["bct"]) && $_POST["bct"]!=""){
				$html.='<tr><td width="30" height="31"></td><td width="400" height="25"><b>نوع رمز البنك</b></td><td width="580" height="25">'.(isset($_POST["bct"]) ? $_POST["bct"] : '').' / '.(isset($_POST["bctt"]) ? $_POST["bctt"] : '').'</td></tr>';
				}
			
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
			"101000" => "مساعدات اسرية/أصدقاء",
			"101001" => "التحويلات بين الحسابات الشخصية / تغذية الحساب والتوفير",
			"101002" => "التسويات الشخصية",
			"101003" => "مدفوعات بطاقة الائتمان",
			"101004" => "تغذية النقدية (المحفظة الالكترونية- البطاقات المدفوعة مسباقاً)",
			"101005" => "سحب نقدي -المحفظة الالكترونية",
			"101006" => "طلبات الدفع المستمر",
			"111050" => "الطلبات/ المشتريات / اشتركات خدمية عبر الانترنت",
			"111051" => "خدمات التأمين",
			"111052" => "خدمات بناء، الصيانة والاستشارات",
			"111053" => "مدفوعات الإيجارات",
			"111054" => "خدمات السيارات (تشمل إصلاح وصيانة السيارات)",
			"111055" => "المشتريات عند نقاط البيع",
			"121100" => "رسوم المدارس / الجامعات",
			"121101" => "الدروس الخصوصية",
			"121102" => "الدورات التدريبية",
			"131150" => "استشارات الأطباء",
			"131151" => "الفحوصات والعلاجات الطبية",
			"141200" => "رسوم النقل",
			"141201" => "مصاريف السفر والسياحة",
			"141202" => "تكاليف الإقامة",
			"141203" => "مصاريف التأشيرات وتذاكر السفر",
			"151250" => "الرواتب والأجور",
			"151251" => "علاوات أخرى ( بدلات السفر والاجازات)",
			"151252" => "مكافئات",
			"161300" => "الاستثمار في العقارات",
			"161301" => "الاستثمار في الأسهم والسندات والصكوك",
			"161302" => "استثمارات أخرى",
			"181403" => "الاشتراكات ( الانترنت، باقات الهاتف الجوال وغيرها)",
			"181404" => "فواتير المرافق (الكهرباء، الماء، الغاز، التكييف)",
			"191450" => "مدفوعات القروض والفوائد",
			"191451" => "تأمينات عامة",
			"191452" => "تحويلات مالية خارجية",
			"191453" => "الرسوم والعمولات",
			"201500" => "الخدمات الحكومية",
			"201501" => "مدفوعات محاكم",
			"201502" => "مدفوعات الضرائب",
			"201503" => "مدفوعات الجمارك",
			// Non-Qatar (SWIFT) sub-purpose codes (Arabic)
			"B1B01" => "دفعة مقدّمة للواردات",
			"B1B02" => "دفعة واردات / تسوية فاتورة",
			"B1B03" => "واردات البعثات الدبلوماسية",
			"B1B04" => "تجارة وسيطة",
			"B2A01" => "فائض أجور الشحن/الركاب — شركات الشحن الأجنبية",
			"B2A02" => "مصروفات تشغيلية — شركات الشحن القطرية في الخارج",
			"B2A03" => "أجور شحن الواردات — شركات الشحن",
			"B2A05" => "تأجير تشغيلي بطاقم — شركات الشحن",
			"B2A06" => "حجز تذاكر السفر في الخارج — شركات الشحن",
			"B2A07" => "فائض أجور الشحن/الركاب — شركات الطيران الأجنبية",
			"B2A08" => "مصروفات تشغيلية — شركات الطيران القطرية",
			"B2A09" => "أجور شحن الواردات — شركات الطيران",
			"B2A11" => "تأجير تشغيلي بطاقم — شركات الطيران",
			"B2A12" => "حجز تذاكر السفر في الخارج — شركات الطيران",
			"B2A13" => "خدمات نقل أخرى (الشحن، غرامات التأخير، مناولة الموانئ)",
			"B2B01" => "سفر للأعمال",
			"B2B02" => "سفر عام",
			"B2B03" => "سفر للحج والعمرة",
			"B2B04" => "سفر للعلاج",
			"B2B05" => "سفر للدراسة",
			"B2B06" => "سفر آخر (بطاقات دولية)",
			"B2B07" => "بيع / إصدار العملات الأجنبية للمقيمين لأغراض استثمارية",
			"B2B08" => "بيع / إصدار العملات الأجنبية للمقيمين لأغراض السفر",
			"B2B09" => "المعاملات المنفّذة في الخارج باستخدام بطاقات الائتمان الصادرة عن البنك المُبلِّغ",
			"B2B10" => "المعاملات المنفّذة في الخارج باستخدام بطاقات الخصم الصادرة عن البنك المُبلِّغ",
			"B3A02" => "الودائع",
			"B3A03" => "أرباح ودائع غير المقيمين",
			"B3A04" => "أرباح قروض غير المقيمين",
			"B3A05" => "أرباح الأوراق المالية",
			"B3A06" => "مدفوعات أرباح البنوك لحسابات فوسترو/نوسترو",
			"B3A07" => "تعويضات العاملين (قصيرة الأجل)",
			"B4B07" => "مدفوعات / تحويل توزيعات الأرباح",
			"B2G01" => "صيانة السفارات القطرية في الخارج",
			"B2G02" => "تحويلات السفارات الأجنبية في قطر",
			"B2K01" => "تسوية مطالبات البريد",
			"B2K02" => "تسوية مطالبات الشحن السريع",
			"B2K03" => "تسوية مطالبات الاتصالات",
			"B2K04" => "خدمات الأقمار الصناعية",
			"B2D01" => "تكاليف إنشاء مشاريع الشركات القطرية في الخارج",
			"B2D02" => "تكاليف إنشاء مشاريع الشركات الأجنبية في قطر",
			"B2C01" => "قسط التأمين على الحياة",
			"B2C02" => "قسط التأمين العام",
			"B2C03" => "أقساط التأمين العام",
			"B2C04" => "قسط إعادة التأمين",
			"B2C05" => "خدمات تأمين مساندة (عمولات)",
			"B2C06" => "تسوية مطالبات التأمين",
			"B2F01" => "خدمات الوساطة المالية (باستثناء الخدمات المصرفية الاستثمارية)",
			"B2F02" => "خدمات المصرفية الاستثمارية",
			"B2F03" => "خدمات مالية مساندة (رسوم تنظيمية/حفظ/إيداع)",
			"B2G07" => "خدمات حكومية (تحويلات صادرة)",
			"B2E01" => "استشارات الأجهزة",
			"B2E02" => "تنفيذ البرمجيات",
			"B2E03" => "رسوم معالجة البيانات / قواعد البيانات",
			"B2E04" => "صيانة وإصلاح الحاسوب والبرمجيات",
			"B2E05" => "خدمات وكالات الأنباء",
			"B2E06" => "خدمات معلومات (اشتراكات)",
			"B2H01" => "خدمات سمعية بصرية (إنتاج، تأجير، أجور المواهب)",
			"B2H02" => "خدمات ثقافية شخصية (متاحف، مكتبات، أرشيف، رياضة)",
			"B2J01" => "خدمات الاتجار (مدفوعات صافية)",
			"B2J02" => "عمولات تجارية (الصادرات/الواردات)",
			"B2J03" => "تأجير تشغيلي بدون طاقم",
			"B2J04" => "خدمات قانونية",
			"B2J05" => "خدمات المحاسبة والتدقيق ومسك الدفاتر والضرائب",
			"B2J06" => "خدمات استشارات الأعمال والإدارة والعلاقات العامة",
			"B2J07" => "خدمات الإعلان وبحوث السوق واستطلاعات الرأي",
			"B2J08" => "خدمات البحث والتطوير",
			"B2J09" => "خدمات هندسية ومعمارية وتقنية",
			"B2J10" => "خدمات زراعية وتعدين ومعالجة ميدانية",
			"B2J11" => "صيانة مكاتب في الخارج",
			"B2J12" => "خدمات التوزيع",
			"B2J13" => "خدمات بيئية",
			"B2J19" => "خدمات أخرى غير مصنّفة",
			"B2R01" => "رسوم الامتيازات واستخدام الملكية الفكرية",
			"B2R02" => "رسوم التراخيص للأعمال الأصلية/النماذج",
			"B4A01" => "إعالة الأسرة والادخار",
			"B4B05" => "مساهمات حكومية للمنظمات الدولية",
			"B4B06" => "مدفوعات / استرداد الضرائب",
			"B5A17" => "شراء أصول غير ملموسة (براءات / علامات / حقوق نشر)",
			"B6C12" => "سداد قروض طويلة/متوسطة الأجل",
			"B6C13" => "سداد قروض قصيرة الأجل",
			"B6C11" => "قروض ممنوحة لغير المقيمين",
			"B6C15" => "تحويلات لحساب البنك الخاص في الخارج",
			"B6B01" => "استثمار خارجي قطري — أسهم",
			"B6B02" => "استثمار خارجي قطري — أوراق دين",
			"B6A03" => "استثمار في فروع/شركات مملوكة بالكامل",
			"B6A04" => "استثمار في الشركات التابعة والزميلة",
			"B6A05" => "استثمار عقاري في الخارج",
			"B6A06" => "إعادة رؤوس أموال الاستثمار الأجنبي المباشر — أسهم",
			"B6A07" => "إعادة رؤوس أموال الاستثمار الأجنبي المباشر — أوراق دين",
			"B6A08" => "إعادة رؤوس أموال الاستثمار الأجنبي المباشر — عقارات",
			"B6B09" => "إعادة استثمارات المحافظ الأجنبية — أسهم",
			"B6B10" => "إعادة استثمارات المحافظ الأجنبية — أوراق دين",
			"B6C14" => "إعادة ودائع غير المقيمين",
			"B6C18" => "مدفوعات رأسمالية أخرى غير مصنّفة",
			"B7A01" => "استردادات / خصومات / تخفيض قيمة الفاتورة على الصادرات",
			"B7B02" => "عكس قيود خاطئة / استرداد مبالغ خارج نطاق التصدير",
			"B7C03" => "مدفوعات بين مقيمين"
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
			 <tr><td width="30" height="31"></td><td width="400" height="25"><b>الغرض من التحويل </b></td><td width="600" height="25">'.(isset($_POST["tp"]) ? $_POST["tp"] : '').'</td></tr>
         <tr><td width="30" height="31"></td><td width="400" height="25"><b>الغرض من الدفع (المتطلبات التنظيمية)</b></td><td width="580" height="25">'.$mainText.'</td></tr>
         <tr><td width="30" height="31"></td><td width="400" height="25"><b>تفاصيل الدفع</b></td><td width="580" height="25">'.$subText.'</td></tr>
	 
  </table>
 
 </td></tr>
 
  <tr><td width="1000" height="10"  align="right"> </td></tr>';
 
 if(isset($_POST["issue2"]) && $_POST["issue2"]=="Standing Order"){
	 $html.=' <tr><td width="1000" height="46"  bgcolor="#24366F" align="right">
 
 <table cellpadding="0" cellspacing="0" border="0">
 <tr><td colspan="2" width="1000" height="15"></td></tr>
 <tr><td width="30" height="31"></td><td width="970" height="31" style="font-family:TrajanPro; font-size:15px; font-weight:normal; color:#ffffff;">Standing Order Details</td></tr>
  </table>
 
 </td></tr>
 
  <tr><td width="1000" height="15"  align="right"> </td></tr>
  
   <tr><td width="1000"  align="right" style="font-family:Tahoma; font-size:14px;color:#24366F;">
 
 <table cellpadding="0" cellspacing="0" border="0" align="right">

<tr><td width="30" height="31"></td><td width="300" height="25"><b>تاريخ البدء</b></td><td width="400" height="25">'.(isset($_POST["startdate"]) ? $_POST["startdate"] : '').'</td></tr>
  <tr><td width="30" height="31"></td><td width="300" height="25"><b>تاريخ الإنتهاء</b></td><td width="400" height="25">'.(isset($_POST["enddate"]) ? $_POST["enddate"] : '').'</td></tr>
   <tr><td width="30" height="31"></td><td width="300" height="25"><b>التردد</b></td><td width="700" height="25">'.(isset($_POST["paymentfreq"]) ? $_POST["paymentfreq"] : '').'</td></tr>
     <tr><td width="30" height="31"></td><td width="300" height="25"><b>عدد الحوالات</b></td><td width="400" height="25">'.(isset($_POST["numberoftransfer"]) ? $_POST["numberoftransfer"] : '').'</td></tr>
	  
	
  </table>
 
 </td></tr>
 
 <tr><td width="1000" height="10"  align="left"> </td></tr>';
	 }

 
 
 
 $html.='
 
 <tr><td width="1000" height="46"  bgcolor="#24366F" align="right">
 
 <table cellpadding="0" cellspacing="0" border="0" align="right">
 <tr><td colspan="2" width="1000" height="15"></td></tr>
 <tr><td width="30" height="31"></td><td width="970" height="31" style="font-family:TrajanPro; font-size:15px; font-weight:normal; color:#ffffff;" align="right">الرسوم</td></tr>
  </table>
 
 </td></tr>
 
 <tr><td width="1000" height="15"  align="right"> </td></tr>
 
 
 <tr><td width="1000"  align="right" style="font-family:Tahoma; font-size:14px;color:#24366F;">
 
 <table cellpadding="0" cellspacing="0" border="0" align="right">

 <tr><td width="30" height="31"></td><td width="300" height="25"><b>رسوم البنك المراسل</b></td><td width="700" height="25">'.(isset($_POST["cbc"]) ? $_POST["cbc"] : '').'</td></tr>
 <tr><td width="30" height="31"></td><td width="300" height="25"><b>رسوم بنك بروة</b></td><td width="700" height="25">'.(isset($_POST["cbc1"]) ? $_POST["cbc1"] : '').'</td></tr>
</table>
 
 </td></tr>
 
 
 
 <tr><td width="1000" height="10"  align="left"> </td></tr>

 
 
  <tr><td width="1000"  align="right"  ><table cellpadding="0" cellspacing="0" border="0" align="right"><tr><td width="499" valign="top" align="right" ><table cellpadding="0" cellspacing="0" border="0" align="right">  
     <tr><td width="499" height="46"  bgcolor="#24366F" align="right"><table cellpadding="0" cellspacing="0" border="0" align="right">
 <tr><td colspan="2" width="499" height="15"></td></tr><tr><td width="30" height="31"></td><td width="469" height="31" style="font-family:TrajanPro; font-size:15px; font-weight:normal; color:#ffffff;" align="right">بيانات مقدم الطلب</td></tr>
  </table></td></tr>
 <tr><td width="499" height="15"  align="right"> </td></tr>
 
 <tr><td width="499"  align="left" style="font-family:Tahoma; font-size:14px;color:#24366F;">
 
 <table cellpadding="0" cellspacing="0" border="0" align="right"><tr><td width="30" height="31"></td><td width="200" height="25" align="right"><b>الاسم</b></td><td width="200" height="25">'.(isset($_POST["pname"]) ? $_POST["pname"] : '').'</td></tr><tr><td width="30" height="31"></td><td width="200" height="25"><b>رقم الهاتف / الجوال</b></td><td width="200" height="25">'.(isset($_POST["tel"]) ? $_POST["tel"] : '').'</td></tr><tr><td width="30" height="20"></td><td width="400" height="20" colspan="2"><b>قيدوا على رقم حسابي</b></td></tr><tr><td width="30" height="30"></td><td width="400" height="20" colspan="2">'.(isset($_POST["debit"]) ? $_POST["debit"] : '').'</td></tr><tr><td width="30" height="20"></td><td width="400" height="20" colspan="2"><b>مرجع مقدم الطلب</b></td></tr><tr><td width="30" height="30"></td><td width="400" height="20" colspan="2">'.(isset($_POST["ibanad"]) ? $_POST["ibanad"] : '').'</td></tr>
  </table></td></tr></table></td>
    <td width="1"><img src="'.dirname(__FILE__).DIRECTORY_SEPARATOR.'sep.jpg" width="1" /></td>
    <td width="500" valign="top" align="right"><table cellpadding="0" cellspacing="0" border="0"><tr><td width="500" height="46"  bgcolor="#24366F" align="right"><table cellpadding="0" cellspacing="0" border="0">
 <tr><td colspan="2" width="500" height="15"></td></tr>
 <tr><td width="30" height="31"></td><td width="470" height="31" style="font-family:TrajanPro; font-size:15px; font-weight:normal; color:#ffffff;">لاستخدام البنك فقط</td></tr> </table> </td></tr>
 <tr><td width="500" height="15"  align="right"> </td></tr>
 <tr><td width="500"  align="right" style="font-family:Tahoma; font-size:14px;color:#24366F;"><table cellpadding="0" cellspacing="0" border="0"><tr><td width="30" height="31"></td><td width="200" height="25"><b>سعر الصرف</b></td><td width="200" height="25">-------------------------------------</td></tr><tr><td width="30" height="31"></td><td width="200" height="25"><b>رقم المرجع</b></td><td width="200" height="25">-------------------------------------</td></tr><tr><td width="30" height="31"></td><td width="200" height="25"><b> </b></td><td width="200" height="25"></td></tr> <tr><td width="30" height="31"></td><td width="200" height="25"><b></b></td><td width="200" height="25"></td></tr><tr><td width="30" height="31"></td><td width="200" height="25"><b></b></td><td width="200" height="25"></td></tr></table></td></tr></table></td></tr></table> </td></tr><tr><td width="1000"  border="1"><table cellpadding="0" cellspacing="0" border="0"><tr>
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
$pdf->Output('Electronic_Payment_Ar.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
