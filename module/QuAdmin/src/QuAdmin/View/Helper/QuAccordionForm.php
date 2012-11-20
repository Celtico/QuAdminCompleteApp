<?php
/**
 * @Changes: Cel Ticó Petit
 * @Contact: cel@cenics.net
 * @Company: Cencis s.c.p.
 *
 * CgmConfigAdmin
 *
 * @link      http://github.com/cgmartin/CgmConfigAdmin for the canonical source repository
 * @copyright Copyright (c) 2012 Christopher Martin (http://cgmartin.com)
 * @license   New BSD License https://raw.github.com/cgmartin/CgmConfigAdmin/master/LICENSE
 */
namespace QuAdmin\View\Helper;

use CgmConfigAdmin\Form\ConfigOptionsForm;
use Zend\View\Helper\AbstractHelper;
use Zend\InputFilter\InputFilter;
use Zend\Form\FieldsetInterface;
use Zend\Form\ElementInterface;
use Zend\Form\Element\Radio as RadioElement;
use Zend\Form\Element\MultiCheckbox as MultiCheckboxElement;

class QuAccordionForm extends AbstractHelper
{
    /**
     * @param \CgmConfigAdmin\Form\ConfigOptionsForm $form
     *
     * @return QuAccordionForm|string
     */
    public function __invoke(ConfigOptionsForm $form = null)
    {
        if (!$form) {
            return $this;
        }
        return $this->render($form);
    }

    /**
     * @param \CgmConfigAdmin\Form\ConfigOptionsForm $form
     *
     * @return string
     */
    public function render(ConfigOptionsForm $form)
    {
        $formHelper    = $this->view->plugin('form');
        $elementHelper = $this->view->plugin('formelement');
        $errorsHelper  = $this->view->plugin('formelementerrors');
        $output =
                $formHelper()->openTag($form).
                $elementHelper($form->get('csrf')).
                $errorsHelper ($form->get('csrf')).
                '
        <div class="fluid">
            <div class="widget togglesGroup">'
                ;

        foreach ($form->getFieldsets() as $fieldset) {

            if ($form->getNumFieldsets() > 1) {
                $output .= $this->renderSectionHeader($fieldset);
            }

            $output .= '
            <div class="formRow">
            ';
            $cont = 0;
            foreach ($fieldset as $element) {
            $cont++;
                $output .= $this->renderConfigOption($element);
                if($cont == 2){
                   $cont = 0;
                   $output .= '
                   <div class="clear"></div>
                   </div>
                   <div class="formRow">
                   ';
                }
            }
            $output .= '
            <div class="clear"></div>
            </div>
            ';

            if ($form->getNumFieldsets() > 1) {
                $output .= $this->renderSectionFooter($fieldset);
            }
        }

        $output .= $this->renderButtons($form).
                   $formHelper()->closeTag();

        return $output;
    }

    /**
     * @param \Zend\Form\FieldsetInterface $fieldset
     *
     * @return string
     */
    public function renderSectionHeader(FieldsetInterface $fieldset)
    {
        $escapeHelper    = $this->view->plugin('escapehtml');
        $translateHelper = $this->view->plugin('translate');
        // <div class="whead opened inactive hand closed normal">
        $output = '
        <div class="whead hand closed normal">
            <h6>'
            .$escapeHelper($translateHelper($fieldset->getLabel())).
            '</h6>
            <div class="clear"></div>
        </div>

        <div>
        ';

        return $output;
    }

    /**
     * @param \Zend\Form\ElementInterface $element
     *
     * @return string
     */
    public function renderConfigOption(ElementInterface $element)
    {
        $labelHelper   = $this->view->plugin('formlabel');
        $elementHelper = $this->view->plugin('formelement');
        $errorsHelper  = $this->view->plugin('formelementerrors');

        $errors = $element->getMessages();
        $errorClass = (!empty($errors)) ? ' error' : '';

        $output = '
        <div class="grid1">
        '.$labelHelper($element->setLabelAttributes(array())).'
        </div>
        <div class="grid5  on_off">
            ';
                $labelAttributes = array();
                if ($element instanceof RadioElement) {
                    $labelAttributes = array('class' => 'floatL mr20');
                } elseif ($element instanceof MultiCheckboxElement) {
                    $labelAttributes = array('class' => 'floatL mr20');
                }
        $output .=
            $elementHelper($element->setLabelAttributes($labelAttributes)).'
            <label generated="true" class="error">
            '.$errorsHelper($element).'
            </label>
        </div>
        ';

        return $output;
    }

    /**
     * @param \Zend\Form\FieldsetInterface $fieldset
     *
     * @return string
     */
    public function renderSectionFooter(FieldsetInterface $fieldset)
    {
        return '</div>';
    }

    /**
     * @param \CgmConfigAdmin\Form\ConfigOptionsForm $form
     *
     * @return string
     */
    public function renderButtons(ConfigOptionsForm $form)
    {
        $elementHelper = $this->view->plugin('formelement');
        $output = '
       <div class="formRow" style="padding:0;">
        </div>
        <div class="formRow">
                '.$elementHelper($form->get('save')->setAttribute('class', 'buttonL bBlue')).'
                <div class="clear"></div>
            </div>
        </div>
        ';
        return $output;
    }
}
