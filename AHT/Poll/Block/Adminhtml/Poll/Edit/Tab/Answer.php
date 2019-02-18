<?php
namespace AHT\Poll\Block\Adminhtml\Poll\Edit\Tab;
use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Template\Context;
use Magento\Framework\Registry;
use Magento\Framework\Data\FormFactory;
use Magento\Backend\Block\Widget\Tab\TabInterface;
class Answer extends Generic implements TabInterface{
	protected function _prepareForm(){
		$model=$this->_coreRegistry->registry("poll");
		$form=$this->_formFactory->create();

		$fieldset=$form->addFieldset(
				"answer_fieldset",
				["legend"=>__("Answer List"),"class"=>"fieldset-wide"]
			);

		$fieldset->addField(
				"poll_title", //Tên cột trong bảng, cũng chính là id của input
				"text", //Kiểu dữ liệu là text
				[
					"name" => "poll_title", //tên name="poll_title" trong input
					"label" => __("Poll Answer"),
					"required" => true,
				]
			);	
		$data=$model->getData();
		$form->setValues($data);				
		$this->setForm($form);
		return parent::_prepareForm();
	}
 	public function getTabLabel(){
 		return __("Answer List");
 	}
 	public function getTabTitle(){
 		return __("Answer List");
 	}	
 	public function canShowTab(){
 		return true;
 	}
 	public function isHidden(){
 		return false;
 	}
}