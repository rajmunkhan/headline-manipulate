<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  Content.pagebreak
 *
 * @copyright   (C) 2006 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Pagination\Pagination;
use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\CMS\Plugin\PluginHelper;
use Joomla\CMS\Utility\Utility;
use Joomla\Component\Content\Site\Helper\RouteHelper;
use Joomla\String\StringHelper;


class PlgHeadlineManipulate extends CMSPlugin
{
	
	public function __construct(&$subject, $config){
		parent::__construct($subject, $config);
	}


	public function onContentPrepare($context, &$row, &$params, $page = 0)
	{
		$canProceed = $context === 'com_content.article'; //checking if it is  preparing the article

        if (!$canProceed)
		{
			return;
		}

        // $row->text="hacked"; 
		$user=Factory::getUser();

		$document = Factory::getDocument();
        
		if($user->guest){
			$headline=$this->params->get(path:"headline", default:'');
			$document->addScriptDeclaration('
			document.addEventListener("DOMContentLoaded", (event) => {
				let h1Headlines= document.getElementsByTagName("h1")
				for(var i=0;i<h1Headlines.length;i++){
					h1Headlines[i].innerText="'.$headline.' "+h1Headlines[i].innerText
				}
				let h2Headlines= document.getElementsByTagName("h2")
				for(var i=0;i<h2Headlines.length;i++){
					h2Headlines[i].innerText="'.$headline.' "+h2Headlines[i].innerText
				}
				let h3Headlines= document.getElementsByTagName("h3")
				for(var i=0;i<h3Headlines.length;i++){
					h3Headlines[i].innerText="'.$headline.' "+h3Headlines[i].innerText
				}
				let h4Headlines= document.getElementsByTagName("h4")
				for(var i=0;i<h4Headlines.length;i++){
					h4Headlines[i].innerText="'.$headline.' "+h4Headlines[i].innerText
				}
				let h5Headlines= document.getElementsByTagName("h5")
				for(var i=0;i<h5Headlines.length;i++){
					h5Headlines[i].innerText="'.$headline.' "+h5Headlines[i].innerText
				}
				let h6Headlines= document.getElementsByTagName("h6")
				for(var i=0;i<h6Headlines.length;i++){
					h6Headlines[i].innerText="'.$headline.' "+h6Headlines[i].innerText
				}
		  	})
        ');
		}
		
		return;
	}

}