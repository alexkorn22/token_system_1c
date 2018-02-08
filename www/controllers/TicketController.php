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
    public function ticketListAction(){

        $guid = User::findGuidByLogin($_SESSION['USER']);
        $ticket = new Ticket;
        $tickets = $ticket->getTicketsByGuid($guid);
        $ticketsArr = json_decode($tickets,true);
        $this->setVars(compact('ticketsArr'));

    }
}