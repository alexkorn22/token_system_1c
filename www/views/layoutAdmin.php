<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AppTest</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!--    <link rel="stylesheet" type="text/css" href="..\..\public\styles\styles.css">-->

</head>
<body class="container-fullwidth" style="background-color:white">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="\admin">AppTest Admin</a>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="/admin">Tests</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="/admin/question">Questions</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/admin/answer">Answers</a>
            </li>
        </ul>

        <ul class="navbar-nav navbar-right">
            <?php if(!empty($_SESSION['USER'])){ ?>
                <li class="nav-item">
                    <a class="nav-link" href="#"> User : <?=$_SESSION['USER']?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="\admin\main\logout">Log Out</a>
                </li>

            <?php }?>
        </ul>
    </div>
</nav>
<br/>

    <div  class="container">
        <?=$content?>
    </div>
<!-- // add logout in head menu -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

<script src="/javascripts/scripts.js"></script>

</body>
</html>
