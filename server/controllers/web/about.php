<?php

class about extends ServerController
{
    public function __construct()
    {
    }

    public function index()
    {
        $data['page_title'] = 'Rite Holdings- Agribusiness, Insurance Brokerage, Agriculture, Real Estate and Technology.';
        $data['menu_active'] = 'about'; // the menu active tab
        $this->loadView('about', @$data);
    }
}
