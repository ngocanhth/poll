<?php
namespace AHT\Poll\Block\Adminhtml\Poll;
use Magento\Backend\Block\Widget\Form\Container;
class Editanswer extends Container{
	protected function _construct(){
		$this->_blockGroup="AHT_Poll";
		$this->_controller="adminhtml_poll";
		$this->_objectId="answer_id";
		$this->_mode="Editanswer";

		parent::_construct();
		$this->buttonList->update("save", "label",__("Save Answer"));
		 // $this->buttonList->add(
		 // 	"saveanswer", //id của button
		 // 	  [
   //              'label' => __('Lưu câu trả lời'),
   //              'class' => 'save primary',
   //              'data_attribute' => [
   //                  'mage-init' => ['button' => ['event' => 'saveanswer', 'target' => '#edit_formanswer']],
   //              ]
   //          ],
   //          -100
		 // );
	}
}