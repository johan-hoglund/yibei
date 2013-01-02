<?php
	class page_404 extends standard_page
	{
		protected $content;
		public static function get_url_pattern()
		{
			return array('##' => 1);
		}

		public function execute($uri)
		{
			$this->body = template('404');
		}
	}
?>
