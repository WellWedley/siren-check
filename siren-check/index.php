<?php

require_once('libraries/models/Query.php') ;
   $sirenInput = $_POST["sirenInput"];
        $newRequest = new Query($sirenInput);
        $newRequest->setSirenInput($sirenInput);
?>


<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Siren-checker</title>
    <link rel="stylesheet" href="/styles/index.css" class="rel">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>


<div class="app-container">
    <div class="app-title">
        <h1 class="main-title">Sirene checker</h1>
    </div>

    <div class="query-form">
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
            <input type="number" style="width: 12vw; height: 2vw; font-size: 1.2vw" name="sirenInput" placeholder="N° Siren (9 chiffres ) ">
            <button type="submit"><i class="fa fa-search"></i></button>
        </form>
    </div>

    <div class="app-answers">

        <?php

        ?>
        <div class="owner-details">
            <div class="owner-details-title">
                <h2>Informations sur le propriétaire</h2>
            </div>

            <div class="name-container">
                <div class="name-label">
                    Nom
                </div>
                <div class="owner-name">
                    <?php  $newRequest->displayApiVal( $newRequest->search($sirenInput),"ownerFirstN") ?>
                    <?php  $newRequest->displayApiVal( $newRequest->search($sirenInput),"ownerLastN") ?>
                    <?php  $newRequest->displayApiVal( $newRequest->search($sirenInput),"mainActivity") ?>
                </div>
            </div>

        </div>

    </div>


</div>

</body>
</html>
