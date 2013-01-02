<?php
	class PreparationStep extends fetcher
	{
		public static $fields = array('text');
		protected static $db_name = 'PreparationSteps';
	
		public function db_decode_text($str)
		{
			$this->text = new Str($str);
		}
		
		public function db_encode_text()
		{
			if($this->text instanceof Str)
			{
				return $this->text->mysql_safe();
			}
			return null;
		}
	}
