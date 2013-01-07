<?php
	abstract class standard_page implements page
	{
		protected $body;
		
		abstract protected function execute($uri);
		
		public static function accepts($uri)
		{
			return true;
		}
		
		public function output($uri)
		{
			if(!isset($this->executed) || !$this->executed)
			{
				try
				{
					$this->execute($uri);
				}
				catch(Exception $e)
				{
					print_r($e);
				}
			}
			if(isset($this->redirect))
			{
				header('Location: ' . $this->redirect);
			}
			else
			{
				$template = array();
				$this->body .= $this->content;
				$template['body'] = isset($this->body) ? $this->body : null;
				$template['title'] = isset($this->title) ? $this->title : '';

				hook::execute('page_render', $this);

				$hook = array('template' => &$template);
				hook::execute('standard_layout_template', $hook);
				
				echo template('layout', $template);
			}
		}
	}
?>
