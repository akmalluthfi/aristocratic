<?php

namespace App\Web;

use App\Web\Social;
use App\Web\HeaderInfo;
use SilverStripe\Forms\FieldList;
use SilverStripe\ORM\DataExtension;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;
use SilverStripe\Forms\LiteralField;
use SilverStripe\Control\Director;

class SiteConfigExtension extends DataExtension
{
    private static $db = [
        'FooterContent' => 'Text'
    ];

    public function updateCMSFields(FieldList $fields)
    {
        // var_dump();
        // die();

        $fields->addFieldToTab(
            'Root.Chat',
            $literal = LiteralField::create('Chat', '<iframe src="layout/chat.html" title="W3Schools Free Online Web Tutorials" style="width:100%; height:450px;border:none;"></iframe>')
        );

        $fields->addFieldToTab('Root.Main', TextareaField::create('FooterContent', 'Content for footer'));

        $fields->addFieldToTab(
            'Root.Header Information',
            GridField::create(
                'HeaderInfo',
                'Header Information',
                HeaderInfo::get(),
                GridFieldConfig_RecordEditor::create()
            )
        );

        $fields->addFieldsToTab('Root.Social', GridField::create(
            'Social',
            'Social Media',
            Social::get(),
            GridFieldConfig_RecordEditor::create()
        ));

        return $fields;
    }

    public function getHeaderInfo()
    {
        return HeaderInfo::get()->limit(3);
    }

    public function getSocial()
    {
        return Social::get()->limit(5);
    }

    public function getSocialById($id)
    {
        return Social::get_by_id($id);
    }

    public function getServicesName()
    {
        return Service::get()->limit(6);
    }

    public function getGallery()
    {
        return Gallery::get()->limit(6);
    }
}
