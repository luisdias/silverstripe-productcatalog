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
class Category extends DataObject {
    private static $db = array (
        'Title' => 'Varchar',
        'SortOrder' => 'Int'
    );
    
    private static $has_many = array ( 
        'Products' => 'Product'        
    );
    
    private static $summary_fields = array( 
        'Title' => 'Title',
        'SortOrder' => 'Sort Order'
    );
    
    public function fieldLabels($includerelations = true) {
       $labels = parent::fieldLabels($includerelations);
       $labels['Title'] = _t('Category.TITLE','Title');
       $labels['SortOrder'] = _t('Product.SORTORDER','Sort Order');
       return $labels;
     }    

    public function canView($member = null) {
        return Permission::check('CMS_ACCESS_CMSMain', 'any', $member);
    }
    
    public function canEdit($member = null) {
        return Permission::check('CMS_ACCESS_CMSMain', 'any', $member);
    }
    
    public function canDelete($member = null) {
        return Permission::check('CMS_ACCESS_CMSMain', 'any', $member);
    }
    
    public function canCreate($member = null) {
        return Permission::check('CMS_ACCESS_CMSMain', 'any', $member);
    }        
    
    //Return the link to view this category
    public function Link() {
        $Action = 'category/' . $this->ID;
        return $Action;    
    }    
    
    public function getCMSValidator() { 
      return new RequiredFields('Title'); 
    }
    
    public function LinkingMode(){
        $params = Controller::curr()->getURLParams();
        if ( is_numeric($params['OtherID'] )) {
            $categoryID = (int)$params['OtherID'];
        } else {
            $categoryID = (int)$params['ID'];
        }
        return ($this->ID == $categoryID) ? 'pc-current' : 'link';
    }    
}