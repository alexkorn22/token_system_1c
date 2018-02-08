<?php
/**
 * Created by PhpStorm.
 * User: amarz
 * Date: 07.02.2018
 * Time: 15:51
 */

namespace models;
use core\base\Model;

class Ticket extends Model
{
    public $select = '' ;
    public $top = '' ;
    public $filter = [];


    public function getTicketsByGuid($guid,$options=[]){
        // get xml data by guid
        $this->filter['finished'] = 'true';
        if(!empty($options)){
          $this->select = $options['select'];
          $this->top    = isset($options['top'])? $options['top'] : $this->top ;
        }
        $curl = curl_init();
        $baseUrl = JSON_TICKETS_URL ;
        $baseUrl .= '&$select=&$top='.$this->top.'&$filter=Клиент_Key%20eq%20guid'."'".$guid."'";
        if($options['filter']=='finished'){
            $this->filter['finished']= 'false';
            $baseUrl .= '%20and%20Завершено%20eq%20'.$this->filter['finished'];
        }

        curl_setopt_array($curl, array(
                CURLOPT_USERPWD => ONEС_USER.":".ONEС_PWD,
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => $baseUrl
            )
        );

        // save results to $resp :
        $resp = curl_exec($curl);
        curl_close($curl);
        $resp = json_decode($resp,true);
        return $resp;
    }


    public static function deleteTicketByGuid($guid){
        $baseUrl = TICKETS_URL."(guid'{$guid}')";
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_USERPWD => ONEС_USER.":".ONEС_PWD,
            CURLOPT_CUSTOMREQUEST => 'DELETE',
            CURLOPT_HTTPHEADER =>array('Content-Type:application/atom+xml;type=entry','Accept:application/atom+xml'),
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $baseUrl
        ));
        $result = curl_exec($ch);
        curl_close($ch);
    }

}