<?php
require_once __DIR__ . '/pain.php';
$category = ['doll', 'other', 'writer'];
?>
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
</div>

<div id ="table">
    <table border="1" width="400">
        <thead >

        </thead>
        <tbody>
        <?php
        $db = extracted();
        foreach ($db->query("SELECT * FROM web.ad") as $row)
        {
            $category = $row['category'];
            $title = $row['title'];
            $description = $row['description'];
            $email = $row['email'];
            echo "<tr><td>" . $category . " </td>";
            echo "<td>" . $title . " </td>";
            echo "<td>" . $description . " </td></tr>";
            echo "<td>" . $email . " </td></tr>";
        }
        ?>

        </tbody>
    </table>
</div>


</body>
</html>
