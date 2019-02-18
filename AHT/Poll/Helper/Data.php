<?php
namespace AHT\Boll\Helper;
use Magento\Framework\App\Helper\AbstractHelper;
class Data extends AbstractHelper
{
    protected $_request;

    public function __construct
    (
        \Magento\Framework\App\Request\Http $request
    ) {
        $this->_request = $request;
    }

    public function getTemplate()
    {
        // if ($this->_scopeConfig->isSetFlag('custom_general/general/active')) {
        //     $template =  'AHT_Poll::active.phtml';
        // } else {
        //     $template = 'AHT_Poll::result.phtml';
        // }
 $template = 'AHT_Poll::result.phtml';
        return $template;
    }
} 

/*
    Gọi block trong layout
<block class="AHT\Poll\Block\Poll\ActivePoll" name="active.poll">
      <action method="setTemplate">
        <argument name="template" xsi:type="helper" helper="AHT\Poll\Helper\Data::getTemplate"></argument>
    </action>
</block>

 */