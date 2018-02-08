<?php
/**
 * Created by PhpStorm.
 * User: amarz
 * Date: 07.02.2018
 * Time: 15:52
 */

namespace controllers;


use core\base\Controller;
use models\Ticket;
use models\User;

class TicketController extends Controller
{
    public $top;
    public $filter;

    public function indexAction(){
        $guid = User::findGuidByLogin($_SESSION['USER']);
        $ticket = new Ticket;
        $ticketsArr = $ticket->getTicketsByGuid($guid);
        $this->setVars(compact('ticketsArr'));
    }

    public function ListAction(){

        if(isset($_GET['top'])){
            $this->top   = isset($_GET['top']) ? $_GET['top'] : '';
        }
        if(isset($_GET['filter'])){
            $this->filter = $_GET['filter'];
        }
        $guid = User::findGuidByLogin($_SESSION['USER']);
        $ticket = new Ticket;
        $ticketsArr = $ticket->getTicketsByGuid($guid,['top'=>$this->top,'filter'=>$this->filter]); // filter = finished
        $this->setVars(compact('ticketsArr'));
        $this->layout = false;
        $this->view = 'list';
    }

}