<?php
namespace AHT\Poll\Block\Adminhtml\Poll\Edit;
use Magento\Backend\Block\Widget\Tabs as WidgetTabs;
class Tabs extends WidgetTabs{
	public function _construct(){
		parent::_construct();
		$this->setId("poll_edit_tabs");
		$this->setDestElementId("edit_form");
		$this->setTitle(__("Poll Manager"));
	}
	protected function _beforeToHtml(){
		$this->addTab(
				"poll_main",
				[
					"label" => __("Poll Information"),
					"title" => __("Poll Information"),
					"content" => $this->getLayout()->createBlock(
							"AHT\Poll\Block\Adminhtml\Poll\Edit\Tab\Question"
						)->toHtml(),
					"active" => true
				]
			);		

		$this->addTab(
				"poll_answer",
				[
					"label" => __("Poll Answers"),
					"title" => __("Poll Answers"),
					"content" => $this->getLayout()->createBlock(
							"AHT\Poll\Block\Adminhtml\Poll\Edit\Tab\Answer"
						)->toHtml(),
					"active" => false
				]
			);		
		return parent::_beforeToHtml();
	}
}