<?php
declare(strict_types=1);
/**
 * @copyright Copyright (c) 2025 - Nicolas Morell (https://www.linkedin.com/in/jomorell/)
 * @author      Nicolas Morell <nicolasmorelldev@gmail.com>
 * @category    Fullstack Developer
 * @package     DoubleV_Blog
 * @date        26/09/2025
 */

namespace DoubleV\Blog\Block\Adminhtml\Post\Edit;

use Magento\Backend\Block\Widget\Context;

/**
 * Generic Button Class for Admin Post Edit
 *
 * Provides common functionality for admin buttons in the post edit interface
 */
class GenericButton
{
    /**
     * @var Context
     */
    protected Context $context;

    /**
     * Constructor
     *
     * @param Context $context The backend widget context
     */
    public function __construct(Context $context)
    {
        $this->context = $context;
    }

    /**
     * Get current post ID
     *
     * @return int|null
     */
    public function getPostId()
    {
        return $this->context->getRequest()->getParam('post_id');
    }

    /**
     * Generate url by route and parameters
     *
     * @param string $route  The route name
     * @param array  $params The URL parameters
     * @return string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}
