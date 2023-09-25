<?php

use PrestaShop\PrestaShop\Core\Module\WidgetInterface;

if (!defined('_PS_VERSION_')) {
    exit;
}

class footertext extends Module 
{
    public function __construct()
    {
        $this->name = 'footertext';
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

        $this->displayName = $this->l('Custom footer text');
        $this->description = $this->l('Allows users to upload and display footer custom text.');

        $this->confirmUninstall = $this->l('Are you sure you want to uninstall the footertext module?');

    }

    public function install()
    {
        return parent::install() 
        && $this->registerHook('hook_footer_full_width');
    }

    public function uninstall()
    {
        return parent::uninstall() 
        && $this->unregisterHook('hook_footer_full_width') ;   
    }
    
  
    public function hookHook_footer_full_width()
    {

        return $this->fetch('module:footertext/footertext.tpl');

    }
    
}
