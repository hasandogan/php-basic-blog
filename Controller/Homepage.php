<?php

class Homepage extends AbstractController
{
    /**
     * Homepage constructor.
     */
    public function index()
    {
        return [
            'general' => $this->getDefaultParams()
        ];

    }


}