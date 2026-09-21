<?php 

namespace Core;

class Model {
		
	public function getValue($field)
	{
		return $this->values[$field];
	}
	public function setValue($fieldname, $value)
	{
		if (in_array($fieldname, $this->fields))
		{
			$this->values[$fieldname] = $value;
		}
	}
	public function getValues()
	{
		return $this->values;
	}
	public function setValues($data)
	{
		foreach($data as $key => $value)
		{
			$this->setValue($key,$value);
		}
	}

}

 ?>
