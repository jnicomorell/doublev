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

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class Index
 * Admin controller for blog posts listing page
 */
class Index extends Action
{
    /**
     * @var PageFactory
     */
    protected PageFactory $resultPageFactory;

    /**
     * Constructor
     *
     * @param Context $context Backend action context
     * @param PageFactory $resultPageFactory Result page factory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * Execute action based on request and return result
     *
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('DoubleV_Blog::posts');
        $resultPage->getConfig()->getTitle()->prepend(__('Posts'));

        return $resultPage;
    }

    /**
     * Check if admin has permissions to access this page
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('DoubleV_Blog::posts');
    }
}
