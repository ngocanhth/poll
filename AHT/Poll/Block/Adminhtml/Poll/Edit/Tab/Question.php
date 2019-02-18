<?php
namespace AHT\Poll\Block\Adminhtml\Poll\Edit\Tab;
use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Template\Context;
use Magento\Framework\Registry;
use Magento\Framework\Data\FormFactory;
use AHT\Poll\Model\Config\Status;
use Magento\Backend\Block\Widget\Tab\TabInterface;
class Question extends Generic implements TabInterface{
	protected $_pollStatus;
	public function __construct(
						Context $context,
						Registry $registry,
						FormFactory $formFactory,
						Status $status,
						array $data=[]){
		$this->_pollStatus=$status;
		parent::__construct($context,$registry,$formFactory,$data);
	}
	protected function _prepareForm(){
		$model=$this->_coreRegistry->registry("poll");
		$form=$this->_formFactory->create();

		$fieldset=$form->addFieldset(
				"base_fieldset",
				["legend"=>__("General Information"),"class"=>"fieldset-wide"]
			);

		if($model->getId()){
			$fieldset->addField(
					"id",
					"hidden",
					["name" => "id"]
				);
		}
		$fieldset->addField(
				"poll_title",
				"text",
				[
					"name" => "poll_title",
					"label" => __("Poll Question"),
					"required" => true,
				]
			);

		$fieldset->addField(
				"status",
				"select",
				[
					"name" => "status",
					"label" => __("Status"),
					"required" => true,
					"options" => $this->_pollStatus->toOptionArray()
				]
			);	

		$data=$model->getData();
		$form->setValues($data);				
		$this->setForm($form);
		return parent::_prepareForm();
	}
 	public function getTabLabel(){
 		return __("Main Information");
 	}
 	public function getTabTitle(){
 		return __("Title Main Information");
 	}	
 	public function canShowTab(){
 		return true;
 	}
 	public function isHidden(){
 		return false;
 	}
}