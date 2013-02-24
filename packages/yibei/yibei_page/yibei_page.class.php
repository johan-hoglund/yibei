<?php
	abstract class yibei_page extends standard_page
	{
		public function output($uri)
		{
			$this->executed = true;
			$this->execute($uri);
			$tpl = array();
			$tpl['main_content'] = $this->main_content;
			$tpl['main_classes'] = array();
			foreach($this->main_classes AS $class)
			{
				$tpl['main_classes'][] = $class;
			}
			$this->body = template('layout', $tpl);
			parent::output();
		}
	}
