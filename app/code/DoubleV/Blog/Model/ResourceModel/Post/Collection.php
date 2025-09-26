<?php
declare(strict_types=1);
/**
 * @copyright Copyright (c) 2025 - Nicolas Morell (https://www.linkedin.com/in/jomorell/)
 * @author      Nicolas Morell <nicolasmorelldev@gmail.com>
 * @category    Fullstack Developer
 * @package     DoubleV_Blog
 * @date        26/09/2025
 */

namespace DoubleV\Blog\Model\ResourceModel\Post;

use DoubleV\Blog\Model\Post;
use DoubleV\Blog\Model\ResourceModel\Post as PostResource;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Blog Post Collection Class
 *
 * This class represents a collection of blog posts and handles database operations
 * for retrieving multiple blog post entries.
 *
 * @category    DoubleV
 * @package     DoubleV_Blog
 * @author      Nicolas Morell <nicolasmorelldev@gmail.com>
 */
class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'post_id';

    /**
     * Initialize resource collection
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(Post::class, PostResource::class);
    }
}
