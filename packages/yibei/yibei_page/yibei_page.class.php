<?php
	abstract class yibei_page extends standard_page
	{
		public function output($uri)
		{
			$this->executed = true;
			$this->execute($uri);
			$tpl = array();
			$tpl['main_content'] = $this->main_content;
			$this->body = template('layout', $tpl);
			parent::output();
		}
	}
