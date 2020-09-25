<?php

use Doctrine\DBAL\DriverManager;

class HomepageController extends AbstractController
{
    /**
     * HomepageController constructor.
     */
    public function index()
    {

        return [
            'general' => $this->getDefaultParams()
        ];
    }


}