<?php
	class Str
	{
		private $string;
		public function __construct($str)
		{
			$this->string = $str;
		}

		public function __toString()
		{
			return $this->string;
		}

		public function html_safe()
		{
			return htmlspecialchars($this->string);
		}

		public function mysql_safe()
		{
			return mysql_escape_string($this->string);
		}
	}
