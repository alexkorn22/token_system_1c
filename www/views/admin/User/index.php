<h1>
    Hello Admin
</h1>

<hr/>
<h3><?=$title?></h3>
<br/>

<a class="btn-primary btn" href="/admin/test/add">Add New Test</a><br/><br/>

<table class="table">
    <tr>
        <th> Test </th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>

    </tr>

<?php foreach($tests as $test){ ?>
        <tr>
            <td ><?=$test->title?></td>
            <td>
                <a href="/admin/test/edit?test_id=<?=$test->id?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
            </td>
            <td>
                <a onclick="return confirm('Are you sure you want to delete?');" href="/admin/test/delete?test_id=<?=$test->id?>"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
            </td>
        </tr>
<?php } ?>
</table>






<!--
    we need a table with the delete and edite button for every test, for delete,
    we make a new page to delete tests from the database !
-->


