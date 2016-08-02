<?php if ($showStart): ?>
	<?= Form::open($formOptions) ?>
	<fieldset>
<?php endif; ?>

<?php if ($showFields): ?>
	<?php foreach ($fields as $field): ?>
		<?php if( ! in_array($field->getName(), $exclude) ) { ?>
			<?= $field->render() ?>
		<?php } ?>
	<?php endforeach; ?>
<?php endif; ?>

<?php if ($showEnd): ?>
	</fieldset>
	<?= Form::close() ?>
<?php endif; ?>
