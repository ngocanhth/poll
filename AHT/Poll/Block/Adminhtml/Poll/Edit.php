<?php
namespace AHT\Poll\Block\Adminhtml\Poll;
use Magento\Backend\Block\Widget\Form\Container;
class Edit extends Container{
	protected function _construct(){
		$this->_blockGroup="AHT_Poll";
		$this->_controller="adminhtml_poll";
		$this->_objectId="poll_id";
		parent::_construct();
	}
}

//Tại đây sẽ có 1 button save khai báo mặc định trong core target tới #edit_form là id của form không thay đổi, thay đổi có thể không submit được. Chưa rõ lắm tại sao đổi id="edit_formanswer" không được, chắc liên quan đến js làm việc với id ="edit_form"