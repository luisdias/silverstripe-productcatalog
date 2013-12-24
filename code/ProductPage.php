<?php
/*
MIT License

Copyright (c) 2013 Luis E. S. Dias - smartbyte.systems@gmail.com

Permission is hereby granted, free of charge, to any person obtaining
a copy of this software and associated documentation files (the
"Software"), to deal in the Software without restriction, including
without limitation the rights to use, copy, modify, merge, publish,
distribute, sublicense, and/or sell copies of the Software, and to
permit persons to whom the Software is furnished to do so, subject to
the following conditions:

The above copyright notice and this permission notice shall be
included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/
class ProductPage extends Page 
{
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();        
        return $fields;
    }
}
 
class ProductPage_Controller extends Page_Controller
{
    
    //Allow our 'show' and 'category' functions as a URL actions
    private static $allowed_actions = array(
        'show','category'
    );
    
    public function init() {
        parent::init();
        Requirements::css('productcatalog/css/productcatalog.css');
    }    
    
    // show one product 
    public function show() {       
        $params = $this->getURLParams();
        if(is_numeric($params['ID']) && 
            $product = Product::get()->byID((int)$params['ID'])) {
            $data = array(
                'Product' => $product
            );             
            return $this->Customise($data);    
        } 
    }

    // show all products of one category
    public function category() {       
        $params = $this->getURLParams();
        if(is_numeric($params['ID']) &&  
            $products = Product::get()->filter(array('CategoryID'=>(int)$params['ID'],'Hidden'=>false))) {
            $data = array(
                'Products' => $products
            );             
            return $this->Customise($data);            
           }             
    }
    
    public function Categories() {
        $categories = Category::get()->sort('SortOrder');
        return $categories;
    }

}