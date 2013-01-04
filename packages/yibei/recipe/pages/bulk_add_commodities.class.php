<?php

	class commodity_bulk_add extends yibei_page
	{
		public static function  get_url_pattern()
		{
			return array('#^/commodities/bulk-add$#' => 10);
		}
		
		public function execute($uri)
		{
			if(isset($_POST))
			{
				for($i = 0; (isset($_POST['plural'][$i]) || isset($_POST['singular'][$i])); $i++)
				{
					$singular = trim(strtolower($_POST['singular'][$i]));
					$plural = trim(strtolower($_POST['plural'][$i]));

					if(strlen($plural) == 0 && strlen($singular) == 0)
					{
						continue;
					}
					if(strlen($plural) > 0 && Commodity::get_by_name($plural))
					{
						continue;
					}
					if(strlen($singular) > 0 && Commodity::get_by_name($singular))
					{
						continue;
					}

					debug::log('Found commodity: ' . $singular . ' ' . $plural);
					
					$c = new Commodity();
					$c->set('plural', $plural);
					$c->set('singular', $singular);
					$c->save();
					
					if($_POST['store_group'][$i] > 0)
					{
						$csge = new CommodityStoreGroupMember();
						$csge->set('group_id', $_POST['store_group'][$i]);
						$csge->set('commodity_id', $c->get('id'));
						$csge->save();
					}
				}
			}

			$tpl = array();
			$tpl['group_dropdown'] = new html_dropdown('store_group[]');
			$tpl['group_dropdown']->add('', '');
			foreach(CommodityStoreGroup::fetch() AS $group)
			{
				$tpl['group_dropdown']->add($group->get('id'), $group->get('title'));
			}

			$this->main_content = template('commodity_bulk_add_form', $tpl);
		}
	}

