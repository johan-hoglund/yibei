<?php
	class cache extends setget
	{
		protected $data, $modified_at, $created_at, $handle;

		public function __construct($handle)
		{
			$this->handle = $handle;
			$serialized = file_get_contents(PATH_CACHE . $this->handle . '.phpserialized');

			if($unserialized = unserialize($serialized))
			{
				$this->data        = $unserialized['data'];
				$this->modified_at = $unserialized['modified_at'];
				$this->created_at  = $unserialized['created_at'];
			}
			else
			{
				$this->created_at = time();
			}
		}

		public function quick_save($data)
		{
			$this->data = $data;
			$this->save();
		}

		public function save()
		{
			$unserialized['data'] = $this->data; 
			$unserialized['modified_at'] = time();
			$unserialized['created_at'] = $this->created_at;

			$serialized = serialize($unserialized);
			file_put_contents(PATH_CACHE . $this->handle . '.phpserialized', $serialized);
		}
	}
