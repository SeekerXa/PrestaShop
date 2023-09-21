<?php
if (!defined('_PS_VERSION_')) {
    exit;
}

class customregister extends Module
{
    public function __construct()
    {
        $this->name = 'customregister';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'Patryk Tatar';
        $this->need_instance = 0;

        parent::__construct();

        $this->displayName = $this->l('Custom Register');
        $this->description = $this->l('Displays Register for non-logged in users.');

        $this->ps_versions_compliancy = array('min' => '1.7', 'max' => _PS_VERSION_);
    }

    public function install()
    {
        return parent::install() &&
            $this->registerHook('displayNav2');
    }

    public function uninstall()
    {
        $this->unregisterHook('displayNav2');
        return parent::uninstall();
    }

    public function hookDisplayNav2()
    {
        if ($this->context->customer->isLogged()) {
            $this->context->smarty->assign([
                'customregisterUrl' => $this->context->link->getPageLink('my-account'),
                'customregisterImg' => $this->_path . 'my-account.gif',
                'customregisterText' => $this->l('Moje konto'),
            ]);

            return $this->display(__FILE__, 'customaccount.tpl');

        }else{
            $this->context->smarty->assign([
                'customregisterUrl' => $this->context->link->getPageLink('registration'),
                'customregisterImg' => $this->_path . 'register.png',
                'customregisterText' => $this->l('Rejestracja'),
            ]);

            return $this->display(__FILE__, 'customregister.tpl');
        }
        




    }
}
