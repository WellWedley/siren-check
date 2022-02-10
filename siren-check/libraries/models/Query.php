<?php

class Query
{
    protected $sirenInput;
    protected bool $isAccountValid = false;
    protected $validQueries = ["96.02A", "96.02B", "96.02AA"];
    protected $nom;
    protected $prenom;




    /**
     * @param int $sirenInput
     * @throws Exception
     */
    public function setSirenInput( int $sirenInput): void
    {
        if (!isset($sirenInput)) {
            echo "<div class='display-errors'>   Veuillez entrer un n° de Siren à vérifier. </div>";

        } elseif( $sirenInput >= 111111111 && $sirenInput <= 999999999) {
            $sirenInput = $_POST['sirenInput'];
            $this->sirenInput = $sirenInput;
        }
        else {
            throw new Exception("Un numéro de sirene est composé de 9 chiffres !");
        }
    }

    public function __construct(int $sirenInput)
    {
        $this->sirenInput = $sirenInput;

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
        $apiVariables = ["ownerFirstN"=> $data["unite_legale"]['prenom_usuel'],
            "ownerLastN"=> $data["unite_legale"]['nom'],
            "ownerId"=> $data["unite_legale"]['id'],
            "denomination" => $data["unite_legale"]["denomination"],
            "activite_principale" => $data["unite_legale"]['activite_principale'],
            "numero_voie" => $data["unite_legale"]["etablissement_siege"]["numero_voie"],
            "type_voie" => $data["unite_legale"]["etablissement_siege"]["type_voie"],
            "libelle_voie" => $data["unite_legale"]["etablissement_siege"]["libelle_voie"],
            "code_postal" => $data["unite_legale"]["etablissement_siege"]["code_postal"],
            "libelle_commune" => $data["unite_legale"]["etablissement_siege"]["libelle_commune"],
            "date_debut" => $data["unite_legale"]["etablissement_siege"]["date_debut"],
            "etat_administratif" => $data["unite_legale"]["etablissement_siege"]["etat_administratif"]];


        foreach ($apiVariables as $key=>$value )
        {
            if ($request == $key && !is_null($apiVariables[$request])){
                $result =  strtolower($apiVariables[$request]) ;
                  return  ucfirst($result) ;

            }

        }
         //Function that tests if the information is provided or not.
        if (is_null($apiVariables[$request])) {
                echo "  / " ;
            }

    }

    // Function that checks if the input matches with the database api values, based on siret number
    public function validateEntry($isAccountValid, $validQueries)
    {

    }

}