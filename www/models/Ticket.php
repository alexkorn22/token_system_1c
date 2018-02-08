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
    public $top = ''  ;
    public $filter = '';

    public function getTicketsByGuid($guid,$options=[]){
        // get xml data by guid
        if(!empty($options)){
          $this->select = $options['select'];
          $this->top    = $options['top'];
          $this->filter = $options ['filter'];
        }
        $curl = curl_init();
        $baseUrl = JSON_TICKETS_URL .'&$select=&$top='.$this->top.'&$filter=Клиент_Key%20eq%20guid'."'".$guid."'";
        curl_setopt_array($curl, array(
                CURLOPT_USERPWD => ONEС_USER.":".ONEС_PWD,
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => $baseUrl
            )
        );

        // save results to $resp :
        $resp = curl_exec($curl);
        curl_close($curl);
        return $resp;
    }

}