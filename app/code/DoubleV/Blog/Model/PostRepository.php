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
use DoubleV\Blog\Api\PostRepositoryInterface;
use DoubleV\Blog\Model\ResourceModel\Post as PostResource;
use DoubleV\Blog\Model\ResourceModel\Post\CollectionFactory;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResultsInterface;
use Magento\Framework\Api\SearchResultsInterfaceFactory;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotDeleteException;

/**
 * Post repository class
 * 
 * Handles CRUD operations for blog posts. Implements the repository pattern
 * to provide a clean interface for post data operations and abstracts
 * database interactions through the resource model.
 * 
 * @package DoubleV\Blog\Model
 * @author  Nicolas Morell <nicolasmorelldev@gmail.com>
 * @since   1.0.0
 */
class PostRepository implements PostRepositoryInterface
{
    /**
     * Post resource model
     * 
     * @var PostResource
     * @since 1.0.0
     */
    protected PostResource $resource;

    /**
     * Post factory
     * 
     * @var PostFactory
     * @since 1.0.0
     */
    protected PostFactory $postFactory;

    /**
     * Post collection factory
     * 
     * @var CollectionFactory
     * @since 1.0.0
     */
    protected CollectionFactory $postCollectionFactory;

    /**
     * Search results factory
     * 
     * @var SearchResultsInterfaceFactory
     * @since 1.0.0
     */
    protected SearchResultsInterfaceFactory $searchResultsFactory;

    /**
     * PostRepository constructor
     * 
     * Initializes the repository with required dependencies for handling
     * post operations including resource model, factory, and collection factory.
     * 
     * @param PostResource $resource Post resource model for database operations
     * @param PostFactory $postFactory Factory for creating post instances
     * @param CollectionFactory $postCollectionFactory Factory for post collections
     * @param SearchResultsInterfaceFactory $searchResultsFactory Factory for search results
     * @since 1.0.0
     */
    public function __construct(
        PostResource $resource,
        PostFactory $postFactory,
        CollectionFactory $postCollectionFactory,
        SearchResultsInterfaceFactory $searchResultsFactory
    ) {
        $this->resource = $resource;
        $this->postFactory = $postFactory;
        $this->postCollectionFactory = $postCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
    }

    /**
     * Save a post
     * 
     * Persists a post entity to the database. Handles both create and update
     * operations based on whether the post has an ID.
     * 
     * @param PostInterface $post The post entity to save
     * @return PostInterface The saved post entity
     * @throws CouldNotSaveException If the post could not be saved
     * @since 1.0.0
     */
    public function save(PostInterface $post): PostInterface
    {
        try {
            $this->resource->save($post);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }
        return $post;
    }

    /**
     * Get post by ID
     * 
     * Retrieves a post entity from the database using its unique identifier.
     * 
     * @param int $postId The post ID to retrieve
     * @return PostInterface The requested post entity
     * @throws NoSuchEntityException If no post exists with the given ID
     * @since 1.0.0
     */
    public function getById(int $postId): PostInterface
    {
        $post = $this->postFactory->create();
        $this->resource->load($post, $postId);
        if (!$post->getPostId()) {
            throw new NoSuchEntityException(__('Post with id "%1" does not exist.', $postId));
        }
        return $post;
    }

    /**
     * Get post by ID with flexible type handling
     * 
     * Convenience method that accepts mixed type input and casts it to integer
     * before retrieving the post. Useful for handling form data or API requests
     * where the ID might come as a string.
     * 
     * @param mixed $postId The post ID to retrieve (will be cast to int)
     * @return PostInterface The requested post entity
     * @throws NoSuchEntityException If no post exists with the given ID
     * @since 1.0.0
     */
    public function getByIdFlexible($postId): PostInterface
    {
        $postId = (int)$postId;
        return $this->getById($postId);
    }

    /**
     * Get list of posts based on search criteria
     * 
     * Retrieves a filtered and paginated list of posts based on the provided
     * search criteria. Returns search results with metadata including total count.
     * 
     * @param SearchCriteriaInterface $searchCriteria Criteria for filtering and pagination
     * @return SearchResultsInterface Search results containing posts and metadata
     * @since 1.0.0
     */
    public function getList(SearchCriteriaInterface $searchCriteria): SearchResultsInterface
    {
        $collection = $this->postCollectionFactory->create();
        
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setTotalCount($collection->getSize());
        $searchResults->setItems($collection->getItems());

        return $searchResults;
    }

    /**
     * Delete a post
     * 
     * Removes a post entity from the database permanently.
     * 
     * @param PostInterface $post The post entity to delete
     * @return bool True if the post was successfully deleted
     * @throws CouldNotDeleteException If the post could not be deleted
     * @since 1.0.0
     */
    public function delete(PostInterface $post): bool
    {
        try {
            $this->resource->delete($post);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }
        return true;
    }

    /**
     * Delete post by ID
     * 
     * Convenience method to delete a post by its ID. First retrieves the post
     * entity and then deletes it.
     * 
     * @param int $postId The ID of the post to delete
     * @return bool True if the post was successfully deleted
     * @throws NoSuchEntityException If no post exists with the given ID
     * @throws CouldNotDeleteException If the post could not be deleted
     * @since 1.0.0
     */
    public function deleteById(int $postId): bool
    {
        return $this->delete($this->getById($postId));
    }

    /**
     * Delete post by ID with flexible type handling
     * 
     * Convenience method that accepts mixed type input and casts it to integer
     * before deleting the post. Useful for handling form data or API requests
     * where the ID might come as a string.
     * 
     * @param mixed $postId The ID of the post to delete (will be cast to int)
     * @return bool True if the post was successfully deleted
     * @throws NoSuchEntityException If no post exists with the given ID
     * @throws CouldNotDeleteException If the post could not be deleted
     * @since 1.0.0
     */
    public function deleteByIdFlexible($postId): bool
    {
        $postId = (int)$postId;
        return $this->deleteById($postId);
    }
}
