<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Layout</title>
    <style>
        body {
            margin: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh; 
        }
        .header {
            width: 100%;
            height: 80px;
            background-color: #ff0505;
        }
        .content {
            width: 60%;
            margin: 0 auto; 
            flex: 1; 
        }
        .footer {
            width: 100%;
            height: 80px;
            background-color: #407cff;
        }
    </style>
</head>
<body>
    <div>
        <?php require_once '../app/views/partial/header.php' ?>
    </div>
    <div class="content">
        <?php require_once '../app/views/' . $viewname . '.php' ?>
    </div>
    <div>
        <?php require_once '../app/views/partial/footer.php' ?>
    </div>
