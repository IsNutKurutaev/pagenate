<?php
    /* @var PDO $db */
    $db = new PDO('mysql:host=localhost;dbname=posts', 'root');

    $limit_on_page = 3;
    $get_page = isset($_GET['page']) ? $_GET['page'] * $limit_on_page : 0;

    $take_all_from_db = $db->query("SELECT * FROM post LIMIT {$get_page}, {$limit_on_page}")->fetchAll(PDO::FETCH_ASSOC);

    $take_count_query = $db->query('SELECT COUNT(body) FROM post')->fetch(PDO::FETCH_ASSOC);
    $take_count_of_page = round(intdiv($take_count_query["COUNT(body)"]*10, $limit_on_page)/10, 0);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <?php foreach($take_all_from_db as $item) : ?>
        <div><?=$item['id']?> <?=$item['body']?></div>
    <?php endforeach; ?>

    <?php for($count = 0; $count <= $take_count_of_page-1; $count++) : ?>
        <a href="?page=<?=$count?>"><?=$count+1?></a>
    <?php endfor; ?>
</body>
</html>
