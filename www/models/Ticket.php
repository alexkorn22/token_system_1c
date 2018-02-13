<?php
/**
 * Created by PhpStorm.
 * User: amarz
 * Date: 07.02.2018
 * Time: 15:51
 */

namespace models;
use core\App;
use core\base\Model;

class Ticket extends Model
{
    protected $attributes = array(
        'Number'=>'',
        'Date'=>'',
        'Завершено'=>'',
        'Результат'=>'',
        'Ref_Key'=>''
    );



    public static function getTicketsByGuid($guid,$options=[]){
        // create url :
        $baseUrl  = self::createUrl($guid,$options);
        // send request :
        $resp = self::sendReqToOData($baseUrl);
        // get Objects :
        return  self::getRecords($resp);

    }

    public static function createUrl($guid,$options){
        $baseUrl  =  TICKETS_URL.'?$format=json' ;
        $select   =  isset($options['select'])? $options['select'] :  '' ;
        $top      =  isset($options['top'])? $options['top'] : '10' ;
        if(!empty($select)){
            $baseUrl .= '&$select='.$select ;
        }
        if(!empty($top)){
            $baseUrl .= '&$top='.$top ;
        }
        $baseUrl .= '&$filter=Клиент_Key%20eq%20guid';
        $baseUrl .= "'".$guid."'";
        if(isset($options['filter']) && $options['filter']=='finished'){
            $filter   = 'false';
            $baseUrl .= '%20and%20Завершено%20eq%20'.$filter;
        }

        return $baseUrl;
    }


    public static function sendReqToOData($baseUrl){
        $curl = curl_init();
        curl_setopt_array($curl, array(
                CURLOPT_USERPWD => App::$config->userOneC.":".App::$config->passOneC,
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => $baseUrl
            )
        );
        $resp = curl_exec($curl);
        curl_close($curl);
        $resp = json_decode($resp,true);
        return $resp;
    }

    public static function getRecords($resp){
        // results to an array of objects :
        $records = array();
        if ($resp) {
            foreach ($resp['value'] as $ticket) {
                $object = new static();
                $object->load($ticket);
                $records[] = $object;
            }
        }

        return $records;
    }



    public static function deleteTicketByGuid($guid){
        $baseUrl = TICKETS_URL."(guid'{$guid}')";
        $ch = curl_init();
        // delete request :
        curl_setopt_array($ch, array(
            CURLOPT_USERPWD => App::$config->userOneC.":".App::$config->passOneC,
            CURLOPT_CUSTOMREQUEST => 'DELETE',
            CURLOPT_HTTPHEADER =>array('Content-Type:application/atom+xml;type=entry','Accept:application/atom+xml'),
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $baseUrl
        ));
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }


    public function createTicket(){

    }

    public function updateTicket(){

    }

}