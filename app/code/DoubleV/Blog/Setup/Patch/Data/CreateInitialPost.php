<?php
declare(strict_types=1);
/**
 * @copyright Copyright (c) 2025 - Nicolas Morell (https://www.linkedin.com/in/jomorell/)
 * @author      Nicolas Morell <nicolasmorelldev@gmail.com>
 * @category    Fullstack Developer
 * @package     DoubleV_Blog
 * @date        26/09/2025
 */

namespace DoubleV\Blog\Setup\Patch\Data;

use DoubleV\Blog\Api\PostRepositoryInterface;
use DoubleV\Blog\Model\PostFactory;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

/**
 * Data patch for creating initial blog post
 * 
 * This data patch creates a welcome/demo post when the DoubleV Blog module
 * is first installed. It demonstrates the module functionality and provides
 * initial content for testing purposes.
 * 
 * @package DoubleV\Blog\Setup\Patch\Data
 * @author  Nicolas Morell <nicolasmorelldev@gmail.com>
 * @since   1.0.0
 */
class CreateInitialPost implements DataPatchInterface
{
    /**
     * Module data setup interface
     * 
     * @var ModuleDataSetupInterface
     * @since 1.0.0
     */
    private ModuleDataSetupInterface $moduleDataSetup;

    /**
     * Post factory
     * 
     * @var PostFactory
     * @since 1.0.0
     */
    private PostFactory $postFactory;

    /**
     * Post repository
     * 
     * @var PostRepositoryInterface
     * @since 1.0.0
     */
    private PostRepositoryInterface $postRepository;

    /**
     * CreateInitialPost constructor
     * 
     * Initializes the data patch with required dependencies for creating
     * and saving blog posts during module installation.
     * 
     * @param ModuleDataSetupInterface $moduleDataSetup Setup interface for database operations
     * @param PostFactory $postFactory Factory for creating post instances
     * @param PostRepositoryInterface $postRepository Repository for saving posts
     * @since 1.0.0
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        PostFactory $postFactory,
        PostRepositoryInterface $postRepository
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->postFactory = $postFactory;
        $this->postRepository = $postRepository;
    }

    /**
     * Apply the data patch
     * 
     * Creates an initial welcome post with module information and feature overview.
     * The patch is wrapped in a database transaction and includes error handling
     * to prevent installation failures.
     * 
     * @return $this Returns this instance for method chaining
     * @since 1.0.0
     */
    public function apply()
    {
        $this->moduleDataSetup->getConnection()->startSetup();

        try {
            $post = $this->postFactory->create();
            $post->setTitle('Hello World - DoubleV Blog');
            $post->setContent('
                <h2>Welcome to the DoubleV Blog Module!</h2>
                <p>This is an example post created automatically when the module was installed.</p>
                <p>This post demonstrates that the module installation was successful and the database schema is working correctly.</p>
                <h3>Features of this module:</h3>
                <ul>
                    <li>Create and manage blog posts</li>
                    <li>Handle comments for posts</li>
                    <li>REST API endpoints</li>
                    <li>Admin panel integration</li>
                    <li>UI Components with KnockoutJS</li>
                </ul>
                <p>You can edit or delete this post from the admin panel under <strong>Blog > Posts</strong>.</p>
                <p><em>Developed by DoubleV Partners - Full Stack Excellence</em></p>
            ');
            $post->setAuthor('DoubleV Partners');
            $post->setIsActive(true);

            $this->postRepository->save($post);
        } catch (\Exception $e) {
            // Log error but don't fail installation
            error_log('DoubleV Blog: Failed to create initial post - ' . $e->getMessage());
        }

        $this->moduleDataSetup->getConnection()->endSetup();
        
        return $this;
    }

    /**
     * Get patch dependencies
     * 
     * Returns an array of patches that must be applied before this patch.
     * This patch has no dependencies as it creates initial data.
     * 
     * @return array Empty array as this patch has no dependencies
     * @since 1.0.0
     */
    public static function getDependencies(): array
    {
        return [];
    }

    /**
     * Get patch aliases
     * 
     * Returns an array of alternative names for this patch.
     * Used for backward compatibility or patch renaming scenarios.
     * 
     * @return array Empty array as this patch has no aliases
     * @since 1.0.0
     */
    public function getAliases(): array
    {
        return [];
    }

    /**
     * Get patch version
     * 
     * Returns the version number of this data patch. Used by Magento
     * to track which patches have been applied and in what order.
     * 
     * @return string The patch version number
     * @since 1.0.0
     */
    public static function getVersion(): string
    {
        return '1.0.0';
    }
}
