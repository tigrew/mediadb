<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CategoryController
 *
 * @author ginomazzola
 */
class CategoryController extends Controller{
    
    public function index(){
        $categoryModel = new CategoryDb();
        $this->data['category'] = $categoryModel->findById(1);
        $this->getView("categories");
        
    }
    
    
}
