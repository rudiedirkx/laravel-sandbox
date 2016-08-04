<?php if ($showStart): ?>
	<?= Form::open($formOptions) ?>
	<fieldset>
<?php endif; ?>

<?php if ($showFields): ?>
	<?php foreach ($fields as $field): ?>
		<?php if( $field->getName() != 'submit' && !in_array($field->getName(), $exclude) ) { ?>
			<?= $field->render() ?>
		<?php } ?>
	<?php endforeach; ?>
<?php endif; ?>

<?php if ($showEnd): ?>
	</fieldset>

	<div class="form-actions">
		<?= form_row($form->getField('submit')) ?>
	</div>

	<?= Form::close() ?>
<?php endif; ?>