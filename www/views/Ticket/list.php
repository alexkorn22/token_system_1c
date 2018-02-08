<ul>
        <?foreach($ticketsArr['value'] as $ticket):?>
            <div style="border: 1px solid lightgray; padding: 30px;">
                <h3>Ticket No.<small>(<?=$ticket['Number']?>)</small></h3>
                <li>
                    Date :  <?=$ticket['Date']?>
                </li>
                <li>
                    Завершено :  <?php if($ticket['Завершено']){echo 'YES';}else{echo 'NO';}?>
                </li>
                <li>
                    Результат :  <?=$ticket['Результат']?>
                </li><br/>
                <a onclick="return confirm('Are you sure you want to delete this item?');" href="ticket/delete?guid=<?=$ticket['Ref_Key']?>" class="btn btn-danger btn-sm">Delete</a>
                <a href="#" class="btn btn-info btn-sm">Edit</a>
            </div>

            <br/>
        <?endforeach;?>
</ul>


