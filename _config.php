<?php

use SilverStripe\ORM\FieldType\DBField;

if (!class_exists("Faker\Generator")) {
    throw new RuntimeException("The silverstripe-mock-dataobjects module requires the Faker PHP library. You can install it by running 'composer require fzaninotto/faker:1.1.*@dev' in your web root. If you installed this module via composer, make the directory fzaninotto/faker exists in vendor/.");
}

define('MOCK_DATAOBJECTS_DIR', basename(dirname(__FILE__)));

DBField::add_extension('MockDBField');

foreach (SS_ClassLoader::instance()->getManifest()->getDescendantsOf(DBField::class) as $class) {
    $mockClass = "Mock{$class}Field";
    if (class_exists($mockClass)) {
        $class::add_extension($mockClass);
    }
}

CMSMenu::remove_menu_item('MockChildrenController');
