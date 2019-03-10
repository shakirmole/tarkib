<?php	
	function loadTemplate($tpl, $data=array(), $filename="") {
		global $templateData;
		global $format;
		
		global $module;
		global $action;
		
		if ( $format == 'excel' and file_exists('views/excel/'.$tpl) ) {
			if ( empty($filename) ) $filename = 'excel_output';
			$filename .= '_' . date('dMy');
			loadExcelTemplate($filename,$tpl,$data);
			} else {
			
			if ( ! empty($data) ) {
				$data = array_merge((array)$data, (array)$templateData);
				$templateData = $data;
			}
			extract ( (array) $data );
			
			
			ob_start();
			@include 'views/' . $tpl ;
			
			// Remove when deploying on Client PC!
			if ( $format == 'excel' ) echo '<script>alert("Excel File Not Available for Download")</script>';
			
			$output = ob_get_contents();
			ob_end_clean();
			return $output;
		}
	}
	
	function cleanInput($str) {
		return trim($str);
	}
	
	function url($module, $action, $params="") {
		if ( is_array($params) ) {
			$str_params = '';
			foreach($params as $k=>$v) $str_params .= $k .'=' . urlencode($v) . '&';
			$params = $str_params;
			} else {
			if (!empty($params)) $params.='&';
		}
		return '?' . $params . 'module=' . $module . '&action=' . $action;
	}
	
	function base_url() {
		return '';
	}
	
	function redirect($module, $action, $params="") {
		$url = url($module,$action,$params);
		header('Location: ' . $url);
		die();
	}
	
	function redirectBack() {
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		die();
	}
	
	function getAction() {
		global $action;
		return $action;
	}
	
	function getModule() {
		global $module;
		return $module;
	}
	
	function selected($a,$b,$val1='selected',$val2='') {
		return $a==$b?$val1:$val2;
	}
	
	function fDate($dt, $format='jS F Y') {
		if (strtotime($dt)) return date($format,strtotime($dt));
		else return 'N/A';
	}
	
	function formatN($no, $decimals=2) {
		return number_format($no, $decimals);
	}

	function daysBetweenDates($fromdate,$todate) {
		$fromdate = new DateTime($fromdate);
		$todate = new DateTime($todate);

		$days = $todate->diff($fromdate)->format("%a") + 1;
		return $days;
	}
	
	function resizeAndUploadImage($uploaddir,$image,$ctrl_imgwidth,$new_imgheight,$name="") { //$image = "array";
		$time = time();
		
		if(!file_exists($uploaddir)){
			mkdir($uploaddir);
		}
		
		if ( $image['name'] ) {
			$size = getimagesize($image["tmp_name"]); //check if image is uploaded if it has image size
			if ($size) { //resize image to 200xp width
				$extension = pathinfo($image['name'], PATHINFO_EXTENSION);
				if($extension == "gif")	{ $imgconv = imagecreatefromgif($image["tmp_name"]);	}
				elseif($extension == "jpg" || $extension == "jpeg")	{ $imgconv = imagecreatefromjpeg($image["tmp_name"]);	}
				else if($extension=="png") { $imgconv = imagecreatefrompng($image["tmp_name"]); }
				list($imgwidth,$imgheight) = getimagesize($image["tmp_name"]); //current image dimensions
				$tmp_img = imagecreatetruecolor($ctrl_imgwidth,$new_imgheight); //determine height
				imagecopyresampled($tmp_img,$imgconv,0,0,0,0,$ctrl_imgwidth,$new_imgheight,$imgwidth,$imgheight); //resize
				imagejpeg($tmp_img,$uploaddir . $time . '_' . strtolower($image['name']),100); //uploading
				imagedestroy($imgconv);
				imagedestroy($tmp_img);		
				return $imageName = $time . '_' . strtolower($image['name']);
			}
		}
	}
	
	function uploadFile($uploaddir,$file,$name) {
		$time = time();
					
		if(!file_exists($uploaddir)){
			mkdir($uploaddir,0777,true);
		}
		
		if ($file['name']) {
			$extension = pathinfo($file["name"], PATHINFO_EXTENSION);
			$filename = $name."_$time.".$extension;
			
			move_uploaded_file($file["tmp_name"], $uploaddir . '/' . $filename);
			return $filename;
		}
	}

	function displayHint($text) {
		return $code = " data-role='hint' data-hint-text='$text'";
	}
	
	function createValidator() {
		return $code = " data-role=\"validator\" data-on-error=\"notifyOnErrorInput; triggerInputError(this); \" data-show-error-hint=\"true\" data-on-error-form=\"triggerError('Errors Found')\" ";
	}
	
	function insertHiddenInput($name,$value,$class='') {
		$code = "<input type='hidden' class='$class' name='$name' value='$value'>";
		
		return $code;
	}
	
	function printFooter() {
		$code='<div class="grid" style="border-top:4px double black;">
				<div class="row">
					<div class="cell-12 text-center">
						Auto Xperts Tanzania Limited<br>
						P.O.BOX 22693, Dar es Salaam, Reg. Office Plot No. 448 <br>
						Haile Selasse Road, Oysterbay Area, Tel: 0684 887 432 <br>
						E-mail: info@axtl.biz / Website: www.axtl.bix
					</div>
				</div>
			</div>';
		
		return $code;
	}
	
	function insertTextInput($label,$name,$value,$class,$title,$type,$fullsize=0,$validate='',$other='',$otherclass="") {
		if ($fullsize) $fullsize = 'full-size'; //unused
		
		$label = explode('|',$label); //label and/or placeholder
		if (!$label[1]) $label[1] = $label[0];
		if ($label[0]) $labeltext = "<label> $label[0] </label>";
		
		$validate = explode('|',$validate);
		if ($validate[0]) $valcode = $validate[0];
		if ($validate[1]) $valhint = $validate[1];
		
		$code = "$labeltext
            <input type='$type' name='$name' class='$class' title=\"$title\" value=\"$value\" data-role='' data-label='$label[1]'
			data-informer='$title' placeholder=\"$label[1]\" data-validate='$valcode' $other>
            <span class='invalid_feedback'>
                $valhint
            </span>";
		
		return $code;
	}
	
	function insertTextArea($label,$name,$value,$class,$title,$fullsize,$height=200,$validate='',$other='',$otherclass="") {
		if ($fullsize) $fullsize = 'full-size'; //unused
		
		$label = explode('|',$label); //label and/or placeholder
		if (!$label[1]) $label[1] = $label[0];
		if ($label[0]) $labeltext = "<label> $label[0] </label>";
		
		$validate = explode('|',$validate);
		if ($validate[0]) $valcode = $validate[0];
		if ($validate[1]) $valhint = $validate[1];		
		
		$code = "$labeltext
				<div>
					<textarea data-role='textarea' data-auto-size='true' data-max-height='$height' data-validate='$valcode' placeholder=\"$label[1]\" name='$name' class='$class' title=\"$title\" $other>$value</textarea>
				</div>
				<span class='invalid_feedback'>
					$valhint
				</span>";
		
		return $code;
	}
	
	function insertRadioInput($label,$name,$value,$class,$title,$small,$matchdatavalue,$validate='',$other='',$otherclass="") {
		if ($small) $small = 'small-check';
		$mdv = explode('|',$matchdatavalue);
		$matchvalue = $mdv[0]; $datavalue = $mdv[1];

		$validate = explode('|',$validate);
		if ($validate[0]) $valcode = $validate[0];
		if ($validate[1]) $valhint = $validate[1];

		if ($valcode) $valcode = "data-validate='$valcode'";
				
		$code = "<label class='input-control radio $small $otherclass'>
		<input type='radio' name='$name' value=\"$value\" class='$class' $valcode ".selected($matchvalue,$datavalue,'checked')." title=\"$title\" data-style='2' $other>
		<span class='check'></span>
		<span class='caption'>$label</span>
		<span class='invalid_feedback'>
			$valhint
		</span>
		</label>";
		
		return $code;
	}
	
	function insertCheckboxInput($label,$name,$value,$class,$title,$type,$matchdatavalue,$validate='',$other='',$otherclass="") {
		$mdv = explode('|',$matchdatavalue);
		$matchvalue = $mdv[0]; $datavalue = $mdv[1];		
				
		$validate = explode('|',$validate);
		if ($validate[0]) $valcode = $validate[0];
		if ($validate[1]) $valhint = $validate[1];

		if ($type=='switch') {		
			$code = "<div class='$otherclass'>
			<input type='checkbox' data-role='switch' data-caption='$label' data-validate='$valcode' name='$name' class='$class' title=\"$title\" ".selected($matchvalue,$datavalue,'checked')." value=\"$value\" data-style='2' $other>
			<span class='invalid_feedback'>
				$valhint
			</span>
			</div>";
		} else if ($type=='normal') {
			$code = "<div class='$otherclass'>
			<input type='checkbox' data-role='checkbox' data-caption='$label' data-validate='$valcode' name='$name' class='$class' title=\"$title\" ".selected($matchvalue,$datavalue,'checked')." value=\"$value\" $other>
			<span class='invalid_feedback'>
				$valhint
			</span>
			</div>";
		}
		
		return $code;
	}
	
	function insertSelect($label,$name,$class,$title,$searchable,$firstempty,$data,$datanamevalue,$matchfieldvalue,$validate='',$other='',$otheropt='',$otherclass='') {
		// if ($fullsize) $fullsize = 'full-size'; //unused
		if ($searchable) $searchable = 'searchable';
		if ($firstempty) $firstempty = '<option></option>';
		
		$dnv = explode('|',$datanamevalue);
		$dataname = $dnv[0]; $datavalue = $dnv[1];
		
		$mfv = explode('|',$matchfieldvalue);
		$matchfield = $mfv[0]; $matchvalue = $mfv[1];
		
		$validate = explode('|',$validate);
		if ($validate[0]) $valcode = $validate[0];
		if ($validate[1]) $valhint = $validate[1];
		
		foreach ($data as $r) {
			$options .= "<option value=\"".$r[$datavalue]."\" ".selected($r[$matchfield],$matchvalue,'selected')." $otheropt>".$r[$dataname]."</option>";
		}
		
		if ($label) $label = "<label> $label </label>";
		$code="$label
		<div class='$otherclass'>
			<select name='$name' class='$class $searchable' title=\"$title\" data-validate='$valcode' $other>
			$firstempty
			$options
			</select>
			<span class='invalid_feedback'>
                $valhint
            </span>
		</div>";
		
		return $code;
	}
	
	function insertFileInput($label,$name,$preview='',$class='',$title='',$fullsize='') {
		if ($fullsize) $fullsize = 'full-size'; //unused
		if ($preview) $preview = "<a href='$preview' target='_blank'>Preview</a>";
		
		$code ="<label> $label </label>
		$preview <br>
		<div class='file $fullsize'>
		<input type='file' class='$class' name='$name' title=\"$title\" value=\"$value\">
		<button class='button'><span class='fg-white mif-folder'></span></button>
		</div>";
		
		$code = "<label> $label </label>
				$preview <br>
				<input type='file' class='$class sp_button' name='$name' title=\"$title\" value=\"$value\" data-role='file' data-caption='<span class=\"mif-folder sp_icon \"></span>'>
				<a class='button small' href='http://pdfcompressor.com' target='_blank'><small>Image Compressor</small></a>
				<a class='button small' href='http://imagecompressor.com' target='_blank'><small>PDF Compressor</small></a>";
		
		return $code;
	}
	
	function insertSaveButton($label,$module='',$action='',$class='',$onclick='') {
		if ($module && $action) $onclick .= "submitForm(this,\"?module=$module&action=$action\");return false;";
		$code = "<input type='submit' class='submit $class' onclick='$onclick' value=\"$label\">";
		
		return $code;
	}
	
	function windowOnSubmit($module,$action,$other='') {
		return "class='window-form' data-on-submit=\"$other submitForm(this,'?module=$module&action=$action');  maskInputs(); return false;\" ";
	}
	
	function sendEmail($to, $subject, $cc='', $body_html='', $from='', $fromName='') {
		require 'phpmailer/PHPMailerAutoload.php'; 
		
		$mail = new PHPMailer; 
		$mail->SMTPDebug = 0;                               // Enable verbose debug output
		$mail->Debugoutput = 'html';
		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = 'smtp.zoho.com';  // Specify main and backup SMTP servers  mail.spiknspantz.com  simba.tanzaniawebhosting.com
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = 'no-reply@broncopay.co.tz';                 // SMTP username
		$mail->Password = 'D3ll5hifT12*';                           // SMTP password
		$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 465;                                  // TCP port to connect to  465  26 | 587 was default
		$mail->From = 'no-reply@broncopay.co.tz';
		$mail->FromName = $fromName;
		$mail->addAddress($to, 'Do not reply');     // Add a recipient
		if ($cc) $mail->addAddress($cc, $cc);
		
		$mail->isHTML(true);                                  // Set email format to HTML
		$mail->Subject = $subject;
		$mail->Body    = $body_html;
		
		if(!$mail->send()) {
			$serverMsg =  'Failed';
		} else{
			$serverMsg = 'Success';
		}
	}
?>