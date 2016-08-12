<?php if ($showLabel && $showField): ?>
	<?php if ($options['label']): ?>
		<fieldset <?= $options['wrapperAttrs'] ?> >
	<?php endif; ?>
<?php endif; ?>

<?php if ($showLabel && $options['label'] && $options['label_show']): ?>
	<legend><?= $options['label'] ?></legend>
<?php endif; ?>

<?php if ($showField): ?>
	<?php $form = $child_form; include 'fields.php'; ?>
<?php endif; ?>

<?php if ($showLabel && $showField): ?>
	<?php if ($options['label']): ?>
		</fieldset>
	<?php endif; ?>
<?php endif; ?>
