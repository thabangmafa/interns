<?php

include 'admin/connect.php';
$conn = OpenCon();



require_once("assets/dompdf/dompdf_config.inc.php");


//$headers .= 'Cc: dsi_hsrc_internship.queries@hsrc.ac.za,' . @$email_address_of_mentor;

$sql = "SELECT distinct * FROM EmailTemplates WHERE Title='Offer Accepted' ";

		$result = mysqli_query($conn, $sql);
		$emailDetails = mysqli_fetch_assoc($result);

//replace template var with value
$token = array(
    'name_of_institution'  => @$name_of_institution,
    'name_of_mentor' => @$name_of_mentor,
    'telephone_number_of_mentor' => @$telephone_number_of_mentor,
    'email_address_of_mentor'=> @$email_address_of_mentor,
	'candidates_name'=> @$candidates_name,
	'interview_date'=> @$interview_date,
	'applicant_email'=> @$applicant_email,
	'response_comments'=> @$Comments
	
);

foreach($token as $key=>$val){
    $varMap[sprintf($key)] = $val;
}

$emailContent = strtr($emailDetails['Details'],$varMap);
$EmailTo = strtr($emailDetails['EmailTo'],$varMap);


  if ( get_magic_quotes_gpc() )
    $emailContent = stripslashes($emailContent);
  
  $old_limit = ini_set("memory_limit", "160M");
  
  $dompdf = new DOMPDF();
  $dompdf->load_html($emailContent);
  $dompdf->set_paper("a4", "portrait");
  $dompdf->render();
  


$output = $dompdf->output();
file_put_contents("Signed Contract.pdf", $output);
$file = "Signed Contract.pdf"; 
//$files = array("","documents/(PYEI) Project waiver form - Final to be signed.docx","documents/EEA1 Form.doc","documents/HSRC 45 Bank form.doc");
$htmlContent = 'Dear somebody';
$email = "tmafa@hsrc.ac.za";		 
$subject = "DSI-HSRC Internship Programme";	
$headers = "From: noreply@hsrc.ac.za" . "\r\n";
$headers .= "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$fromEmail = 'noreply@hsrc.ac.za';
// Header for sender info 
//$headers = "From: $fromName"." <".$from.">"; 
 
// Boundary  
$semi_rand = md5(time());  
$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";  
 
// Headers for attachment  
$headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\";\n" . "Cc: ".$fromEmail.""; 
 
// Multipart boundary  
$message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" . 
"Content-Transfer-Encoding: 7bit\n\n" . $htmlContent . "\n\n";  
 
// Preparing attachment 
if(!empty($file) > 0){ 
    if(is_file($file)){ 
        $message .= "--{$mime_boundary}\n"; 
        $fp =    @fopen($file,"rb"); 
        $data =  @fread($fp,filesize($file)); 
 
        @fclose($fp); 
        $data = chunk_split(base64_encode($data)); 
        $message .= "Content-Type: application/octet-stream; name=\"".basename($file)."\"\n" .  
        "Content-Description: ".basename($file)."\n" . 
        "Content-Disposition: attachment;\n" . " filename=\"".basename($file)."\"; size=".filesize($file).";\n" .  
        "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n"; 
    } 
}

// preparing attachments
for($x=0;$x<count($files);$x++){
    $file = fopen($files[$x],"rb");
    $data = fread($file,filesize($files[$x]));
    fclose($file);
    $data = chunk_split(base64_encode($data));
    $message .= "Content-Type: {\"application/octet-stream\"};\n" . " name=\"$files[$x]\"\n" . 
    "Content-Disposition: attachment;\n" . " filename=\"$files[$x]\"\n" . 
    "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
    $message .= "--{$mime_boundary}\n";
}


$message .= "--{$mime_boundary}--"; 
$returnpath = "-f" . $from; 
 
// Send email 
$mail = @mail($email, $subject, $message, $headers, $returnpath);  
 


//mail($email,$subject,$emailContent,$headers);
?>