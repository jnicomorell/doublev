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

use DoubleV\Blog\Api\Data\PostInterface;
use DoubleV\Blog\Model\ResourceModel\Post as PostResource;
use Magento\Framework\Model\AbstractModel;

/**
 * Post model class
 * 
 * Handles blog post data operations and implements PostInterface.
 * Extends Magento's AbstractModel to provide standard model functionality.
 * 
 * @package DoubleV\Blog\Model
 * @author  Nicolas Morell <nicolasmorelldev@gmail.com>
 * @since   1.0.0
 */
class Post extends AbstractModel implements PostInterface
{
    /**
     * Initialize the post model with its resource model
     * 
     * Sets up the resource model class that handles database operations
     * for this post model.
     * 
     * @return void
     * @since 1.0.0
     */
    protected function _construct()
    {
        $this->_init(PostResource::class);
    }

    /**
     * Get post ID
     * 
     * Retrieves the unique identifier for the post.
     * 
     * @return int|null The post ID as integer, or null if not set
     * @since 1.0.0
     */
    public function getPostId(): ?int
    {
        return $this->getData(self::POST_ID) ? (int) $this->getData(self::POST_ID) : null;
    }

    /**
     * Set post ID
     * 
     * Sets the unique identifier for the post.
     * 
     * @param int $postId The post ID to set
     * @return PostInterface Returns this instance for method chaining
     * @since 1.0.0
     */
    public function setPostId(int $postId): PostInterface
    {
        return $this->setData(self::POST_ID, $postId);
    }

    /**
     * Override getId to return int consistently
     * 
     * Provides a consistent integer return type for the ID getter,
     * maintaining compatibility with AbstractModel while ensuring
     * type consistency.
     * 
     * @return int|null The post ID as integer, or null if not set
     * @since 1.0.0
     */
    public function getId()
    {
        return $this->getPostId();
    }

    /**
     * Get post title
     * 
     * Retrieves the title of the blog post.
     * 
     * @return string|null The post title, or null if not set
     * @since 1.0.0
     */
    public function getTitle(): ?string
    {
        return $this->getData(self::TITLE);
    }

    /**
     * Set post title
     * 
     * Sets the title for the blog post.
     * 
     * @param string $title The title to set for the post
     * @return PostInterface Returns this instance for method chaining
     * @since 1.0.0
     */
    public function setTitle(string $title): PostInterface
    {
        return $this->setData(self::TITLE, $title);
    }

    /**
     * Get post content
     * 
     * Retrieves the main content/body of the blog post.
     * 
     * @return string|null The post content, or null if not set
     * @since 1.0.0
     */
    public function getContent(): ?string
    {
        return $this->getData(self::CONTENT);
    }

    /**
     * Set post content
     * 
     * Sets the main content/body for the blog post.
     * 
     * @param string $content The content to set for the post
     * @return PostInterface Returns this instance for method chaining
     * @since 1.0.0
     */
    public function setContent(string $content): PostInterface
    {
        return $this->setData(self::CONTENT, $content);
    }

    /**
     * Get post author
     * 
     * Retrieves the name of the post's author.
     * 
     * @return string|null The author name, or null if not set
     * @since 1.0.0
     */
    public function getAuthor(): ?string
    {
        return $this->getData(self::AUTHOR);
    }

    /**
     * Set post author
     * 
     * Sets the name of the post's author.
     * 
     * @param string $author The author name to set
     * @return PostInterface Returns this instance for method chaining
     * @since 1.0.0
     */
    public function setAuthor(string $author): PostInterface
    {
        return $this->setData(self::AUTHOR, $author);
    }

    /**
     * Get post active status
     * 
     * Retrieves whether the post is currently active/published.
     * 
     * @return bool|null True if active, false if inactive, null if not set
     * @since 1.0.0
     */
    public function getIsActive(): ?bool
    {
        return $this->getData(self::IS_ACTIVE) !== null ? (bool) $this->getData(self::IS_ACTIVE) : null;
    }

    /**
     * Set post active status
     * 
     * Sets whether the post should be active/published.
     * 
     * @param bool $isActive True to make post active, false to deactivate
     * @return PostInterface Returns this instance for method chaining
     * @since 1.0.0
     */
    public function setIsActive(bool $isActive): PostInterface
    {
        return $this->setData(self::IS_ACTIVE, $isActive);
    }

    /**
     * Get post creation date
     * 
     * Retrieves the timestamp when the post was created.
     * 
     * @return string|null The creation date in string format, or null if not set
     * @since 1.0.0
     */
    public function getCreatedAt(): ?string
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * Set post creation date
     * 
     * Sets the timestamp when the post was created.
     * 
     * @param string $createdAt The creation date in string format
     * @return PostInterface Returns this instance for method chaining
     * @since 1.0.0
     */
    public function setCreatedAt(string $createdAt): PostInterface
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }

    /**
     * Get post update date
     * 
     * Retrieves the timestamp when the post was last updated.
     * 
     * @return string|null The last update date in string format, or null if not set
     * @since 1.0.0
     */
    public function getUpdatedAt(): ?string
    {
        return $this->getData(self::UPDATED_AT);
    }

    /**
     * Set post update date
     * 
     * Sets the timestamp when the post was last updated.
     * 
     * @param string $updatedAt The update date in string format
     * @return PostInterface Returns this instance for method chaining
     * @since 1.0.0
     */
    public function setUpdatedAt(string $updatedAt): PostInterface
    {
        return $this->setData(self::UPDATED_AT, $updatedAt);
    }
}
