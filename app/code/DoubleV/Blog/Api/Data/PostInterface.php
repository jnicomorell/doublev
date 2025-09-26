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
 * Post interface
 * @api
 */
interface PostInterface
{
    public const POST_ID = 'post_id';
    public const TITLE = 'title';
    public const CONTENT = 'content';
    public const AUTHOR = 'author';
    public const IS_ACTIVE = 'is_active';
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';

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
     * @return PostInterface
     */
    public function setPostId(int $postId): PostInterface;

    /**
     * Get post title
     *
     * @return string|null
     */
    public function getTitle(): ?string;

    /**
     * Set post title
     *
     * @param string $title
     * @return PostInterface
     */
    public function setTitle(string $title): PostInterface;

    /**
     * Get post content
     *
     * @return string|null
     */
    public function getContent(): ?string;

    /**
     * Set post content
     *
     * @param string $content
     * @return PostInterface
     */
    public function setContent(string $content): PostInterface;

    /**
     * Get post author
     *
     * @return string|null
     */
    public function getAuthor(): ?string;

    /**
     * Set post author
     *
     * @param string $author
     * @return PostInterface
     */
    public function setAuthor(string $author): PostInterface;

    /**
     * Get post active status
     *
     * @return bool|null
     */
    public function getIsActive(): ?bool;

    /**
     * Set post active status
     *
     * @param bool $isActive
     * @return PostInterface
     */
    public function setIsActive(bool $isActive): PostInterface;

    /**
     * Get post creation date
     *
     * @return string|null
     */
    public function getCreatedAt(): ?string;

    /**
     * Set post creation date
     *
     * @param string $createdAt
     * @return PostInterface
     */
    public function setCreatedAt(string $createdAt): PostInterface;

    /**
     * Get post update date
     *
     * @return string|null
     */
    public function getUpdatedAt(): ?string;

    /**
     * Set post update date
     *
     * @param string $updatedAt
     * @return PostInterface
     */
    public function setUpdatedAt(string $updatedAt): PostInterface;
}
