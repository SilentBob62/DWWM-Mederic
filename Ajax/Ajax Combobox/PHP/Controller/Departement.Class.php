<?php

class Departement{
	private $_idDepartement;
	private $_libelleDepartement;
	private $_idRegion;
	
	


	/**
	 * Get the value of _idDepartement
	 */ 
	public function getIdDepartement()
	{
		return $this->_idDepartement;
	}

	/**
	 * Set the value of _idDepartement
	 *
	 * @return  self
	 */ 
	public function setIdDepartement($_idDepartement)
	{
		$this->_idDepartement = $_idDepartement;

		return $this;
	}

	/**
	 * Get the value of _libelleDepartement
	 */ 
	public function getLibelleDepartement()
	{
		return $this->_libelleDepartement;
	}

	/**
	 * Set the value of _libelleDepartement
	 *
	 * @return  self
	 */ 
	public function setLibelleDepartement($_libelleDepartement)
	{
		$this->_libelleDepartement = $_libelleDepartement;

		return $this;
	}

	/**
	 * Get the value of _idRegion
	 */ 
	public function getIdRegion()
	{
		return $this->_idRegion;
	}

	/**
	 * Set the value of _idRegion
	 *
	 * @return  self
	 */ 
	public function setIdRegion($_idRegion)
	{
		$this->_idRegion = $_idRegion;

		return $this;
	}
	// Constructeur
	public function __construct(array $options = [])
	{ 
		if (!empty($options))
		{
			$this->hydrate($options);
		}
	}
	public function hydrate($data)
	{
		foreach ($data as $key => $value)
		{
			$method = 'set'.ucfirst($key);
			
			if (is_callable([$this, $method]))
			{
				$this->$method($value);
			}
		}
	}

}