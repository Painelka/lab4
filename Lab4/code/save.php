<?php

function redirectToHome(): void
{
    header( header:'Location: /');
    exit();
}

if (false === isset($_POST['email'], $_POST['category'], $_POST['title'], $_POST['description'])){
    redirectToHome();
}

$category =$_POST['category'];
$title =$_POST['title'];
$description =$_POST['description'];


require  'C:\Users\Софья\Desktop\lab4\Lab4\code\vendor\autoload.php';
$client = new \Google_Client();
$client->setApplicationName('Google sheets and php');
$client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
$client->setAccessType('ofline');
try
{
    $client->setAuthConfig('C:\Users\Софья\Desktop\lab4\Lab4\code\credentials.json');
}
catch (\Google\Exception $e)
{
    echo "Ошибка\n";
}
$service = new Google_Service_Sheets($client);
$spreadsheetId = "1SIro9lyvc5gQJIdyUHrJaE0KTCeMxENqUiNNsQgq0QQ";

$range = "List1";
$values =[[$category, $name, $email, $desc],];
$body = new Google_Service_Sheets_ValueRange(['values' => $values]);
$row = sizeof(($service->spreadsheets_values->get($sheetID, $range))->getValues()) + 1;
$params = ['valueInputOption'=>'RAW'];


redirectToHome();



