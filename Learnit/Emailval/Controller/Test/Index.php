<?php
namespace Learnit\Emailval\Controller\Test;
class Index extends \Magento\Framework\App\Action\Action
{
    /**
    * @var \Magento\Framework\HTTP\Client\Curl
    */
    protected $_curl;
    /**
     * @param \Magento\Framework\App\Action\Context $context
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context
    ) 
    {
        parent::__construct($context);
    }

    public function execute()
    {
        $post = $this->getRequest()->getPostValue();
        echo '<pre>'; print_r($post); echo '</pre>'; die;
        //echo "dsfjhdsf"; die;
        $api_key = 'f424444d972041b2860d818e02be95e8';
        $emailToValidate = 'krutiaparnathi2010@gmail.com';
        $IPToValidate = '99.123.12.122';
        // use curl to make the request
        $url = 'https://api.zerobounce.net/v2/validate?api_key='.$api_key.'&email='.urlencode($emailToValidate).'&ip_address='.urlencode($IPToValidate);
        $ch = curl_init($url);
        //PHP 5.5.19 and higher has support for TLS 1.2
        curl_setopt($ch, CURLOPT_SSLVERSION, 6);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15); 
        curl_setopt($ch, CURLOPT_TIMEOUT, 150); 
        $response = curl_exec($ch);
        curl_close($ch);
        //decode the json response
        $json = json_decode($response, true);
        echo '<pre>'; print_r($json); echo '</pre>'; die;  
    }
}
