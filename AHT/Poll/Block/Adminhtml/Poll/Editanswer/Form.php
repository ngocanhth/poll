<?php
namespace AHT\Poll\Block\Adminhtml\Poll\Editanswer;
use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Template\Context;
use Magento\Framework\Registry; //Class Generic có sẵn các đối số làm việc với registry
use Magento\Framework\Data\FormFactory;
use AHT\Poll\Model\Config\Status;
class Form extends Generic{
	protected $_pollStatus;
	public function __construct(
						Context $context,
						Registry $registry,
						FormFactory $formFactory,
						Status $status,
						array $data){
		$this->_pollStatus=$status;
		parent::__construct($context,$registry,$formFactory,$data);
	}
	protected function _construct(){
		$this->setId("poll_formanswer");
		$this->setTitle(__("Poll Information"));
		parent::_construct();
	}
	protected function _prepareForm(){
		$model=$this->_coreRegistry->registry("pollanswer");
		//$model1=$this->_coreRegistry->registry("poll_answer");
		$pollId=$this->getRequest()->getParam("id");


	//	var_dump($pollId);die();
		if($pollId){
		$form=$this->_formFactory->create(
				[
					"data" => [
						"id" => "edit_form",	//Chưa rõ lắm tại sao đổi id="edit_formanswer" không được, chắc liên quan đến js làm việc với id ="edit_form"
						"action" => $this->getUrl("poll/index/saveanswer" ,['poll_id' => $pollId]), //action của form này chuyển đến phương thức saveanswer
						"method" => "post",
						"enctype" => "multipart/form-data"
					]
				]
			);
		//Thiết lập các phần tử của form
		$fieldset=$form->addFieldset(
				"base_fieldset", //id của fieldset
				["legend"=>__("Create a new Poll Answer"),"class"=>"fieldset-wide"]
			);

		if($model->getId()){
			$fieldset->addField(
					"answer_id",
					"hidden",
					[
						"name" => "answer_id",
					]
				);
		}

		$fieldset->addField(
				"answer_title",
				"text",
				[
					"name" => "answer_title",
					"label" => __("Poll Answer"),
					"required" => true,
				]
			);
		$fieldset->addField(
				"votes_count",
				"text",
				[
					"name" => "votes_count",
					"label" => __("Votes Count"),
					"required" => true,
				]
			);
}
		// $fieldset->addField(
		// 		"poll",
		// 		"select",
		// 		[
		// 			"name" => "poll",
		// 			"label" => __("List Poll"),
		// 			"required" => true,
		// 			"options" => $this->_pollStatus->toOptionArray()
		// 		]
		// 	);	

		$data=$model->getData(); //lấy tất cả dữ liệu từ model ra
		$form->setValues($data);// truyền dữ liệu từ $data vào form				
		$form->setHtmlIdPrefix("poll_main_");	//Để tránh các trường fiedlset trùng lặp với module khác		
		$form->setUseContainer(true);
		$this->setForm($form);
		return parent::_prepareForm();
	}
}