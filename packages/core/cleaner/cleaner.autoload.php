<?php

	class cleaner
	{
		private $clean = array();
		private $rules = array();
		private $input;

		public function __construct($input = array())
		{
			$this->input($input);
		}
		
		public function input($data)
		{
			$this->input = $data;
		}
		
		public function get_all()
		{
			foreach(array_merge(array_keys($this->rules), array_keys($this->input)) as $prop)
			{
				$this->get($prop);
			}

			return $this->clean;
		}

		public function get($val)
		{
			if(isset($this->clean[$val]))
			{
				return $this->clean[$val];
			}

/*
			if(!isset($this->rules[$val]))
			{
				throw new Exception('Trying to access property ' . $val . ' without corresponding rule set.');
			}
*/
			if(!isset($this->input[$val]))
			{
				if(isset($this->rules[$val]['required']) && $this->rules[$val]['required'])
				{
					throw new Exception('Required property "' . $val . '" not set!');
				}
				elseif(isset($this->rules[$val]['default']))
				{
					$this->clean[$val] = $this->rules[$val]['default'];
					return $this->clean[$val];
				}
				else
				{
					return false;
				}
			}
			
			// If not set, add mysql_escape as a rule with default to true
			$this->rules[$val]['mysql_escape'] = (isset($this->rules[$val]['mysql_escape'])) ? $this->rules[$val]['mysql_escape'] : true;
	
			if(isset($this->rules[$val]['array']) && $this->rules[$val]['array'])
			{
				$arr = (is_array($this->input[$val])) ? $this->input[$val] : array($this->input[$val]);
				foreach(array_keys($arr) AS $key) // All data points
				{
					foreach($this->rules[$val] AS $rule_name => $rule_value) // All rules
					{
						$arr[$key] = $this->validate($arr[$key], $rule_name, $rule_value);
					}
				}
				$this->clean[$val] = $arr;
				return $this->clean[$val];
			}
			else
			{
				$clean = $this->input[$val];
				foreach($this->rules[$val] AS $rule_name => $rule_value)
				{
					$clean = $this->validate($clean, $rule_name, $rule_value);
				}
				$this->clean[$val] = $clean;
				return $this->clean[$val];
			}
		}
		
		private function validate($data, $rule_name, $rule_value = null)
		{
			switch($rule_name)
			{
				case 'required' : // No action for these, leave untouched
				case 'array' :
				case 'default' :
					return $data;
					break;
				case 'numeric':
					if(is_numeric($data))
					{
						return $data;
					}
					throw new Exception('Value "' . $data . '" is not numeric');
					break;
				case 'min':
					if($data >= $rule_value)
					{
						return $data;
					}
					throw new Exception('Value "' . $data . '" is lower than required minimum of ' . $rule_value);
					break;
				case 'max':
					if($data <= $rule_value)
					{
						return $data;
					}
					throw new Exception('Value "' . $data . '" is higher than required maximum of ' . $rule_value);
					break;
				case 'allowed':
					if(in_array($data, $rule_value))
					{
						return $data;
					}
					throw new Exception('Supplied value "' . $data . '" is not in list of allowed values!');
					break;
				case 'mysql_escape' :
					return mysql_escape_string($data);
					break;
				case 'email' :
					if (cleaner::validEmail($data))
					{
						return $data;
					}
					throw new Exception('Value "' . $data . '" is not a valid e-mail address');
					break;
				default :
					throw new Exception('Unsupported rule found when cleaning data: ' . $rule_name);				
					break;
			}
		}
		
		public function rule($prop, $rule, $data = null)
		{
			$this->rules[$prop][$rule] = $data;
			unset($this->clean[$prop]);
		}
		
		/**
		Validate an email address.
		Provide email address (raw input)
		Returns true if the email address has the email 
		address format and the domain exists.
		*/
		private static function validEmail($email)
		{
		   $isValid = true;
		   $atIndex = strrpos($email, "@");
		   if (is_bool($atIndex) && !$atIndex)
		   {
		      $isValid = false;
		   }
		   else
		   {
		      $domain = substr($email, $atIndex+1);
		      $local = substr($email, 0, $atIndex);
		      $localLen = strlen($local);
		      $domainLen = strlen($domain);
		      if ($localLen < 1 || $localLen > 64)
		      {
		         // local part length exceeded
		         $isValid = false;
		      }
		      else if ($domainLen < 1 || $domainLen > 255)
		      {
		         // domain part length exceeded
		         $isValid = false;
		      }
		      else if ($local[0] == '.' || $local[$localLen-1] == '.')
		      {
		         // local part starts or ends with '.'
		         $isValid = false;
		      }
		      else if (preg_match('/\\.\\./', $local))
		      {
		         // local part has two consecutive dots
		         $isValid = false;
		      }
		      else if (!preg_match('/^[A-Za-z0-9\\-\\.]+$/', $domain))
		      {
		         // character not valid in domain part
		         $isValid = false;
		      }
		      else if (preg_match('/\\.\\./', $domain))
		      {
		         // domain part has two consecutive dots
		         $isValid = false;
		      }
		      else if (!preg_match('/^(\\\\.|[A-Za-z0-9!#%&`_=\\/$\'*+?^{}|~.-])+$/', str_replace("\\\\","",$local)))
		      {
		         // character not valid in local part unless 
		         // local part is quoted
		         if (!preg_match('/^"(\\\\"|[^"])+"$/', str_replace("\\\\","",$local)))
		         {
		            $isValid = false;
		         }
		      }
		      if ($isValid && !(checkdnsrr($domain,"MX") || checkdnsrr($domain,"A")))
		      {
		         // domain not found in DNS
		         $isValid = false;
		      }
		   }
		   return $isValid;
		}
	}

?>
