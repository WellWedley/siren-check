<?php

require_once('libraries/models/Query.php') ;

if (isset($_POST['sirenInput'])){

    try {
        $sirenInput = $_POST["sirenInput"];
        $newRequest = new Query($sirenInput);
        $newRequest->setSirenInput($sirenInput);
    }
    catch (Exception $e) {
        echo 'Exception reçue : ', $e->getMessage() , '\n';
    }
}

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
            <input type="number"class="query-form-input"  name="sirenInput" placeholder="N° Siren (9 chiffres ) ">
            <button class="search-button" type="submit"><i class="fa fa-search"></i>&nbsp;Chercher</button>
        </form>
    </div>

    <div class="app-answers">

<!--            Détails de la personne physique-->
        <div class="owner-details">
            <div class="owner-details-title">
                <img src="https://img.icons8.com/color/48/000000/manager.png"/>
            </div>

            <div class="name-container">
                <div class="lastName-label">
                    <p>Nom : </p>
                </div>
                <div class="owner-lastName">
                    <p><?php  echo $newRequest->displayApiVal( $newRequest->search($sirenInput),"ownerLastN") ?></p>
                </div>

                <div class="firstName-label">
                   <p> Prénom : </p>
                </div>
                <div class="owner-name">
                   <p> <?php echo $newRequest->displayApiVal( $newRequest->search($sirenInput),"ownerFirstN") ?></p>
                </div>
            </div>

        </div>

<!--        // Détails sur l'établissement-->
        <div class="business-details">
            <div>
                <img src="https://img.icons8.com/external-flat-icons-maxicons/45/000000/external-agent-insurance-flat-flat-icons-maxicons-2.png"/>
            </div>

            <div class="business-container">

                <div class="denomination">
                    <p> Dénomination : &nbsp<?php  echo $newRequest->displayApiVal( $newRequest->search($sirenInput),"denomination")  ?></p>
                </div>

                <div class="activite-principale">
                        <p> Activité principale : &nbsp<?php  echo $newRequest->displayApiVal( $newRequest->search($sirenInput),"activite_principale")  ?></p>
                </div>

                <div class="adresse">
                    <p> Adresse : &nbsp<?php  echo $newRequest->displayApiVal( $newRequest->search($sirenInput),"numero_voie")."&nbsp".
                                                   $newRequest->displayApiVal($newRequest->search($sirenInput), "type_voie")."&nbsp".
                                                   $newRequest->displayApiVal($newRequest->search($sirenInput),"libelle_voie")."&nbsp,&nbsp".
                                                   $newRequest->displayApiVal($newRequest->search($sirenInput),"code_postal")."&nbsp".
                                                   $newRequest->displayApiVal($newRequest->search($sirenInput),"libelle_commune") ?></p>
                </div>
            </div>

        </div>
    </div>


</div>

</body>
</html>
