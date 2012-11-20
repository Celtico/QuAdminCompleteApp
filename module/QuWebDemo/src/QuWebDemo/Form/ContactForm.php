<?php
/**
 * @Author: Cel Ticó Petit
 * @Contact: cel@cenics.net
 * @Company: Cencis s.c.p.
 */

namespace QuWebDemo\Form;

use Zend\Form\Form;
use Zend\Validator\AbstractValidator;
use Zend\I18n\Translator\Translator;

class ContactForm extends Form
{

    public function __construct($lang)
    {
        parent::__construct();

        $translator = new Translator;
        $translator->addTranslationFile("phparray",'./vendor/ZF2/resources/languages/'.$lang.'/Zend_Validate.php');
        AbstractValidator::setDefaultTranslator($translator);

        $this->add(array(
            'name' => 'nom',
            'type' => 'Zend\Form\Element\Text',
        ));

        $this->add(array(
            'name' => 'from',
            'type' => 'Zend\Form\Element\Text',
        ));

        $this->add(array(
            'name'  => 'subject',
            'type' => 'Zend\Form\Element\Text',
        ));


        $this->add(array(
            'name'  => 'body',
            'type'  => 'Zend\Form\Element\Textarea',
        ));

        $this->add(array(
            'name' => 'Send',
            'type'  => 'Zend\Form\Element\Submit',
            'attributes' => array(
                'value' => 'Enviar',
            ),
        ));
    }

}
