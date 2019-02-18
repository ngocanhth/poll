<?php
namespace AHT\Poll\Block\Adminhtml\Poll\Edit;
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
		$this->setId("poll_form");
		$this->setTitle(__("Poll Information"));
		parent::_construct();
	}
	protected function _prepareForm(){
		$model=$this->_coreRegistry->registry("poll");	//Lấy model poll thông qua registry đã lấy được từ controller edit lưu vào registry poll đã đặt tên bên controller edit
		//$model1=$this->_coreRegistry->registry("poll_answer");
		$form=$this->_formFactory->create(
				[
					"data" => [
						"id" => "edit_form",
						"action" => $this->getData("action"), //sẽ chuyển đến phương thức save mặc định của magento là save
						"method" => "post",
						"enctype" => "multipart/form-data"
					]
				]
			);
		//Thiết lập các phần tử của form
		$fieldset=$form->addFieldset(
				"base_fieldset", //id của fieldset
				["legend"=>__("Create a new Poll Question"),"class"=>"fieldset-wide"]
			);

		if($model->getId()){  //nếu có id tuc nguoi dùng chỉnh sửa thì mới có trường ẩn input id để submit form 
			$fieldset->addField(
					"poll_id",
					"hidden",
					["name" => "poll_id"]
				);
		}
		$fieldset->addField(
				"poll_title",  //tên cột
				"text",
				[
					"name" => "poll_title", //name="poll_title" của thẻ input
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

		$data=$model->getData(); //Bên controller edit đã check nếu có dữ liệu thì setData, giờ getData tức lấy giá trị nhập được tù form nghĩa là không cần biết là edit hay thêm mới cứ có dữ liệu ở form là lấy ra và  setValues. 	$data chỉ có giá trị khi chỉnh sửa thì mới có data lấy được từ model, còn thêm mới data sẽ là 1 mảng rỗng tại đây
		
		// echo "<pre>";
		// var_dump($data); die();
		// echo "<pre/>";

		$form->setValues($data);//Câu lệnh này chính là set giá trị cho form, đưa giá trị từ $data lấy được từ model ra form để người dùng biết mà chỉnh sửa
		$form->setHtmlIdPrefix("poll_main_");	//Để tránh các trường fiedlset trùng lặp với module khác		
		$form->setUseContainer(true);
		$this->setForm($form);
		return parent::_prepareForm();
	}
}