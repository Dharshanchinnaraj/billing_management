<?php
/*
 * Author        :   Naveen
 * Date          :   10-06-2019
 * Modified      :   
 * Modified By   :   
 * Description   :   add category controller page
 */

if (isset($_POST['from_address'])) {
    $from_address = $_POST['from_address'];
    $name_client=$_POST['name_client'];
    $invoice_date=$_POST['invoice_date'];
    $current_date=date("d-m-Y");
    $to_address = $_POST['to_address'];
    $subject_to = $_POST['subject_to'];
    $total_subject = $_POST['total_subject'];
    $pdf_url=$_POST['pdf_url'];
    

if(!empty($pdf_url)) {
 $pdf_url = $_POST['pdf_url'];
}else{
    $pdf_url="0";
}
    function sendIcalEventEmployee($from_name_emp, $from_address_emp, $to_name_emp, $to_address_emp, $startTime_emp, $endTime_emp, $subject_emp, $description_emp,$get_pdf_file)
{   
    $domain_emp = 'virranproducts.com';

    //Create Email Headers
    $mime_boundary_emp = "----Meeting Booking----".MD5(TIME());

    $headers_emp = "From: ".$from_name_emp." <".$from_address_emp.">\n";
    $headers_emp .= "Reply-To: ".$from_name_emp." <".$from_address_emp.">\n";
    $headers_emp .= "MIME-Version: 1.0\n";
    $headers_emp .= "Content-Type: multipart/alternative; boundary=\"$mime_boundary_emp\"\n";
    $headers_emp .= "Content-class: urn:content-classes:calendarmessage\n";
    
    //Create Email Body (HTML)
    $message_emp = "--$mime_boundary_emp\r\n";
    $message_emp .= "Content-Type: text/html; charset=UTF-8\n";
    $message_emp .= "Content-Transfer-Encoding: 8bit\n\n";
    $message_emp .= "<html>\n";
    $message_emp .= "<body>\n";
    $message_emp .= '<p>Dear '.$to_name_emp.',</p>';
    $message_emp .= '<p>'.$description_emp.'</p>';
    //pdf
    $message_emp .= $get_pdf_file;
    
    $message_emp .= "</body>\n";
    $message_emp .= "</html>\n";
    $message_emp .= "--$mime_boundary_emp\r\n";

    $ical_emp = 'BEGIN:VCALENDAR' . "\r\n" .
    'PRODID:-//calendarserver.org//Zonal//EN' . "\r\n" .
    'VERSION:2.0' . "\r\n" .
    'METHOD:REQUEST' . "\r\n" .
    
    'CALSCALE:GREGORIAN' . "\r\n" .
    'BEGIN:VTIMEZONE' . "\r\n" .
    'TZID:Asia/Calcutta' . "\r\n" .
    'BEGIN:STANDARD' . "\r\n" .
    'DTSTART:20091101T020000' . "\r\n" .
    'RRULE:FREQ=YEARLY;INTERVAL=1;BYDAY=1SU;BYMONTH=11' . "\r\n" .
    'TZOFFSETFROM:+055328' . "\r\n" .
    'TZOFFSETTO:+055320' . "\r\n" .
    'TZNAME:GMT' . "\r\n" .
    'END:STANDARD' . "\r\n" .
    'BEGIN:DAYLIGHT' . "\r\n" .
    'DTSTART:20090301T020000' . "\r\n" .
    'RRULE:FREQ=YEARLY;INTERVAL=1;BYDAY=2SU;BYMONTH=3' . "\r\n" .
    'TZOFFSETFROM:+055320' . "\r\n" .
    'TZOFFSETTO:+0630' . "\r\n" .
    'TZNAME:BURT' . "\r\n" .
    'END:DAYLIGHT' . "\r\n" .
    'END:VTIMEZONE' . "\r\n" .	
    'BEGIN:VEVENT' . "\r\n" .
    'ORGANIZER;CN="'.$from_name_emp.'":MAILTO:'.$from_address_emp. "\r\n" .
    'ATTENDEE;CN="'.$to_name_emp.'";ROLE=REQ-PARTICIPANT;RSVP=TRUE:MAILTO:'.$to_address_emp. "\r\n" .
    'LAST-MODIFIED:' . date("Ymd\TGis") . "\r\n" .
    'UID:'.date("Ymd\TGis", strtotime($startTime_emp))."@".$domain_emp."\r\n" .
    'DTSTAMP:'.date("Ymd\TGis"). "\r\n" .
    'DTSTART;TZID="Asia/Calcutta":'.date("Ymd\THis", strtotime($startTime_emp)). "\r\n" .
    'DTEND;TZID="Asia/Calcutta":'.date("Ymd\THis", strtotime($endTime_emp)). "\r\n" .
    'TRANSP:OPAQUE'. "\r\n" .
    'SEQUENCE:1'. "\r\n" .
    'SUMMARY:' . $subject_emp . "\r\n" .
//    'LOCATION:' . $location_emp . "\r\n" .
    'CLASS:PUBLIC'. "\r\n" .
    'PRIORITY:5'. "\r\n" .
    'BEGIN:VALARM' . "\r\n" .
    'TRIGGER:-PT15M' . "\r\n" .
    'ACTION:DISPLAY' . "\r\n" .
    'DESCRIPTION:Reminder' . "\r\n" .
    'END:VALARM' . "\r\n" .
    'END:VEVENT'. "\r\n" .
    'END:VCALENDAR'. "\r\n";
    $message_emp .= 'Content-Type: text/calendar;name="meeting.ics";method=REQUEST'."\n";
    $message_emp .= "Content-Transfer-Encoding: 8bit\n\n";
    $message_emp .= $ical_emp;

    $mailsent_emp = mail($to_address_emp, $subject_emp, $message_emp, $headers_emp);

    return ($mailsent_emp)?(true):(false);
}
   

$from_name_emp = "Dharshan";       
$from_address_emp ="darshan.c@virrantech.com";      
$to_name_emp =$name_client;         
$to_address_emp =  $to_address;       
$startTime_emp = $invoice_date;        
$endTime_emp = $current_date;       
$subject_emp = $subject_to;        
$description_emp = $total_subject;        
$get_pdf_file = $pdf_url;
sendIcalEventEmployee($from_name_emp, $from_address_emp, $to_name_emp, $to_address_emp, $startTime_emp, $endTime_emp, $subject_emp, $description_emp,$get_pdf_file);  
        
}
?>