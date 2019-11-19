<?php
    $connect = new PDO("mysql:host=phpTest.ru; dbname=myforum; charset=utf8", 'root', '');
if(isset($_POST['username'])){
    $username = $_POST['username'];
    $comment = $_POST['comment'];
    $date = date('Y-m-d H:i:s');
    $query = $connect->query("INSERT INTO myforum.comments(username, comment, date) VALUES('$username', '$comment', '$date')");
} 
    // echo "<pre>";
    // var_dump($_POST);
    // echo "</pre>";
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Чат</title>
</head>
<body>
    <style>
    *{
        box-sizing: border-box;
    }
    body{
        font-family: Arial;
    }
    input, textarea{
        margin: 10px;
        width: 300px;
    }
    form{
        margin: 30px;
        display: flex;
        flex-direction: column;
    }
    </style>
    <form action="" method="POST">
        <input type="text" name="username" placeholder="ваше имя">
        <textarea name="comment" id="" cols="30" rows="10" placeholder="ваш комментарий"></textarea>
        <input type="submit">
    </form>

    <hr>

    <h2>Форум</h2>
    <?
        $comments = $connect->query("SELECT * FROM myforum.comments ORDER BY date DESC");
        $comments = $comments->fetchAll(PDO::FETCH_ASSOC);

        if($comments){

        foreach ($comments as $comment){
    ?>

        <p><?="{$comment['date']} | {$comment['username']} оставил(а) комментарий : {$comment['comment']}"?></p>

    <? }} else { ?>
        <p>Здесь пока нет комментариев :|</p>
    <? } ?>
</body>
</html>