<?php
declare(strict_types=1);
/**
 * @copyright Copyright (c) 2025 - Nicolas Morell (https://www.linkedin.com/in/jomorell/)
 * @author      Nicolas Morell <nicolasmorelldev@gmail.com>
 * @category    Fullstack Developer
 * @package     DoubleV_Blog
 * @date        26/09/2025
 */

namespace DoubleV\Blog\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\UrlInterface;

/**
 * Post actions column for admin grid
 * 
 * Provides action buttons (Edit, Delete) for each post row in the admin
 * grid listing. Extends Magento's UI Component Column to add custom
 * action links with appropriate URLs and confirmation dialogs.
 * 
 * @package DoubleV\Blog\Ui\Component\Listing\Column
 * @author  Nicolas Morell <nicolasmorelldev@gmail.com>
 * @since   1.0.0
 */
class PostActions extends Column
{
    /**
     * URL path for edit post action
     * 
     * @var string
     * @since 1.0.0
     */
    const URL_PATH_EDIT = 'doublev_blog/post/edit';

    /**
     * URL path for delete post action
     * 
     * @var string
     * @since 1.0.0
     */
    const URL_PATH_DELETE = 'doublev_blog/post/delete';

    /**
     * URL builder instance
     * 
     * @var UrlInterface
     * @since 1.0.0
     */
    protected UrlInterface $urlBuilder;

    /**
     * PostActions constructor
     * 
     * Initializes the actions column with required dependencies for generating
     * action URLs and handling UI component functionality.
     * 
     * @param ContextInterface $context UI component context
     * @param UiComponentFactory $uiComponentFactory Factory for creating UI components
     * @param UrlInterface $urlBuilder URL builder for generating action links
     * @param array $components Child components array
     * @param array $data Component configuration data
     * @since 1.0.0
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        array $components = [],
        array $data = []
    ) {
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Prepare data source with action links
     * 
     * Processes the data source to add action buttons (Edit and Delete) for each
     * post row in the grid. Generates appropriate URLs for each action and includes
     * confirmation dialog configuration for the delete action.
     * 
     * The method adds:
     * - Edit action: Direct link to the edit form
     * - Delete action: Link with confirmation dialog showing post title
     * 
     * @param array $dataSource The grid data source containing post items
     * @return array Modified data source with action links added to each item
     * @since 1.0.0
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                if (isset($item['post_id'])) {
                    $item[$this->getData('name')] = [
                        'edit' => [
                            'href' => $this->urlBuilder->getUrl(
                                static::URL_PATH_EDIT,
                                ['post_id' => $item['post_id']]
                            ),
                            'label' => __('Edit')
                        ],
                        'delete' => [
                            'href' => $this->urlBuilder->getUrl(
                                static::URL_PATH_DELETE,
                                ['post_id' => $item['post_id']]
                            ),
                            'label' => __('Delete'),
                            'confirm' => [
                                'title' => __('Delete "${ $.$data.title }"'),
                                'message' => __('Are you sure you wan\'t to delete a "${ $.$data.title }" record?')
                            ]
                        ]
                    ];
                }
            }
        }

        return $dataSource;
    }
}
