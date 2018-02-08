
<h2>Here are your tickets :</h2><br/>
<h3>Filters</h3>
<div class="checkbox">
    <input type="checkbox" id="finished" value="Завершено"> Только не завершено
</div><br/>

<div class="form-group">
    <label for="sel1">Number of tickets :</label>
    <select class="form-control" id="tickets_numb">
        <option>10</option>
        <option>20</option>
        <option>50</option>
        <option>100</option>
        <option value="400" selected>Select all</option>
    </select>
</div>
<hr>


<div id="tickets">
    <?php $this->getView('list',compact('ticketsArr')); ?>
</div>
