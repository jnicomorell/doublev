<?php
declare(strict_types=1);
/**
 * @copyright Copyright (c) 2025 - Nicolas Morell (https://www.linkedin.com/in/jomorell/)
 * @author      Nicolas Morell <nicolasmorelldev@gmail.com>
 * @category    Fullstack Developer
 * @package     DoubleV_Blog
 * @date        26/09/2025
 */

namespace DoubleV\Blog\Ui\DataProvider;

use DoubleV\Blog\Model\ResourceModel\Post\CollectionFactory;
use Magento\Framework\Api\Filter;
use Magento\Ui\DataProvider\AbstractDataProvider;

/**
 * Post listing data provider for UI components
 * 
 * Provides post data specifically for listing components such as grids and tables.
 * Handles filtering, sorting, and pagination for post listings in the admin panel.
 * Extends AbstractDataProvider with custom filtering strategies for enhanced
 * search and filter capabilities.
 * 
 * @package DoubleV\Blog\Ui\DataProvider
 * @author  Nicolas Morell <nicolasmorelldev@gmail.com>
 * @since   1.0.0
 */
class PostListingDataProvider extends AbstractDataProvider
{
    /**
     * PostListingDataProvider constructor
     * 
     * Initializes the data provider with a post collection for listing purposes.
     * Sets up the foundation for grid/listing components with proper collection
     * handling for display, filtering, and pagination operations.
     * 
     * @param string $name The name of the data provider component
     * @param string $primaryFieldName The primary field name (usually 'post_id')
     * @param string $requestFieldName The request field name for filtering
     * @param CollectionFactory $collectionFactory Factory for creating post collections
     * @param array $meta Additional metadata for the data provider
     * @param array $data Additional configuration data
     * @since 1.0.0
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * Add filter to the collection
     * 
     * Applies filters to the post collection with support for custom filtering
     * strategies. Checks for field-specific filter strategies before falling
     * back to the default parent implementation. This allows for specialized
     * filtering logic for complex fields or relationships.
     * 
     * @param Filter $filter The filter object containing field, condition, and value
     * @return void
     * @since 1.0.0
     */
    public function addFilter(Filter $filter)
    {
        if (isset($this->addFilterStrategies[$filter->getField()])) {
            $this->addFilterStrategies[$filter->getField()]
                ->addFilter(
                    $this->getCollection(),
                    $filter->getField(),
                    [$filter->getConditionType() => $filter->getValue()]
                );
        } else {
            parent::addFilter($filter);
        }
    }
}
