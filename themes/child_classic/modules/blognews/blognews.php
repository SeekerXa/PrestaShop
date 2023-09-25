<?php

use PrestaShop\PrestaShop\Core\Module\WidgetInterface;

if (!defined('_PS_VERSION_')) {
    exit;
}

class blognews extends Module implements WidgetInterface
{
    public function __construct()
    {
        $this->name = 'blognews';
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

        $this->displayName = $this->l('Custom blog views');
        $this->description = $this->l('Allows users to upload and display custom blog views.');

        $this->confirmUninstall = $this->l('Are you sure you want to uninstall the blognews module?');

    }

    public function install()
    {
        return parent::install() 
        && $this->registerHook('displayHome');
    }

    public function uninstall()
    {
        return parent::uninstall() 
        && $this->unregisterHook('displayHome') ;   
    }
    
    public function getWidgetVariables($hookName, array $params)
    {
        $widgetVariables = array();

        if ($hookName === 'displayHome') {
            // Tutaj możesz przygotować dane, które zostaną wykorzystane w szablonie widgetu
            $widgetVariables['widgetData'] = $this->getWidgetData();
        }

        return $widgetVariables;
    }

    public function hookDisplayWidget($params)
    {
        // Przykładowa logika pobierania danych
        $widgetData = $this->getWidgetData();

        // Przykładowy kod wyświetlający widget
        $this->smarty->assign('widgetData', $widgetData);
        return $this->display(__FILE__, 'blognews.tpl');
    }
    private function getWidgetData()
    {
        // Tutaj możesz pobrać dane potrzebne do widgetu, na przykład z bazy danych
        $widgetData = array();

        // Przykładowe pobieranie danych
        // $widgetData = array('title' => 'Najnowsze produkty', 'products' => $latestProducts);

        return $widgetData;
    }   
        /**
     * Implementacja funkcji renderWidget z interfejsu WidgetInterface.
     *
     * @param array $widgetVariables Tablica zmiennych przekazanych do szablonu.
     * @return string HTML widgetu.
     */
    public function renderWidget($hookName, array $configuration)
    {
        // Tutaj możesz użyć zmiennych z tablicy $configuration do wygenerowania treści widgetu
        // Wartość hookName wciąż jest przekazywana, ale jako osobny argument
        // $configuration zawiera inne dane konfiguracyjne, które mogą być użyte do renderowania

        // Przykład użycia hookName
        if ($hookName === 'displayHome') {
            // Przykładowa logika, która korzysta z $configuration
            $widgetData = $configuration;

            // Przykładowy kod przekazujący dane do szablonu
            $this->smarty->assign('widgetData', $widgetData);

            // Zwracanie wyrenderowanego HTML widgetu
            return $this->fetch('module:blognews/blognews.tpl');
        }
        return '';
    }
    
}
