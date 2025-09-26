<?php
declare(strict_types=1);
/**
 * @copyright Copyright (c) 2025 - Nicolas Morell (https://www.linkedin.com/in/jomorell/)
 * @author      Nicolas Morell <nicolasmorelldev@gmail.com>
 * @category    Fullstack Developer
 * @package     DoubleV_Blog
 * @date        26/09/2025
 */

namespace DoubleV\Blog\Api\Data;

/**
 * Comment interface
 * @api
 */
interface CommentInterface
{
    public const COMMENT_ID = 'comment_id';
    public const POST_ID = 'post_id';
    public const AUTHOR = 'author';
    public const CONTENT = 'content';
    public const EMAIL = 'email';
    public const IS_ACTIVE = 'is_active';
    public const CREATED_AT = 'created_at';

    /**
     * Get comment ID
     *
     * @return int|null
     */
    public function getCommentId(): ?int;

    /**
     * Set comment ID
     *
     * @param int $commentId
     * @return CommentInterface
     */
    public function setCommentId(int $commentId): CommentInterface;

    /**
     * Get post ID
     *
     * @return int|null
     */
    public function getPostId(): ?int;

    /**
     * Set post ID
     *
     * @param int $postId
     * @return CommentInterface
     */
    public function setPostId(int $postId): CommentInterface;

    /**
     * Get author name
     *
     * @return string|null
     */
    public function getAuthor(): ?string;

    /**
     * Set author name
     *
     * @param string $author
     * @return CommentInterface
     */
    public function setAuthor(string $author): CommentInterface;

    /**
     * Get comment content
     *
     * @return string|null
     */
    public function getContent(): ?string;

    /**
     * Set comment content
     *
     * @param string $content
     * @return CommentInterface
     */
    public function setContent(string $content): CommentInterface;

    /**
     * Get author email
     *
     * @return string|null
     */
    public function getEmail(): ?string;

    /**
     * Set author email
     *
     * @param string $email
     * @return CommentInterface
     */
    public function setEmail(string $email): CommentInterface;

    /**
     * Get comment status
     *
     * @return bool|null
     */
    public function getIsActive(): ?bool;

    /**
     * Set comment status
     *
     * @param bool $isActive
     * @return CommentInterface
     */
    public function setIsActive(bool $isActive): CommentInterface;

    /**
     * Get creation date
     *
     * @return string|null
     */
    public function getCreatedAt(): ?string;

    /**
     * Set creation date
     *
     * @param string $createdAt
     * @return CommentInterface
     */
    public function setCreatedAt(string $createdAt): CommentInterface;
}
