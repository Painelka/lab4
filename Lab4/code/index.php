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
        $client->setAuthConfig('C:\Users\Софья\Desktop\lab4\Lab4\code\credentials.json');
    }
    catch (\Google\Exception $e)
    {
        echo "Ошибка\n";
    }

    $service = new Google_Service_Sheets($client);
    $spreadsheetId = "1SIro9lyvc5gQJIdyUHrJaE0KTCeMxENqUiNNsQgq0QQ";
    ?>

</div>

<div id ="table">
    <table border="1" width="400">
        <thead >
        <?php
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
        ?>
        </thead>
        <tbody>
        <?php
        $range2 = "Pets!A2:D999";
        $result2 = null;
        try
        {
            $result2 = ($service->spreadsheets_values->get($sheetID, $range2))->getValues();
        }
        catch (\Google\Service\Exception $e)
        {
            echo "Ошибка при получении данных в таблицу\n";
        }
        if (null != $result2)
        {
            foreach ($result2 as $row)
            {
                echo "<tr>";
                foreach ($row as $item)
                {
                    echo "<td>", $item, "</td>";
                }
                echo "</tr>";
            }
        }
        ?>

        </tbody>
    </table>
</div>


</body>
</html>
