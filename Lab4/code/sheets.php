<?php

require  'C:\Users\Софья\Desktop\lab4\Lab4\code\vendor\autoload.php';

$client = new \Google_Client();
$client->setApplicationName('Google sheets and php');
$client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
$client->setAccessType('ofline');
$client->setAuthConfig('C:\Users\Софья\Desktop\lab4\Lab4\code\credentials.json');
$service = new Google_Service_Sheets($client);
$spreadsheetId = "1SIro9lyvc5gQJIdyUHrJaE0KTCeMxENqUiNNsQgq0QQ";

$range = "List1!A2:C3";
$response = $service->spreadsheets_values->get($spreadsheetId, $range);
$values = $response->getValues();
if(empty($values)){
    print "No data found.\n";
}
else{
    $mask="%10s %-10s %s\n";
    foreach($values as $row){
        echo sprintf($mask, $row[2], $row[1], $row[0]);
    }

}
