<?php
	class html_dropdown
	{
		private $options = array();
	
		public function __construct($name = '')
		{
			$this->name = $name;
		}

		function set_name($name)
		{
			$this->name = $name;
		}
	
		function set_id($id)
		{
			$this->id = $id;
		}

		public function add($value, $label = null)
		{
			$label = isset($label) ? $label : $value;
			$this->options[] = array('value' => $value, 'label' => $label);
			return $this;
		}
		
		function add_option($option)
		{
			$this->options[] = $option;
		}
		
		function set_selected($value)
		{
			$this->selected = $value;
			return $this;
		}
		
		function render()
		{
			$o = '<select';
			$o .= (isset($this->name)) ? ' name="' . $this->name . '"' : null;
			$o .= (isset($this->id)) ? ' id="' . $this->id . '"' : null;
			$o .= '>';
			$group = null;
			foreach($this->options AS $opt)
			{
				if(isset($opt['group']) && $opt['group'] != $group)
				{
					$group = $opt['group'];
					$o .= '<optgroup label="' . $opt['group'] . '">';
				}
				$o .= '<option';
				$o .= (isset($opt['value'])) ? ' value="' . $opt['value'] . '"' : null;
				$o .= (isset($opt['value']) &&isset($this->selected) && $opt['value'] == $this->selected) ? ' selected="true"' : null;
				$o .= '>' . $opt['label'] . '</option>';

				if(isset($group) && (!isset($opt['group']) || $opt['group'] != $group))
				{
					$o .= '</optgroup>';
					$group = $opt['group'];
				}


			}
			$o .= '</select>';
			
			return $o;
		}
	}

?>
