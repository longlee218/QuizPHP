<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
</head>
<body>
    <h1>This is homepage</h1>
    <h2>Your name is</h2>
    <?php
    while ($row = mysqli_fetch_assoc($data['user_table'])){
        echo $row['name'];
    }
    ?>
</body>
</html>