<?php if (count($case_studies)>0) { ?>
<div class="group n3">
<h3>Case studies featuring <?php echo $activity['name'] ?></h3>
<ul>

<?php foreach( $case_studies as $slug => $case_study ): ?>
    <li class="thing">
        <h5><a href="/made/<?php echo $slug; ?>"><img src="/i/made/logo-<?php echo $slug; ?>.png" alt="<?php echo $case_study['name']; ?>" /></a></h5>
        <p><?php echo $case_study['description']; ?></p>
    </li>
<?php endforeach; ?>
</ul>
</div> <!-- /group -->
<?php } ?>