<?php

if (!defined('_PS_VERSION_')) {
    exit;
}

class customcart extends Module
{
    public function __construct()
    {
        $this->name = 'customcart';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'Patryk Tatar ';

        parent::__construct();

        $this->displayName = $this->l('Koszyk');
        $this->description = $this->l('Moduł do wyświetlania koszyka z ilością produktów.');
    }

    public function install()
    {
        if (!parent::install() || !$this->registerHook('displayNav4')) {
            return false;
        }
        return true;
    }
    public function uninstall()
    {
        if (!parent::uninstall() ||
            !$this->unregisterHook('displayNav4')
        ) {
            return false;
        }

        return true;
    }

    public function hookDisplayNav4($params)
    {

        // Pobierz ilość produktów w koszyku
        $cart = $this->context->cart;
        $cartQuantity = $cart->nbProducts();

        // Wygeneruj link do koszyka
        $cartLink = $this->context->link->getPageLink('cart');

        $this->context->smarty->assign(array(
            'cartLink' => $cartLink,
            'cartQuantity' => $cartQuantity,
            'customcartImg' => $this->_path . 'cart.png',
            'customcartText' => $this->l('Koszyk'),
        ));

        return $this->display(__FILE__, 'customcart.tpl');
    }
}