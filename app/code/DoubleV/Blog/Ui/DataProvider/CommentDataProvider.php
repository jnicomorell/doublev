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

use DoubleV\Blog\Model\ResourceModel\Comment\CollectionFactory;
use Magento\Ui\DataProvider\AbstractDataProvider;

/**
 * Comment data provider for UI components
 * 
 * Provides comment data for Magento UI components such as grids and forms.
 * Extends AbstractDataProvider to integrate with Magento's UI framework
 * and handles data formatting for frontend consumption.
 * 
 * @package DoubleV\Blog\Ui\DataProvider
 * @author  Nicolas Morell <nicolasmorelldev@gmail.com>
 * @since   1.0.0
 */
class CommentDataProvider extends AbstractDataProvider
{
    /**
     * CommentDataProvider constructor
     * 
     * Initializes the data provider with a comment collection and sets up
     * the necessary parameters for UI component integration. The collection
     * will be used to fetch and format comment data for display.
     * 
     * @param string $name The name of the data provider component
     * @param string $primaryFieldName The primary field name (usually 'comment_id')
     * @param string $requestFieldName The request field name for filtering
     * @param CollectionFactory $commentCollectionFactory Factory for creating comment collections
     * @param array $meta Additional metadata for the data provider
     * @param array $data Additional configuration data
     * @since 1.0.0
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $commentCollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $commentCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * Get formatted data for UI components
     * 
     * Retrieves comment data from the collection and formats it for consumption
     * by UI components. Returns both the items and total record count for
     * pagination and display purposes.
     * 
     * @return array Formatted data array containing:
     *               - 'totalRecords': Total number of comments in collection
     *               - 'items': Array of comment data items
     * @since 1.0.0
     */
    public function getData()
    {
        $items = $this->getCollection()->toArray();
        return [
            'totalRecords' => $this->getCollection()->getSize(),
            'items' => array_values($items['items'] ?? []),
        ];
    }
}
