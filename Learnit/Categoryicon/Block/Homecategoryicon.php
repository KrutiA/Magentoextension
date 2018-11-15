<?php

namespace Learnit\Categoryicon\Block;

class Homecategoryicon extends \Magento\Framework\View\Element\Template {

    protected $_categoryCollectionFactory;
    protected $_categoryHelper;
    protected $_storeManager;
    protected $_filesystem;
    protected $_imageFactory;

    public function __construct(
    \Magento\Backend\Block\Template\Context $context, \Magento\Catalog\Model\ResourceModel\Category\CollectionFactory $categoryCollectionFactory, \Magento\Catalog\Helper\Category $categoryHelper, \Magento\Store\Model\StoreManagerInterface $storeManager, \Magento\Framework\Filesystem $filesystem, \Magento\Framework\Image\AdapterFactory $imageFactory, array $data = []
    ) {
        $this->_storeManager = $storeManager;
        $this->_categoryCollectionFactory = $categoryCollectionFactory;
        $this->_categoryHelper = $categoryHelper;
        $this->_filesystem = $filesystem;
        $this->_imageFactory = $imageFactory;
        parent::__construct($context, $data);
    }

    /**
     * Get store id
     *
     * @return int
     */
    public function getStoreId() {
        return $this->_storeManager->getStore()->getId();
    }

    public function getCategoryCollection($isActive = true, $level = false, $sortBy = false, $pageSize = false, $urlrewrite = true) {
        $collection = $this->_categoryCollectionFactory->create();
        $collection->addAttributeToSelect('*')->setStore($this->getStoreId());
        // select only active categories
        if ($isActive) {
            $collection->addIsActiveFilter();
        }

        // select categories of certain level
        if ($level) {
            //$collection->addLevelFilter($level);
            $collection->addFieldToFilter('level', ['eq' => $level]);
        }

        // sort categories by some value
        if ($sortBy) {
            $collection->addOrderField($sortBy);
        }

        // select certain number of categories
        if ($pageSize) {
            $collection->setPageSize($pageSize);
        }

        if ($urlrewrite) {
            $collection->joinUrlRewrite();
        }

        //echo $collection->getSelect()->__toString();
        return $collection;
    }

    /**
     * Retrieve current store categories
     *
     * @param bool|string $sorted
     * @param bool $asCollection
     * @param bool $toLoad
     * @return \Magento\Framework\Data\Tree\Node\Collection or
     * \Magento\Catalog\Model\ResourceModel\Category\Collection or array
     */
    public function getStoreCategories($sorted = false, $asCollection = false, $toLoad = true) {
        return $this->_categoryHelper->getStoreCategories($sorted = false, $asCollection = false, $toLoad = true);
    }

}
