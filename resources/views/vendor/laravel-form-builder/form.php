<?php if ($showStart): ?>
	<?= Form::open($formOptions) ?>
	<fieldset>
<?php endif; ?>

<?php if ($showFields): ?>
	<?php foreach ($fields as $field): ?>
		<?php if ( !in_array($field->getName(), array_merge($exclude, ['submit', 'submit2'])) ) { ?>
			<?= $field->render() ?>
		<?php } ?>
	<?php endforeach; ?>
<?php endif; ?>

<?php if ($showEnd): ?>
	</fieldset>

	<div class="form-actions">
		<?= form_rows($form, ['submit', 'submit2']) ?>
	</div>

	<?= Form::close() ?>
<?php endif; ?>
