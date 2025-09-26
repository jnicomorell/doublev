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
use DoubleV\Blog\Api\CommentRepositoryInterface;
use DoubleV\Blog\Model\ResourceModel\Comment as CommentResource;
use DoubleV\Blog\Model\ResourceModel\Comment\CollectionFactory;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResultsInterface;
use Magento\Framework\Api\SearchResultsInterfaceFactory;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotDeleteException;

/**
 * Class CommentRepository
 * Repository class for managing blog comments
 */
class CommentRepository implements CommentRepositoryInterface
{
    protected CommentResource $resource;
    protected CommentFactory $commentFactory;
    protected CollectionFactory $commentCollectionFactory;
    protected SearchResultsInterfaceFactory $searchResultsFactory;

    /**
     * CommentRepository constructor
     *
     * @param CommentResource $resource
     * @param CommentFactory $commentFactory
     * @param CollectionFactory $commentCollectionFactory
     * @param SearchResultsInterfaceFactory $searchResultsFactory
     */
    public function __construct(
        CommentResource $resource,
        CommentFactory $commentFactory,
        CollectionFactory $commentCollectionFactory,
        SearchResultsInterfaceFactory $searchResultsFactory
    ) {
        $this->resource = $resource;
        $this->commentFactory = $commentFactory;
        $this->commentCollectionFactory = $commentCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
    }

    /**
     * Save comment
     *
     * @param CommentInterface $comment
     * @return CommentInterface
     * @throws CouldNotSaveException
     */
    public function save(CommentInterface $comment): CommentInterface
    {
        try {
            $this->resource->save($comment);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }
        return $comment;
    }

    /**
     * Get comment by ID
     *
     * @param int $commentId
     * @return CommentInterface
     * @throws NoSuchEntityException
     */
    public function getById(int $commentId): CommentInterface
    {
        $comment = $this->commentFactory->create();
        $this->resource->load($comment, $commentId);
        if (!$comment->getCommentId()) {
            throw new NoSuchEntityException(__('Comment with id "%1" does not exist.', $commentId));
        }
        return $comment;
    }

    /**
     * Get comments by post ID
     *
     * @param int $postId
     * @return array
     */
    public function getByPostId(int $postId): array
    {
        $collection = $this->commentCollectionFactory->create();
        $collection->addFieldToFilter('post_id', $postId);
        return $collection->getItems();
    }

    /**
     * Get comments by post ID with flexible type handling
     *
     * @param mixed $postId
     * @return array
     */
    public function getByPostIdFlexible($postId): array
    {
        $postId = (int)$postId;
        return $this->getByPostId($postId);
    }

    /**
     * Get list of comments based on search criteria
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return SearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria): SearchResultsInterface
    {
        $collection = $this->commentCollectionFactory->create();
        
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setTotalCount($collection->getSize());
        $searchResults->setItems($collection->getItems());

        return $searchResults;
    }

    /**
     * Delete comment
     *
     * @param CommentInterface $comment
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function delete(CommentInterface $comment): bool
    {
        try {
            $this->resource->delete($comment);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }
        return true;
    }

    /**
     * Delete comment by ID
     *
     * @param int $commentId
     * @return bool
     * @throws NoSuchEntityException
     * @throws CouldNotDeleteException
     */
    public function deleteById(int $commentId): bool
    {
        return $this->delete($this->getById($commentId));
    }
}
