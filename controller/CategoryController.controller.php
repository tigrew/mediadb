<?php
/**
 * Description of CategoryController
 *
 * @author ginomazzola
 */
class CategoryController extends Controller{
    /**
     * 
     */
    public function index(){
        $categoryModel = new CategoryDb();
        $this->data['category'] = $categoryModel->findById(1);
        $this->getView("categories");
        
    }
    
    
}
