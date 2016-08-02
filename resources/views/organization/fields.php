<fieldset>
	<legend>Organization details</legend>

	<?= form_rows($form, ['name', 'organization_address', 'website', 'client_since', 'client_until']) ?>
</fieldset>

<fieldset>
	<legend>Billing details</legend>

	<?= form_rows($form, ['billing_contact_person', 'billing_address', 'billing_email', 'billing_phone']) ?>
</fieldset>

<fieldset>
	<legend>Admin details</legend>

	<?= form_rows($form, ['maximum_accounts', 'country_regions_form', 'agreements', 'logo']) ?>
</fieldset>
