<?php
declare(strict_types=1);
/**
 * @copyright Copyright (c) 2025 - Nicolas Morell (https://www.linkedin.com/in/jomorell/)
 * @author      Nicolas Morell <nicolasmorelldev@gmail.com>
 * @category    Fullstack Developer
 * @package     DoubleV_Blog
 * @date        26/09/2025
 */

namespace DoubleV\Blog\Model\ResourceModel\Comment;

use DoubleV\Blog\Model\Comment;
use DoubleV\Blog\Model\ResourceModel\Comment as CommentResource;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Comment Collection Class
 *
 * This class represents a collection of blog comments and provides methods
 * to interact with comment data in the database.
 *
 * @category    DoubleV
 * @package     DoubleV_Blog
 * @subpackage  Model
 */
class Collection extends AbstractCollection
{
    /**
     * Primary key field name
     *
     * @var string
     */
    protected $_idFieldName = 'comment_id';

    /**
     * Initialize collection
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(Comment::class, CommentResource::class);
    }
}
