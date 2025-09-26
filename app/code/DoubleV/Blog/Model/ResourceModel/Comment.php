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
 * Comment Resource Model
 * 
 * This class handles database operations for blog comments.
 * It extends Magento's AbstractDb to provide database abstraction
 * and CRUD operations for the doublev_blog_comment table.
 *
 * @category    DoubleV
 * @package     DoubleV_Blog
 * @subpackage  Model/ResourceModel
 */
class Comment extends AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        /**
         * Initialize table and primary key
         * First parameter is the table name in database
         * Second parameter is the primary key field name
         */
        $this->_init('doublev_blog_comment', 'comment_id');
    }
}
