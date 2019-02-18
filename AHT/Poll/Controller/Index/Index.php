<?php
namespace AHT\Poll\Controller\Index;
class Index extends \Magento\Framework\App\Action\Action
{
const COOKIE_NAME = 'test';
const COOKIE_DURATION = 86400; // lifetime in seconds
/**
* @var \Magento\Framework\Stdlib\CookieManagerInterface
*/
protected $_cookieManager;
/**
* @var \Magento\Framework\Stdlib\Cookie\CookieMetadataFactory
*/
protected $_cookieMetadataFactory;
/**
* @param \Magento\Framework\App\Action\Context $context
* @param \Magento\Framework\Stdlib\CookieManagerInterface $cookieManager
* @param \Magento\Framework\Stdlib\Cookie\CookieMetadataFactory $cookieMetadataFactory
*/
public function __construct(
     \Magento\Framework\App\Action\Context $context,
     \Magento\Framework\Stdlib\CookieManagerInterface $cookieManager,
     \Magento\Framework\Stdlib\Cookie\CookieMetadataFactory $cookieMetadataFactory
)
{
     $this->_cookieManager = $cookieManager;
     $this->_cookieMetadataFactory = $cookieMetadataFactory;
     parent::__construct($context);
}
public function execute()
{
	//Tạo cokie
     $metadata = $this->_cookieMetadataFactory
         ->createPublicCookieMetadata()
         ->setDuration(self::COOKIE_DURATION);
     $this->_cookieManager->setPublicCookie(
         self::COOKIE_NAME,
         'Đây là giá trị của Cokie',
         $metadata
     );
     echo('Create Cookie')."<br>";

    echo $this->Readcookie();

}
	//Đọc cokie
	public function Readcookie(){
		$cookieValue = $this->_cookieManager->getCookie(\AHT\Poll\Controller\Index\Index::COOKIE_NAME);
   		echo($cookieValue);
	}

	//Delete Cookie
	
	public function Deletecookie(){
		  $this->_cookieManager->deleteCookie(
         \AHT\Poll\Controller\Index\Index::COOKIE_NAME);
     echo('DELETED');
	} 
}