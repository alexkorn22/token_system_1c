<h1>
 <?=$title?>
</h1>

<ul class="list-group">
<?php foreach($tests as $test){ ?>
        <li class="list-group-item">
            <a href="\test\questions?test_id=<?php echo $test->id?> "><?= $test->title?></a>
        </li>
<?php } ?>
</ul>
