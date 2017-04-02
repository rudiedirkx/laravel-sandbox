<?php

namespace App\Http\Controllers;

use App\Forms\FilesForm;
use App\Forms\FormBuilder;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use rdx\filemanager\FileId;
use rdx\filemanager\FileManager;
use rdx\filemanager\ManagedFile;

/**
 * @Controller(prefix="files")
 * @Middleware("web")
 */
class FilesController extends Controller {

	/**
	 * @Get("/{managed_file}", as="files.show")
	 */
	public function getShow(Request $request, FormBuilder $forms, ManagedFile $file) {
dpm($file, 'file');
	}

	/**
	 * @Get("/create", as="files.create")
	 */
	public function getCreate(Request $request, FormBuilder $forms) {
		$form = $forms->create(FilesForm::class);

		$title = 'FilesForm';

		return view('files/form', compact('title', 'form'));
	}

	/**
	 * @Post("/create", as="files.create.post")
	 */
	public function postCreate(Request $request, FormBuilder $forms, FileManager $files) {
		$form = $forms->create(FilesForm::class);
		$form->redirectIfNotValid();

// dpm($files, 'files');

		$values = $form->getFieldValues();
		$uploaded = $values['file1'];
// dpm($uploaded, 'file');

		$managed = $files->saveFile($uploaded, 'oele/boele/bla')->addUsage(new FileId('files', 'create'));
dpm($managed, 'managed');
dpm($managed->fullpath, 'managed->fullpath');
	}

}
