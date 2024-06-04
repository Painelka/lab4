<?php
require_once __DIR__ . '/pain.php';
function redirectToHome(): void
{
    header( header:'Location: /');
    exit();
}
if (false === isset($_POST['email'], $_POST['category'], $_POST['title'], $_POST['description'])){
    redirectToHome();
}
$email =$_POST['email'];
$title =$_POST['title'];
$description =$_POST['description'];
$category =$_POST['category'];
$db = extracted();
$command = $db->query("INSERT INTO web.ad (email, title, description, category) VALUES ( '{$email}', '{$title}', '{$description}', '{$category}' )");
redirectToHome();
