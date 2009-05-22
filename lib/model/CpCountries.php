<?php

class CpCountries extends BaseCpCountries
{
    	public function __toString()
	{
		return $this->getName();
	}
}
