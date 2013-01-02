<?php
	class TypeMismatchException extends Exception
	{
		public function __construct($message, $variable)
		{
			$this->message = $message . '<pre>.' . print_r($variable, true) . '.</pre>';
		}
	}
