<?php

class Region{
	private $_idRegion;
	private $_libelleRegion;
	
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

	/**
	 * Get the value of _libelleRegion
	 */ 
	public function getLibelleRegion()
	{
		return $this->_libelleRegion;
	}

	/**
	 * Set the value of _libelleRegion
	 *
	 * @return  self
	 */ 
	public function setLibelleRegion($_libelleRegion)
	{
		$this->_libelleRegion = $_libelleRegion;

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