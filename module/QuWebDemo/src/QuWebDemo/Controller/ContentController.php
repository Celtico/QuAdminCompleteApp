<?php
/**
 * @Author: Cel Ticó Petit
 * @Contact: cel@cenics.net
 * @Company: Cencis s.c.p.
 */

namespace QuWebDemo\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use QuWebDemo\Form\ContactForm;
use QuWebDemo\Form\ContactFilter;

class ContentController extends AbstractActionController
{
    protected $Config;
    protected $QuPHPMailer;
    protected $translator;
    protected $lang;

    /**
     * @return array
     */
    public function actionAction()
    {

        $this->getTranslator()->setLocale($this->lang);
        $this->lang = $this->getEvent()->getRouteMatch()->getParam('lang');

        $url        = $this->params('url');

        $send       = '';
        $form       =  new ContactForm($this->lang);

        if($this->request->isPost())
        {
            $post    = $this->request->getPost();
            $filter  = new ContactFilter();

            $form->setInputFilter($filter);
            $form->setData($post);
            if ($form->isValid())
            {
                $send = $this->sendEmail($form->getData());
            }
            else
            {
                $send = 'error';
            }
        }

        return array(
            'lang'  => $this->lang,
            'url'   => $url,
            'send'  => $send,
            'form'  => $form,
        );
    }

    /**
     * @param array $data
     *
     * @return string
     */
    protected function sendEmail(array $data)
    {
        $this->lang = $this->getEvent()->getRouteMatch()->getParam('lang');
        $this->getTranslator()->setLocale($this->lang);

        $htmlDocType = '
        <!DOCTYPE html>
        <html lang="es">
        <head>
        <meta charset="utf-8">
        <title>QuWebDemo</title>
        </head>
        <body>';
        $htmlMailWeb = '
        <div>'.
            '<h3>'.$this->translator->translate('Gracias').'</h3>'.
            '<h4>'.$this->translator->translate('Missatge').'</h4>'.
            '<p>'
            .$this->translator->translate('Nombre y apellidos').':</span> '.$data['nom'].'<br>'.''
            .$this->translator->translate('E-mail').':</span> '.$data['from'].' <br>'.''
            .$this->translator->translate('Asunto').':</span> '.$data['subject'].'</p>'.
            '<p>'
             .$this->translator->translate('Mensaje').':<br>'.nl2br(stripslashes($data['body'])).'</p>'.

        '</div>';
        $htmlFirm = '
            <div>'.
                '<p><img src="http://'.$_SERVER['HTTP_HOST'].'/img/email.png"></p>
                 <p>'.$this->getConfig()->getConfigValue('QuWebDemo','address').'</p>'.
            '</div>
        </body>
        </html>';

        $bodyHtml = $htmlDocType.$htmlMailWeb.$htmlMailWeb;

        try {

            ///// new mail
            $mail = $this->getQuPHPMailer()->Mail();
            date_default_timezone_set('Europe/Madrid');
            $mail->SetLanguage($this->lang, '/language/');

            ///// server send
            if($this->getConfig()->getConfigValue('QuWebDemo','host') != ''){
                $mail->IsSMTP(); // telling the class to use SMTP
                $mail->SMTPAuth      = true; // enable SMTP authentication
                $mail->SMTPKeepAlive = true; // SMTP connection will not close after each email sent
                $mail->Host          = $this->getConfig()->getConfigValue('QuWebDemo','host'); // sets the SMTP server
                $mail->Username      = $this->getConfig()->getConfigValue('QuWebDemo','username'); // SMTP account username
                $mail->Password      = $this->getConfig()->getConfigValue('QuWebDemo','password'); // SMTP account password
            }

            ///// message
            $mail->CharSet = 'utf-8';
            $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
            $mail->MsgHTML($bodyHtml);

            ////// send mail
            $mail->AddAddress($data['from'], $data['nom']);
            $mail->SetFrom($this->getConfig()->getConfigValue('QuWebDemo','email'),$this->getConfig()->getConfigValue('QuWebDemo','name'));
            $mail->Subject = 'Web' .' '. $this->getConfig()->getConfigValue('QuWebDemo','name') .' '. $data['subject'];
            $mail->Send();

            ////// clean new send
            $mail->ClearAddresses();
            $mail->ClearAttachments();

            ////// send mail copy
            $mail->AddAddress($this->getConfig()->getConfigValue('QuWebDemo','email'),$this->getConfig()->getConfigValue('QuWebDemo','name'));
            $mail->SetFrom($data['from'], $data['nom']);
            $mail->Subject = 'COPY Web' .' '. $this->getConfig()->getConfigValue('QuWebDemo','name') .' '. $data['subject'];
            $mail->Send();

            //////return html
            return $htmlMailWeb;
        }
        catch(phpmailerException $e)
        {
            $e->errorMessage();
        }
        catch(Exception $e)
        {
            $e->getMessage();
        }
    }

    /**
     * @return mixed
     */
    public function getConfig()
    {
        if (!$this->Config) {
            $sm = $this->getServiceLocator();
            $this->Config = $sm->get('cgmconfigadmin');
        }
        return $this->Config;
    }

    /**
     * @return mixed
     */
    public function getTranslator()
    {
        if (!$this->translator){
            $sm = $this->getServiceLocator();
            $this->translator = $sm->get('translator');
        }
        return $this->translator;
    }

    /**
     * @return mixed
     */
    public function getQuPHPMailer()
    {
        if (!$this->QuPHPMailer){
            $sm = $this->getServiceLocator();
            $this->QuPHPMailer = $sm->get('QuPHPMailer');
        }
        return $this->QuPHPMailer;
    }

}
