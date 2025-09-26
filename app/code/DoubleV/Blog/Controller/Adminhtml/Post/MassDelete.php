<?php
declare(strict_types=1);
/**
 * @copyright Copyright (c) 2025 - Nicolas Morell (https://www.linkedin.com/in/jomorell/)
 * @author      Nicolas Morell <nicolasmorelldev@gmail.com>
 * @category    Fullstack Developer
 * @package     DoubleV_Blog
 * @date        26/09/2025
 */

namespace DoubleV\Blog\Controller\Adminhtml\Post;

use DoubleV\Blog\Model\ResourceModel\Post\CollectionFactory;
use DoubleV\Blog\Api\PostRepositoryInterface;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Ui\Component\MassAction\Filter;

/**
 * Class MassDelete
 * 
 * Handles mass deletion of blog posts from the admin grid
 */
class MassDelete extends Action
{
    /**
     * @var Filter Mass Action Filter
     */
    protected Filter $filter;

    /**
     * @var CollectionFactory Blog Post Collection Factory
     */
    protected CollectionFactory $collectionFactory;

    /**
     * @var PostRepositoryInterface Post Repository Interface
     */
    protected PostRepositoryInterface $postRepository;

    /**
     * Constructor
     *
     * @param Context $context Admin context
     * @param Filter $filter Mass Action Filter
     * @param CollectionFactory $collectionFactory Blog Post Collection Factory
     * @param PostRepositoryInterface $postRepository Post Repository Interface
     */
    public function __construct(
        Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory,
        PostRepositoryInterface $postRepository
    ) {
        parent::__construct($context);
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        $this->postRepository = $postRepository;
    }

    /**
     * Execute mass deletion action
     *
     * @return \Magento\Framework\Controller\Result\Redirect
     */
    public function execute()
    {
        $collection = $this->filter->getCollection($this->collectionFactory->create());
        $collectionSize = $collection->getSize();

        foreach ($collection as $post) {
            $this->postRepository->delete($post);
        }

        $this->messageManager->addSuccessMessage(__('A total of %1 record(s) have been deleted.', $collectionSize));

        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setPath('*/*/');
    }

    /**
     * Check if user has enough privileges
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('DoubleV_Blog::posts');
    }
}
