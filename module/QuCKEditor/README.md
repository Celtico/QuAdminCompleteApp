QuCKEditor
========================

Zf2 module for CKEditor

Requirements
========================
- ZendSkeletonApplication https://github.com/zendframework/ZendSkeletonApplication
- CKEditor http://ckeditor.com/

Installation
========================
- Drag a folder into modules folder or vendor folder
- Download the latest version CKEditor and place in the public folder (you can place in somewhere)
- Enable the module application.config.php and configure the routes module.config.php
- Check the version php


Integration
========================
- Instance $ this-> QuCkEditor () in your project

#Sample

<pre>
<textarea id="editor"></textarea>
<?
    $this->QuCkEditor(
        'editor',
            array('Width' => "100%",
                 'Height' => "340",
                 'toolbar'=> array(
                     array('Source','Maximize'),
                     array('Templates','Styles','Format'),
                     array('Bold','Italic','Underline','Subscript','Superscript'),
                     array('NumberedList','BulletedList','Outdent','Indent'),
                     array('JustifyLeft','JustifyCenter','JustifyRight'),
                     array('Link','Unlink'),
                     array('Image','Table')
                 )
            )
    );
?>
</pre>