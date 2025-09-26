<?php
declare(strict_types=1);
/**
 * @copyright Copyright (c) 2025 - Nicolas Morell (https://www.linkedin.com/in/jomorell/)
 * @author      Nicolas Morell <nicolasmorelldev@gmail.com>
 * @category    Fullstack Developer
 * @package     DoubleV_Blog
 * @date        26/09/2025
 */

namespace DoubleV\Blog\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Blog Post Resource Model
 * 
 * This class handles database operations for blog posts
 * Manages the connection between the Post model and the doublev_blog_post table
 *
 * @category    DoubleV
 * @package     DoubleV_Blog
 * @author      Nicolas Morell <nicolasmorelldev@gmail.com>
 */
class Post extends AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('doublev_blog_post', 'post_id');
    }
}
