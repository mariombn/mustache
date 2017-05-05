<!DOCTYPE html>
<html>
<head>
    <meta charset="ISO-8859-1">
    <title><?php echo APP_NAME ?></title>

    <style>
        body {
            font-family: verdana;
            font-size: 12px;
            text-align: center;
            padding: 0px;
            margin: 0px;
            padding-top: 15px;
            background-color: lightcoral;
        }

        div {
            background-color: black;
            color: white;
            padding: 15px;
            text-align: center;
            font-size: 12px;
            width: 100%;
        }

        a {
            color: white;
        }
    </style>

</head>

<body>
    <img src="<?php echo HOME_PATH ?>img/Logo-Mustache.png" alt="Logo Mustache - Micro Framework" /><br/>
    <br/>
    <h2>It's Work!</h2>
    <h3><?php echo APP_NAME ?></h3>
    <br/>
    <p><?php echo $this->__get("simple") ?></p>
    <div>
        Mustache is a Micro Framework Open Source developed in PHP for you who want the convenience of an MVC framework in PHP without much work.<br/>
        <br/>
        <a href="http://mustache.com.br">http://mustache.com.br</a>
    </div>
</body>

</html>