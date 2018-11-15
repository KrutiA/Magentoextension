<?php

namespace Learnit\Categoryicon\Model\Category;

class DataProvider extends \Magento\Catalog\Model\Category\DataProvider {

    protected function getFieldsMap() {
        $fields = parent::getFieldsMap();
        $fields['content'][] = 'md_category_icon'; // custom field for image icon

        return $fields;
    }

}
