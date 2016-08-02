<?php if ($showLabel && $showField): ?>
	<?php if ($options['wrapper'] !== false): ?>
		<fieldset <?= $options['wrapperAttrs'] ?> >
	<?php endif; ?>
<?php endif; ?>

<?php if ($showLabel && $options['label'] !== false && $options['label_show']): ?>
	<legend><?= $options['label'] ?></legend>
<?php endif; ?>

<?php if ($showField): ?>
	<?php foreach ((array)$options['children'] as $child): ?>
		<?php if( ! in_array( $child->getRealName(), (array)$options['exclude']) ) { ?>
			<?= $child->render() ?>
		<?php } ?>
	<?php endforeach; ?>

	<?php include 'help_block.php' ?>

<?php endif; ?>

<?php include 'errors.php' ?>

<?php if ($showLabel && $showField): ?>
	<?php if ($options['wrapper'] !== false): ?>
		</fieldset>
	<?php endif; ?>
<?php endif; ?>
