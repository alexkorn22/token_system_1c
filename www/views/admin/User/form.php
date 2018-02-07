<h1> Test Edit / Insert </h1>

<!-- action be in a variable or can be just a slash for the current page -->
<?php if($this->route['action']=='edit'){?>
    <a href="/admin/question/index?test_id=<?=$test->id?>">Questions</a><br/><br/>
<?php }?>
<form action="<?=$action?>" method="post">
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Title :</label>
        <div class="col-sm-10">
            <input type="text" name="title" class="form-control" value="<?=$test->title?>">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Sort :</label>
        <div class="col-sm-10">
            <input type="number" name="sort" class="form-control" placeholder="" value="<?=$test->sort?>" >
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-10">
            <button type="submit" name="submit" class="btn btn-primary">Save</button>
        </div>
    </div>
</form>
<br/>



