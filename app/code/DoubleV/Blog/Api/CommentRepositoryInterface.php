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

use DoubleV\Blog\Api\Data\CommentInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResultsInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Comment repository interface
 * @api
 */
interface CommentRepositoryInterface
{
    /**
     * Save comment
     *
     * @param CommentInterface $comment
     * @return CommentInterface
     * @throws LocalizedException
     */
    public function save(CommentInterface $comment): CommentInterface;

    /**
     * Get comment by ID
     *
     * @param int $commentId
     * @return CommentInterface
     * @throws NoSuchEntityException
     */
    public function getById(int $commentId): CommentInterface;

    /**
     * Get comments by post ID
     *
     * @param int $postId
     * @return CommentInterface[]
     */
    public function getByPostId(int $postId): array;

    /**
     * Get comments by post ID with flexible options
     *
     * @param mixed $postId
     * @return CommentInterface[]
     */
    public function getByPostIdFlexible($postId): array;

    /**
     * Retrieve comments matching the specified criteria
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return SearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria): SearchResultsInterface;

    /**
     * Delete comment
     *
     * @param CommentInterface $comment
     * @return bool True on success
     * @throws LocalizedException
     */
    public function delete(CommentInterface $comment): bool;

    /**
     * Delete comment by ID
     *
     * @param int $commentId
     * @return bool True on success
     * @throws NoSuchEntityException
     * @throws LocalizedException
     */
    public function deleteById(int $commentId): bool;
}
