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

class TicketController extends AppController
{
    public $top;
    public $filter;

    public function indexAction(){
        $ticket = new Ticket;
        $ticketsArr = $ticket->getTicketsByGuid($this->curUser->guid);
        $this->setVars(compact('ticketsArr'));
    }

    public function ListAction(){

        if(isset($_GET['top'])){
            $this->top   = isset($_GET['top']) ? $_GET['top'] : '';
        }
        if(isset($_GET['filter'])){
            $this->filter = $_GET['filter'];
        }
        $user = $this->curUser;
        $ticket = new Ticket;
        $ticketsArr = $ticket->getTicketsByGuid($user->guid,['top'=>$this->top,'filter'=>$this->filter]); // filter = finished
        $this->setVars(compact('ticketsArr'));
        $this->layout = false;
        $this->view = 'list';
    }

    public function deleteAction(){
        if(isset($_GET['guid'])){
            Ticket::deleteTicketByGuid($_GET['guid']);
        }
        $this->redirect('/ticket');
    }

}