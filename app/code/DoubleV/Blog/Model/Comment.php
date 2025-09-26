<?php
declare(strict_types=1);
/**
 * @copyright Copyright (c) 2025 - Nicolas Morell (https://www.linkedin.com/in/jomorell/)
 * @author      Nicolas Morell <nicolasmorelldev@gmail.com>
 * @category    Fullstack Developer
 * @package     DoubleV_Blog
 * @date        26/09/2025
 */

namespace DoubleV\Blog\Model;

use DoubleV\Blog\Api\Data\CommentInterface;
use DoubleV\Blog\Model\ResourceModel\Comment as CommentResource;
use Magento\Framework\Model\AbstractModel;

/**
 * Class Comment
 * Blog comment model class
 */
class Comment extends AbstractModel implements CommentInterface
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(CommentResource::class);
    }

    /**
     * Get comment ID
     *
     * @return int|null
     */
    public function getCommentId(): ?int
    {
        return $this->getData(self::COMMENT_ID) ? (int) $this->getData(self::COMMENT_ID) : null;
    }

    /**
     * Set comment ID
     *
     * @param int $commentId
     * @return CommentInterface
     */
    public function setCommentId(int $commentId): CommentInterface
    {
        return $this->setData(self::COMMENT_ID, $commentId);
    }

    /**
     * Get post ID
     *
     * @return int|null
     */
    public function getPostId(): ?int
    {
        return $this->getData(self::POST_ID) ? (int) $this->getData(self::POST_ID) : null;
    }

    /**
     * Set post ID
     *
     * @param int $postId
     * @return CommentInterface
     */
    public function setPostId(int $postId): CommentInterface
    {
        return $this->setData(self::POST_ID, $postId);
    }

    /**
     * Get author name
     *
     * @return string|null
     */
    public function getAuthor(): ?string
    {
        return $this->getData(self::AUTHOR);
    }

    /**
     * Set author name
     *
     * @param string $author
     * @return CommentInterface
     */
    public function setAuthor(string $author): CommentInterface
    {
        return $this->setData(self::AUTHOR, $author);
    }

    /**
     * Get comment content
     *
     * @return string|null
     */
    public function getContent(): ?string
    {
        return $this->getData(self::CONTENT);
    }

    /**
     * Set comment content
     *
     * @param string $content
     * @return CommentInterface
     */
    public function setContent(string $content): CommentInterface
    {
        return $this->setData(self::CONTENT, $content);
    }

    /**
     * Get author email
     *
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->getData(self::EMAIL);
    }

    /**
     * Set author email
     *
     * @param string $email
     * @return CommentInterface
     */
    public function setEmail(string $email): CommentInterface
    {
        return $this->setData(self::EMAIL, $email);
    }

    /**
     * Get comment status
     *
     * @return bool|null
     */
    public function getIsActive(): ?bool
    {
        return $this->getData(self::IS_ACTIVE) !== null ? (bool) $this->getData(self::IS_ACTIVE) : null;
    }

    /**
     * Set comment status
     *
     * @param bool $isActive
     * @return CommentInterface
     */
    public function setIsActive(bool $isActive): CommentInterface
    {
        return $this->setData(self::IS_ACTIVE, $isActive);
    }

    /**
     * Get creation timestamp
     *
     * @return string|null
     */
    public function getCreatedAt(): ?string
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * Set creation timestamp
     *
     * @param string $createdAt
     * @return CommentInterface
     */
    public function setCreatedAt(string $createdAt): CommentInterface
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }
}
