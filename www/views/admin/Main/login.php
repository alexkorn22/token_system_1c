


    <h1><?=$title?></h1><br/><br/>



<div class="container">
    <form action="/admin" method="post" > <!-- onSubmit="createObject(); return false" -->
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Username : </label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="userName" id="userName" placeholder="Username">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Password :</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="userPassword" name="password" placeholder="Password">
            </div>
        </div>
        <div class="form-group row">
            <div class="offset-sm-2 col-sm-10">
                <button type="submit" name="submit" class="btn btn-primary">Sign in</button>
            </div>
        </div>
    </form>
</div>