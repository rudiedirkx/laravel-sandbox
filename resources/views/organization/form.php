<?php if ($showStart): ?>
	<?= Form::open($formOptions) ?>
	<fieldset>
<?php endif; ?>

<?php if ($showFields): ?>
	<?php include 'fields.php'; ?>
<?php endif; ?>

<?php if ($showEnd): ?>
	</fieldset>

	<div class="form-actions">
		<?= form_row($form->getField('submit')) ?>
	</div>

	<?= Form::close() ?>
<?php endif; ?>
