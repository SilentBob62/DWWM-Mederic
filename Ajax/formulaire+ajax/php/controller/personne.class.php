<?php
class Personne
{

/*****************Attributs***************** */
    private $_idPersonne;
    private $_nom;
    private $_prenom;
    private $_dateNaissance;
    private $_adresse;
    private $_ville;
    private $_code;
    private $_email;

/*****************Accesseurs***************** */

    public function getIdPersonne()
    {
        return $this->_idPersonne;
    }

    public function setIdPersonne($_idPersonne)
    {
        $this->_idPersonne = $_idPersonne;

        return $this;
    }

    public function getNom()
    {
        return $this->_nom;
    }

    public function setNom($_nom)
    {
        $this->_nom = $_nom;

        return $this;
    }

    public function getPrenom()
    {
        return $this->_prenom;
    }

    public function setPrenom($_prenom)
    {
        $this->_prenom = $_prenom;

        return $this;
    }

    public function getDateNaissance()
    {
        return $this->_dateNaissance;
    }

    public function setDateNaissance($_dateNaissance)
    {
        $this->_dateNaissance = $_dateNaissance;

        return $this;
    }

    public function getAdresse()
    {
        return $this->_adresse;
    }

    public function setAdresse($_adresse)
    {
        $this->_adresse = $_adresse;

        return $this;
    }

    public function getVille()
    {
        return $this->_ville;
    }

    public function setVille($_ville)
    {
        $this->_ville = $_ville;

        return $this;
    }

    public function getCode()
    {
        return $this->_code;
    }

    public function setCode($_code)
    {
        $this->_code = $_code;

        return $this;
    }

    public function getEmail()
    {
        return $this->_email;
    }

    public function setEmail($_email)
    {
        $this->_email = $_email;

        return $this;
    }

/*****************Constructeur***************** */

    public function __construct(array $options = [])
    {
        if (!empty($options)) // empty : renvoi vrai si le tableau est vide
        {
            $this->hydrate($options);
        }
    }
    public function hydrate($data)
    {
        foreach ($data as $key => $value)
        {
            $methode = "set" . ucfirst($key); //ucfirst met la 1ere lettre en majuscule
            if (is_callable(([$this, $methode]))) // is_callable verifie que la methode existe
            {
                $this->$methode($value);
            }
        }
    }

/*****************Autres Méthodes***************** */

}
