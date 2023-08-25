<?php
require '../vendor/autoload.php';
use Models\Category\CategoryModel;
use Models\Subcategory\SubcategoryModel;

use function Helpers\dd;
use function Helpers\redirect;
use function Helpers\generateUrl;

class CategoryController
{

    public function consultCateogries(){
        $objCategory= new CategoryModel();
        $categories=$objCategory->consultCategories();
        $objSubcategory=new SubcategoryModel();
        foreach ($categories as &$cat) {
            $subcategories = $objSubcategory->consultSubcategoriesByCategory($cat['cat_id']);
            $cat['subcategories'] = $subcategories;
        }
        
        include_once '../app/Views/category/categoryConsult.php';
    }
    public function createSubcategoryModal(){
        $objCategory= new CategoryModel();
        $cat_id=$_POST['id'];
        $category=$objCategory->consultCategoryById($cat_id); 
        include_once '../app/Views/category/stockModalCreateSubcategory.php';
    }
    public function insertSubcategory(){
        $name=$_POST['subcat_name'];
        $desc=$_POST['subcat_desc'];
        $cat_id=$_POST['cat_id'];
        $objSubcategory=new SubcategoryModel();
        $objSubcategory->insertSubcategroy($name,$desc,$cat_id);
        redirect(generateUrl("Category","Category","consultCateogries"));
    }

}






?>