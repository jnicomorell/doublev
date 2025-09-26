<?php
declare(strict_types=1);
/**
 * @copyright Copyright (c) 2025 - Nicolas Morell (https://www.linkedin.com/in/jomorell/)
 * @author      Nicolas Morell <nicolasmorelldev@gmail.com>
 * @category    Fullstack Developer
 * @package     DoubleV_Blog
 * @date        26/09/2025
 */

namespace DoubleV\Blog\Api;

use DoubleV\Blog\Api\Data\PostInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResultsInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Post repository interface
 * @api
 */
interface PostRepositoryInterface
{
    /**
     * Save post
     *
     * @param PostInterface $post The post data
     * @return PostInterface
     * @throws LocalizedException
     */
    public function save(PostInterface $post): PostInterface;

    /**
     * Get post by ID
     *
     * @param int $postId The post ID
     * @return PostInterface
     * @throws NoSuchEntityException If post with the specified ID does not exist
     */
    public function getById(int $postId): PostInterface;

    /**
     * Get post by ID with flexible input type
     *
     * @param mixed $postId The post ID (accepts various input types)
     * @return PostInterface
     * @throws NoSuchEntityException If post with the specified ID does not exist
     */
    public function getByIdFlexible($postId): PostInterface;

    /**
     * Retrieve posts matching the specified criteria
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return SearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria): SearchResultsInterface;

    /**
     * Delete post
     *
     * @param PostInterface $post The post to delete
     * @return bool True on success
     * @throws LocalizedException
     */
    public function delete(PostInterface $post): bool;

    /**
     * Delete post by ID
     *
     * @param int $postId The post ID
     * @return bool True on success
     * @throws NoSuchEntityException If post with the specified ID does not exist
     * @throws LocalizedException
     */
    public function deleteById(int $postId): bool;

    /**
     * Delete post by ID with flexible input type
     *
     * @param mixed $postId The post ID (accepts various input types)
     * @return bool True on success
     * @throws NoSuchEntityException If post with the specified ID does not exist
     * @throws LocalizedException
     */
    public function deleteByIdFlexible($postId): bool;
}
