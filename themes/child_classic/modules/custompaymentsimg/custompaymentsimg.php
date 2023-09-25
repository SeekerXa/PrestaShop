<?php

use PrestaShop\PrestaShop\Core\Module\WidgetInterface;

if (!defined('_PS_VERSION_')) {
    exit;
}

class custompaymentsimg extends Module 
{
    public function __construct()
    {
        $this->name = 'custompaymentsimg';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'Patryk Tatar';
        $this->need_instance = 0;
        $this->ps_versions_compliancy = [
            'min' => '1.7',
            'max' => _PS_VERSION_,
        ];
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Custom payments img in footer');
        $this->description = $this->l('Allows users to upload and display footer payments img.');

        $this->confirmUninstall = $this->l('Are you sure you want to uninstall the custompaymentsimg module?');

    }

    public function install()
    {
        return parent::install() 
        && $this->registerHook('hook_footer_full_width_affter');
    }

    public function uninstall()
    {
        return parent::uninstall() 
        && $this->unregisterHook('hook_footer_full_width_affter') ;   
    }
    
  
    public function hookHook_footer_full_width_affter()
    {

        return $this->fetch('module:custompaymentsimg/custompaymentsimg.tpl');

    }
    
}
