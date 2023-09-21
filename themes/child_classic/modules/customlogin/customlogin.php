<?php
if (!defined('_PS_VERSION_')) {
    exit;
}

class customlogin extends Module
{
    public function __construct()
    {
        $this->name = 'customlogin';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'Patryk Tatar';
        $this->need_instance = 0;

        parent::__construct();

        $this->displayName = $this->l('Custom Login');
        $this->description = $this->l('Displays login/logout button and user account link.');

        $this->ps_versions_compliancy = ['min' => '1.7', 'max' => _PS_VERSION_];
    }

    public function install()
    {
        return parent::install() &&
            $this->registerHook('displayNav3');
    }

    public function uninstall()
    {
        $this->unregisterHook('displayNav3');
        return parent::uninstall();
    }

    public function hookDisplayNav3()
    {
        if (!$this->context->customer->isLogged()) {
            $this->context->smarty->assign([
                'customloginUrl' => $this->context->link->getPageLink('authentication'),
                'customloginImg' => $this->_path . 'login.png',
                'customloginText' => $this->l('Logowanie'),  
            ]);

            return $this->display(__FILE__, 'customlogin.tpl');
        
        }else{
            $this->context->smarty->assign([
                'customloginUrl' => $this->context->link->getPageLink('authentication', true, null, 'logout=1'),
                'customloginImg' => $this->_path . 'logout.png',
                'customloginText' => $this->l('Wyloguj'),
            ]);

            return $this->display(__FILE__, 'customlogout.tpl');
        }
    }
}
//getPageLink('authentication', true, null, 'logout=1')
//getPageLink('index', true, null, 'mylogout'),
//getPageLink('my-account',null, null,'Logout'),