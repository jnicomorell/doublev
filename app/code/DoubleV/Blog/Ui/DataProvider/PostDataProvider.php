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
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Ui\DataProvider\AbstractDataProvider;

/**
 * Post data provider for UI components
 * 
 * Provides post data for Magento UI components, particularly for forms.
 * Handles data persistence between form submissions and supports form
 * repopulation when validation errors occur. Extends AbstractDataProvider
 * to integrate seamlessly with Magento's UI framework.
 * 
 * @package DoubleV\Blog\Ui\DataProvider
 * @author  Nicolas Morell <nicolasmorelldev@gmail.com>
 * @since   1.0.0
 */
class PostDataProvider extends AbstractDataProvider
{
    /**
     * Data persistor interface
     * 
     * Used to store and retrieve form data across requests,
     * particularly useful for form validation scenarios.
     * 
     * @var DataPersistorInterface
     * @since 1.0.0
     */
    protected DataPersistorInterface $dataPersistor;

    /**
     * Loaded data cache
     * 
     * Stores loaded post data to avoid repeated database queries
     * within the same request lifecycle.
     * 
     * @var array
     * @since 1.0.0
     */
    protected array $loadedData = [];

    /**
     * PostDataProvider constructor
     * 
     * Initializes the data provider with post collection and data persistor.
     * The data persistor enables form data to survive validation failures
     * and page redirects, improving user experience.
     * 
     * @param string $name The name of the data provider component
     * @param string $primaryFieldName The primary field name (usually 'post_id')
     * @param string $requestFieldName The request field name for filtering
     * @param CollectionFactory $postCollectionFactory Factory for creating post collections
     * @param DataPersistorInterface $dataPersistor Interface for persisting form data
     * @param array $meta Additional metadata for the data provider
     * @param array $data Additional configuration data
     * @since 1.0.0
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $postCollectionFactory,
        DataPersistorInterface $dataPersistor,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $postCollectionFactory->create();
        $this->dataPersistor = $dataPersistor;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * Get data for UI components
     * 
     * Retrieves post data from the collection and handles data persistence
     * for form scenarios. Returns cached data if already loaded, otherwise
     * loads data from collection and checks for persisted form data from
     * previous submissions (useful for validation error scenarios).
     * 
     * @return array Array of post data indexed by post ID, where each
     *               post is represented as an associative array of field values
     * @since 1.0.0
     */
    public function getData()
    {
        if (!empty($this->loadedData)) {
            return $this->loadedData;
        }

        $items = $this->collection->getItems();
        
        foreach ($items as $post) {
            $this->loadedData[$post->getId()] = $post->getData();
        }

        // Check if data is being persisted from previous form submission
        $data = $this->dataPersistor->get('doublev_blog_post');
        if (!empty($data)) {
            $post = $this->collection->getNewEmptyItem();
            $post->setData($data);
            $this->loadedData[$post->getId()] = $post->getData();
            $this->dataPersistor->clear('doublev_blog_post');
        }

        return $this->loadedData;
    }
}
