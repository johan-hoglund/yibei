<?php
	class imagecrop_upload extends standard_page
	{
		protected $content;

		public static function get_url_pattern()
		{
			return array('#^/imagecrop/upload$#' => 15);
		}
		
		public function execute($uri)
		{
			if(is_uploaded_file($_FILES['image']['tmp_name']))
			{
				$handle = parsing_tools::handle('upload_' . rand(0, 99999999));

				move_uploaded_file($_FILES['image']['tmp_name'], imagecrop::storage_path() . $handle);
				$this->content .= 'Uploaded!';
			}
			$this->content = '<script>window.close();</script>';
		}
	}
	
