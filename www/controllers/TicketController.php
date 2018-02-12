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


    public function indexAction(){
        $ticketsArr = Ticket::getTicketsByGuid($this->curUser->guid);
        $this->setVars(compact('ticketsArr'));
    }

    public function ListAction(){
        $top    = isset($_GET['top']) ? $_GET['top'] : '';
        $filter = isset($_GET['filter'])? $_GET['filter'] : '';
        $ticketsArr = Ticket::getTicketsByGuid($this->curUser->guid,['top'=>$top,'filter'=>$filter]); // filter = finished
        $this->setVars(compact('ticketsArr'));
        $this->layout = false;
    }

    public function deleteAction(){
        if(isset($_GET['guid'])){
            Ticket::deleteTicketByGuid($_GET['guid']);
        }
        $this->redirect('/ticket');
    }

}