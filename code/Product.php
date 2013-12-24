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
class Product extends DataObject {
    private static $db = array (
        'InternalItemId' => 'Varchar',
        'Title' => 'Varchar',
        'Model' => 'Varchar',
        'Manufacturer' => 'Varchar',
        'Price' => 'Currency(8,2)',
        'Description' => 'HTMLText',
        'SortOrder' => 'Int',
        'FeaturedProduct' => 'Boolean',
        'Hidden' => 'Boolean',
        'URLSegment' => 'Varchar(255)'
    );
    
    private static $has_one = array ( 
        'Category' => 'Category',        
        'Photo' => 'Image'
    );
    
    private static $has_many = array(
        'AdditionalPhotos' => 'Image'
    );    

    private static $summary_fields = array(
        'Thumbnail' => 'Thumbnail',
        'InternalItemId' => 'InternalItemId',
        'Title' => 'Title',
        'Price' => 'Price'        
    );    

    public function fieldLabels($includerelations = true) {
       $labels = parent::fieldLabels($includerelations);
       $labels['Thumbnail'] = _t('Product.THUMBNAIL','Thumbnail');
       $labels['InternalItemId'] = _t('Product.INTERNALITEMID','Internal Item Id');
       $labels['Title'] = _t('Product.TITLE','Title');
       $labels['Price'] = _t('Product.PRICE','Price');
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
    
    public function getCMSFields() {      
        $fields = parent::getCMSFields();
        $description = HtmlEditorField::create('Description','Description')->setRows(10);
        $price = CurrencyField::create('Price','Price');
        $category = DropdownField::create('CategoryID','Category', Category::get()->map('ID', 'Title'));
        $photo = UploadField::create('Photo','Photo')->setFolderName('Products');
        $fields->replaceField('Description', $description);
        $fields->replaceField('Price', $price);
        $fields->replaceField('Photo', $photo);
        $fields->removeByName('CategoryID');
        $fields->insertAfter($category,'InternalItemId');       
        
        $fields->addFieldToTab(
                'Root.AdditionalPhotos', 
                UploadField::create('AdditionalPhotos','AdditionalPhotos')->setFolderName('Products')
                );        
        
        $fields->renameField('InternalItemId',_t('Product.INTERNALITEMID','Internal Item Id'));
        $fields->renameField('Title',_t('Product.TITLE','Title'));
        $fields->renameField('CategoryID',_t('Product.CATEGORY','Category'));
        $fields->renameField('URLSegment',_t('Product.URLSEGMENT','Url Segment'));
        $fields->renameField('Model',_t('Product.MODEL','Model'));
        $fields->renameField('Manufacturer',_t('Product.MANUFACTURER','Manufacturer'));
        $fields->renameField('Price',_t('Product.PRICE','Price'));
        $fields->renameField('Description',_t('Product.DESCRIPTION','Description'));
        $fields->renameField('SortOrder',_t('Product.SORTORDER','Sort Order'));
        $fields->renameField('FeaturedProduct',_t('Product.FEATUREDPRODUCT','Featured Product'));
        $fields->renameField('Hidden',_t('Product.HIDDEN','Hidden'));
        $fields->renameField('Photo',_t('Product.PHOTO','Photo'));
        $fields->renameField('AdditionalPhotos',_t('Product.ADDITIONALPHOTOS','Additional Photos'));
        
        return $fields;
    }
    
    public function getThumbnail()
    {
        if($this->PhotoID)
            return $this->Photo()->CMSThumbnail();
        else  
            return '<img src="productcatalog/images/no-image-available-th.png" width="100" height="100" />';
    }

    public function getPhoto()
    {
        if($this->PhotoID)
            return $this->Photo()->setWidth(300)->setHeight(300);
        else  
            return '<img src="productcatalog/images/no-image-available-th.png" width="300" height="300" />';
    }    
    
    //Add an SQL index for the URLSegment
    static $indexes = array(
        "URLSegment" => true
    );        
    
    //Return the link to view this category
    public function Link() {
        $Action = 'show/' . $this->ID;
        return $Action;    
    }       
    
    public function getCMSValidator() { 
      return new RequiredFields('Title'); 
    }    
}