<?php

require _DIR_.'/vendor/autoload.php';

$client = new \Google_Client();
$client->setApplicationName('Google sheets and php');
$client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
$client->setAccessType('ofline');
$client->setAuthConfig(_DIR_.'/credentials.json');
$service = new Google_Service_Sheets($client);
$spreadsheetId = "";