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
		<?= form_rows($form, ['submit', 'submit2']) ?>
	</div>

	<?= Form::close() ?>
<?php endif; ?>
