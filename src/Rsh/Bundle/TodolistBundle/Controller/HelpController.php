<?php

namespace Rsh\Bundle\TodolistBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HelpController extends Controller
{
    public function indexAction()
    {
        return $this->render('RshTodolistBundle:Help:index.html.twig');
    }
}
