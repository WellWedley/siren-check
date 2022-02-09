<?php

class Query
{
    protected $sirenInput;
    protected bool $isAccountValid = false;
    protected $validQueries = ["96.02A", "96.02B", "96.02AA"];
    protected $nom;
    protected $prenom;


    public function __construct(int $sirenInput)
    {
        $this->sirenInput = $sirenInput;

    }

    /**
     * @param int $sirenInput
     */
    public function setSirenInput( int $sirenInput): void
    {
        if (!isset($_POST['sirenInput'])) {
            echo "<div class='display-errors'>   Veuillez entrer un n° de Siren à vérifier. </div>";

        } elseif( $sirenInput >= 111111111 && $sirenInput <= 999999999) {
            $sirenInput = $_POST['sirenInput'];
            $this->sirenInput = $sirenInput;
        }
        else {
            throw new Exception("Un numéro de sirene est composé de 9 chiffres !");
        }
    }

    /**
     * @return int
     */
    public function getSirenInput(): int
    {

        return this->sirenInput ;

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


    public function search($sirenInput)
    {
        $apiUrl = "https://entreprise.data.gouv.fr/api/sirene/v3/unites_legales/";
        $url = $apiUrl . $sirenInput;
        $json = file_get_contents($url);
        $data = json_decode($json, true);
        return $data;

    }

    function displayApiVal($data,$request){
        //Tab with api's values
        $apiVariables = array("ownerFirstN"=>$data["unite_legale"]['prenom_usuel'],
            "ownerLastN"=>$data["unite_legale"]['nom'],
            "ownerId"=>$data["unite_legale"]['id'],
            "mainActivity"=>$data["unite_legale"]['activite_principale']);

        foreach ($apiVariables as $key=>$value )
        {
            if ($key === $request){
                echo $apiVariables[$request] ;
            }
        }
    }

    // Function that checks if the input matches with the database api values, based on siret number
    public function validateEntry($isAccountValid, $validQueries)
    {

    }

}