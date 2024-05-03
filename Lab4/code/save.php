<?php

function redirectToHome(): void
{
    header( header:'Location: /');
    exit();
}

if (false === isset($_POST['email'], $_POST['category'], $_POST['title'], $_POST['description'])){
    redirectToHome();
}
$email =$_POST['email'];
$category =$_POST['category'];
$title =$_POST['title'];
$description =$_POST['description'];


require  'vendor/autoload.php';
$client = new \Google_Client();
$client->setApplicationName('Google sheets and php');
$client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
$client->setAccessType('ofline');
try
{
    $client->setAuthConfig('credentials.json');
}
catch (\Google\Exception $e)
{
    echo "Ошибка\n";
}
$service = new Google_Service_Sheets($client);
$spreadsheetId = "1SIro9lyvc5gQJIdyUHrJaE0KTCeMxENqUiNNsQgq0QQ";

$range = "List1";
$values =[[$category, $email, $title, $$description],];
$body = new Google_Service_Sheets_ValueRange(['values' => $values]);
$row = sizeof(($service->spreadsheets_values->get($spreadsheetId , $range))->getValues()) + 1;
$params = ['valueInputOption'=>'RAW'];
try
{
    $service->spreadsheets_values->update($spreadsheetId, 'List1!A'.($row), $body, $params);
}
catch (\Google\Service\Exception $e)
{
    echo "Ошибка";
}

redirectToHome();



