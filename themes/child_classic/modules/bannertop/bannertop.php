<?php
if (!defined('_PS_VERSION_')) {
    exit;
}

if (version_compare(_PS_VERSION_, '1.7', '<')) {
    // Twój moduł jest zgodny tylko z PrestaShop 1.7 i nowszymi wersjami
    exit;
}

class bannertop extends Module
{
    public function __construct()
    {
        $this->name = 'bannertop';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'Patryk Tatar';
        $this->need_instance = 0;

        parent::__construct();

        $this->displayName = $this->l('Banner Top');
        $this->description = $this->l('Display a top banner with configurable options.');

        $this->confirmUninstall = $this->l('Are you sure you want to uninstall the Banner Top module?');
    }
    public function install()
    {
        if (
            !parent::install()
            || !$this->registerHook('displayBanner')
        ) {
            return false;
        }

        return true;
    }

    public function uninstall()
    {
        if (
            !parent::uninstall()
            || !$this->unregisterHook('displayBanner')
        ){
            return false;
        }

        Configuration::deleteByName('BANNERTOP_BACKGROUND_COLOR');
        Configuration::deleteByName('BANNERTOP_TEXT_COLOR');
        Configuration::deleteByName('BANNERTOP_HEIGHT');
        Configuration::deleteByName('BANNERTOP_CLOSE_BUTTON_COLOR');
        Configuration::deleteByName('BANNERTOP_TEXT');

        return true;
    }

    public function getContent()
{
    $output = null;

    if (Tools::isSubmit('submit'.$this->name)) {
        $backgroundColor = Tools::getValue('BANNERTOP_BACKGROUND_COLOR');
        $height = Tools::getValue('BANNERTOP_HEIGHT');
        $closeButtonColor = Tools::getValue('BANNERTOP_CLOSE_BUTTON_COLOR');
        $text = Tools::getValue('BANNERTOP_TEXT'); // Nowe pole tekstowe

        Configuration::updateValue('BANNERTOP_BACKGROUND_COLOR', $backgroundColor);
        Configuration::updateValue('BANNERTOP_HEIGHT', $height);
        Configuration::updateValue('BANNERTOP_CLOSE_BUTTON_COLOR', $closeButtonColor);
        Configuration::updateValue('BANNERTOP_TEXT', $text, true); // Zapisz wprowadzony tekst
        $output .= $this->displayConfirmation($this->l('Settings updated'));
    }

    return $output.$this->displayForm();
}

public function displayForm()
{
    $fieldsForm = [
        'form' => [
            'legend' => [
                'title' => $this->l('Banner Top Settings'),
            ],
            'input' => [
                [
                    'type' => 'color',
                    'label' => $this->l('Background Color'),
                    'name' => 'BANNERTOP_BACKGROUND_COLOR',
                ],
                [
                
                    'type' => 'text',
                    'label' => $this->l('Height (px)'),
                    'name' => 'BANNERTOP_HEIGHT',
                ],
                [
                    'type' => 'color',
                    'label' => $this->l('Close Button Color'),
                    'name' => 'BANNERTOP_CLOSE_BUTTON_COLOR',
                ],
                [
                    'type' => 'textarea',
                    'label' => $this->l('Text:'),
                    'name' => 'BANNERTOP_TEXT',
                    'cols' => 100,
                    'rows'  => 3,
                   'autoload_rte' => true,
                ],
            ],
            'submit' => [
                'title' => $this->l('Save'),
                'name' => 'submit'.$this->name,
            ],
        ],
    ];

    

    $helper = new HelperForm();
    $helper->module = $this;
    $helper->name_controller = $this->name;
    $helper->token = Tools::getAdminTokenLite('AdminModules');
    $helper->currentIndex = AdminController::$currentIndex.'&configure='.$this->name;
    $helper->default_form_language = (int) Configuration::get('PS_LANG_DEFAULT');
    $helper->allow_employee_form_lang = (int) Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG');
    $helper->title = $this->displayName;
    $helper->show_toolbar = true;
    $helper->toolbar_scroll = true;
    $helper->submit_action = 'submit'.$this->name;
    $helper->toolbar_btn = [
        'save' => [
            'desc' => $this->l('Save'),
            'href' => AdminController::$currentIndex.'&configure='.$this->name.'&save'.$this->name.
            '&token='.Tools::getAdminTokenLite('AdminModules'),
        ],
        'back' => [
            'href' => AdminController::$currentIndex.'&token='.Tools::getAdminTokenLite('AdminModules'),
            'desc' => $this->l('Back to list'),
        ],
    ];

    $helper->fields_value['BANNERTOP_BACKGROUND_COLOR'] = Configuration::get('BANNERTOP_BACKGROUND_COLOR');
    $helper->fields_value['BANNERTOP_TEXT_COLOR'] = Configuration::get('BANNERTOP_TEXT_COLOR');
    $helper->fields_value['BANNERTOP_HEIGHT'] = Configuration::get('BANNERTOP_HEIGHT');
    $helper->fields_value['BANNERTOP_CLOSE_BUTTON_COLOR'] = Configuration::get('BANNERTOP_CLOSE_BUTTON_COLOR');
    $helper->fields_value['BANNERTOP_TEXT'] = Configuration::get('BANNERTOP_TEXT'); // Wartość pola tekstowego

   
    return $helper->generateForm([$fieldsForm]);
}

    public function hookDisplayBanner($params)
    {
        $text = Configuration::get('BANNERTOP_TEXT');
        $backgroundColor = Configuration::get('BANNERTOP_BACKGROUND_COLOR');
        $height = Configuration::get('BANNERTOP_HEIGHT');
        $closeButtonColor = Configuration::get('BANNERTOP_CLOSE_BUTTON_COLOR');

    
        $this->context->smarty->assign([
            'text' => $text,
            'backgroundColor' => $backgroundColor,
            'height' => $height,
            'closeButtonColor' => $closeButtonColor,
        ]);

        
        return $this->display(__FILE__, 'bannertop.tpl');
        
    }
}

