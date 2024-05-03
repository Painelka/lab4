<!doctype html>
<html lang ="en">

<style type="text/css">
    thead {
        background: #e1e1e1;
    }
</style>


<head>
    <meta charset = "UTF-8">
    <meta name="viewport"
          content = "width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale =1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<div id="form">
    <form action ="save.php" method="post">
        <label for="email">Email</label>
        <input type ="email" name="email" required>
        <label for ="category">Category </label>
        <?php
        $categories = scandir('categories');
        echo '<select name="category" required>';
        foreach ($categories as $category) {
            if ((is_dir("categories/$category")) && ($category != '.') && ($category != '..')) {
                echo "<option value='$category'>$category</option>";
            }
        }
        echo '</select>';
        ?>

        <br><label for="title">Title</label>
        <input type ="text" name="title" required> <br>

        <label for="description">Description</label>
        <br> <textarea rows ="2" name="description">  </textarea><br>

        <input type ="submit" value = "save">
    </form>
    <?php
    require  'C:\Users\Софья\Desktop\lab4\Lab4\code\vendor\autoload.php';
    $client = new \Google_Client();
    $client->setApplicationName('Google sheets and php');
    $client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
    $client->setAccessType('ofline');
    try
    {
        $client->setAuthConfig(__DIR__ . '/web-lab4-422209-76913d7c4a42.json');
    }
    catch (\Google\Exception $e)
    {
        echo "Ошибка\n";
    }
    $client->setAuthConfig('C:\Users\Софья\Desktop\lab4\Lab4\code\credentials.json');
    $service = new Google_Service_Sheets($client);
    $spreadsheetId = "1SIro9lyvc5gQJIdyUHrJaE0KTCeMxENqUiNNsQgq0QQ";
    ?>
    
</div>

<div id ="table">
    <table border="1" width="400">
        <thead >
        $range1 = "List1!A1:C1";
        $result1 = null;
        try {
            $result1 = ($service->spreadsheets_values->get($sheetID, $range1))->getValues();
        }
        catch (\Google\Service\Exception $e) {
            echo "Ошибка при получении заголовков в таблицу\n";
        }
        if (null != $result1) {
            foreach ($result1 as $row) {
                foreach ($row as $item)
                    echo "<th>$item</th>";
                }
            }
        </thead>
        <tbody>
        <?php
        $cat = opendir('categories');
        while ($file = readdir($cat))
        {
            if ((is_dir('categories/'.$file)) && ($file != '.') && ($file != '..'))
            {
                $dog = opendir('categories/'.$file);
                while ($add = readdir($dog))
                {
                    if ($add != '.' && $add != '..')
                    {
                        $fop = fopen('categories/'.$file.'/'.$add, 'r');
                        $kov = "";
                        while ($line = fgets($fop))
                        {
                            $kov .= $line;
                        }
                        fclose($fop);
                        echo '<tr>'; // Вывод
                        echo "<td>$file</td>";
                        echo "<td>".substr($add, 0, strlen($add) - 4)."</td>";
                        echo "<td>$kov</td>";
                        echo '</tr>';
                    }
                }
            }
        }
        ?>

        </tbody>
    </table>
</div>


</body>
</html>
