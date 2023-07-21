<?php
namespace App;

class CategoryTree{
    
    public $category;
    public $parent;
    public array $categories;
    
        /*
            setting the value of categories array to $this->categories
        */
        public function setCategories($categories)
        {
            $this->categories = $categories;  
        }

        
        public function addCategory(string $category, string $parent = null) : void 
        {
            
            
        /*
            A category that has already been inserted somewhere in the CategoryTree 
            should cause an InvalidArgumentException to be thrown. 
        */
            if(! is_null($parent))   // select all non null parents or non root parent 
             { 
                if(! in_array($parent, array_column($this->categories, 'name')))  // check if parent exists in columrn name of categories array
                {
                   throw new \InvalidArgumentException('The Specified Parent doesnt exists');
                }
             }

        /* 
        An InvalidArgumentException should also be thrown if a parent is specified that does not exist.
        */
        
             if(in_array($category, array_column($this->categories, 'name')))
             {
                 throw new \InvalidArgumentException('Caterory name already exists'); 
             }
            
            // insert category name and parent into categories array
            $this->categories[] = [  
                                    'name' => $category, 
                                     'parent' => $parent 
             ];            
        }

        /*
            Children of a category A are categories that has catgorie A set as their parent 
        */
        public function getChildren(string $parent): array 
        {
            $children = []; 
            foreach($this->categories as $datum){
                if($datum['parent'] === $parent) // check if parent exist in category array  
                {
                    $children[] = $datum['name'];
                }
            }
            return $children;  /// display category name of selected parent
        }

}

$category_tree =  new CategoryTree();
$category_tree->addCategory('A', NULL);
$category_tree->addCategory('B', 'A');
$category_tree->addCategory('C', 'A');
$category_tree->addCategory('D', 'C');
$category_tree->addCategory('E', 'C');
$category_tree->addCategory('F', 'C');
$category_tree->addCategory('G', 'C');
$category_tree->addCategory('X', NULL);
$category_tree->addCategory('Y', 'X');
$category_tree->addCategory('Z1', 'Y');
$category_tree->addCategory('Z2', 'Y');
//$category_tree->addCategory(new Category('Z2', 'A')); // InvalidArgumentException
// $category_tree->addCategory(new Category('W', 'V')); // InvalidArgumentException
echo implode(',', $category_tree->getChildren('A')) . PHP_EOL; //B,C
echo implode(',', $category_tree->getChildren('C')) . PHP_EOL; //D,E,F,G
echo implode(',', $category_tree->getChildren('Y')) . PHP_EOL; //Z1,Z2
