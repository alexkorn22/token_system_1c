<ul>
        <?foreach($ticketsArr['value'] as $ticket):?>
            <div >
                <h3>Ticket No.<small>(<?=$ticket['Number']?>)</small></h3>
                <li>
                    Date :  <?=$ticket['Date']?>
                </li>
                <li>
                    Завершено :  <?php if($ticket['Завершено']){echo 'YES';}else{echo 'NO';}?>
                </li>
                <li>
                    Результат :  <?=$ticket['Результат']?>
                </li>
            </div>
            <br/>
        <?endforeach;?>
</ul>


