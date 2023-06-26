<?php

// namespace App;

use App\CategoryTree;
use PHPUnit\Framework\TestCase;

class CategoryTest extends TestCase{


    /*
       test to check if a category name and parent can be aded to the category tree
    */ 
    public function testAddCategory()
    {
        $categoryTree =  new CategoryTree; 
        $newCategory = $categoryTree->addCategory('aa', 'kk');
        $this->assertNull($newCategory);
        $this->assertNull($newCategory);
    }
    


    /*
        test to check duplicate name invalid argument exception
    */ 
    public function testDuplicateCategoryException()
    {
        $categoryTree =  new CategoryTree();
        $newCategoryOne = $categoryTree->addCategory('AS', 'AB'); // adding a new category name AS
        $this->assertNull($newCategoryOne);
        $newCategoryTwo = $categoryTree->addCategory('AS', 'AB'); // adding a duplicate category name AS
        $this->assertNull($newCategoryTwo);
        // Please Note this Test is expected to fail or throw an InvalidArgument Exception error
    }


    /*
       test to check if parent exist in the category tree name         
    */ 
    public function testParentExistException()
    {
        $categoryTree =  new CategoryTree();
        $newCategoryOne = $categoryTree->addCategory('K', 'ML'); // adding a new category name and parent to category tree
        $this->assertNull($newCategoryOne);
        $newCategoryTwo = $categoryTree->addCategory('XO', 'LL'); // adding a parent that doest exist to category tree
        $this->assertNull($newCategoryTwo);
         // Please Note this Test is expected to fail or throw an InvalidArgument Exception error
    }


    /*  
       a test to check if function getChildren returns an array.
    */
    public function testGetChildren()
    {
        $categoryTree =  new CategoryTree();
        $categoryTree->addCategory('K', 'L');
        // using assertions to check if an array is returned
        $this->assertIsArray($categoryTree->getChildren('L'),  "This function doesnt return an array" );  
    }
    
}
