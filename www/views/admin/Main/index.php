<h2>
    Welcome to WeDo support
</h2><br/>



<a href="/admin/user" class="btn btn-lg btn-primary">Show all users</a>

<br/><br/>
<h2>Add a new User :</h2>
<div class="row">
    <div class="col-md-6">
        <form action="/admin/user/add" method="post">
            <div class="form-group">
                <input type="text" class="form-control"  name="login" placeholder="User login">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="User Password">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="guid" placeholder="User guid in 1C">
            </div>
            <input type="submit" name ='submit' class="btn btn-info">
        </form>
    </div>
</div>

