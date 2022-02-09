<?php

class Query {
    protected int $sirenInput ;
    protected bool $isAccountValid = false;
    protected $validQueries = ["96.02A", "96.02B", "96.02AA"];
    protected $nom ;
    protected $prenom ;


    public function __construct(int $sirenInput){
        $this->sirenInput = $sirenInput ;

    }

    /**
     * @param int $sirenInput
     */
    public function setSirenInput(int $sirenInput): void
    {
        if(is_int($sirenInput) && $sirenInput >= 111111111 && $sirenInput <= 999999999){

            $this->sirenInput = $sirenInput ;
        }
        else{
            throw new Exception("Un numéro de sirene est composé de 9 chiffres !");
        }
    }

    /**
     * @return int
     */
    public function getSirenInput(): int
    {
      return $this->sirenInput ;
    }

    /**
     * @return string
     */
    public function getApiUrl(): string
    {
        return $this->apiUrl;
    }



    /**
     * @return mixed
     */
    public function getNom()

    {
        return $this->nom;
    }



    public function search( $sirenInput){

        $apiUrl = "https://entreprise.data.gouv.fr/api/sirene/v3/unites_legales/" ;
        $url = $apiUrl.$sirenInput ;
         $json = file_get_contents( $url) ;
         $data = json_decode($json, true) ;

        // Variables de l'API
         $main_activity = $data["unite_legale"]['activite_principale'] ;
         $firstName = $data["unite_legale"]['prenom_usuel'];


         return array( $data["unite_legale"]['activite_principale'],$data["unite_legale"]['prenom_usuel']);

    }

    public function validateEntry($isAccountValid,$validQueries){

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
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>"  method="POST">
                <input type="tel" name="sirenInput" placeholder="N° Siren (9 chiffres ) ">
                <button type="submit"><i class="fa fa-search"></i></button>
            </form>
        </div>

        <?php

        if(isset($_POST['sirenInput'])){
            $sirenInput = $_POST['sirenInput'];
            $myQuery = new Query($sirenInput);
            $myQuery->setSirenInput($sirenInput);
        }
        else {
            echo "N° Siren invalide ! " ;
        }
        ?>

        <div class="app-answers">
          <div class="owner-details">
              <div class="owner-details-title">
                  <h2>Informations sur le propriétaire</h2>
              </div>

              <div class="name-container">
                 <div class="name-label">
                    Nom
                 </div>
                <div class="owner-name">
                  <?php echo  $myQuery->search($sirenInput) ?>
                </div>
              </div>

         </div>

        </div>






    </div>

</body>
</html>
