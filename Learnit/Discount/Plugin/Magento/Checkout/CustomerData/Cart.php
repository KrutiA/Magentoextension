<?php 
namespace Learnit\Discount\Plugin\Magento\Checkout\CustomerData;
class Cart
{
	/**
	* @param \Magento\Checkout\CustomerData\Cart $subject
	* @param array $result
	* @return array
	*/
	public function afterGetSectionData(\Magento\Checkout\CustomerData\Cart $subject, array $result)
	{
		
		$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
		$priceHelper = $objectManager->create('Magento\Framework\Pricing\Helper\Data'); // Instance of Pricing Helper
		$real_quote = $objectManager->get('Magento\Checkout\Model\Session')->getQuote();
		$discountTotal = 0;
		foreach ($real_quote->getAllItems() as $item){
			$discountTotal += $item->getDiscountAmount();
		}
		
			$result['bundlediscount'] = '-'.$priceHelper->currency($discountTotal,true,false);	
			$result['grandtotal'] = $priceHelper->currency($real_quote->getGrandTotal(),true,false);
		
		return $result;
	}
}
?>