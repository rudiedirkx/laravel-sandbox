<?php

return [
	'manager' => [
		'storage' => 'uploads',
		'public' => '_files',
		'chmod_dirs' => 0777,
		'chmod_files' => 0666,
	],
	'storage' => [
		'files_table' => 'files',
		'usage_table' => 'files_usage',
	],
];
