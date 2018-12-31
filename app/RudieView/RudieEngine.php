<?php

namespace App\RudieView;

use Illuminate\Contracts\View\Engine;

class RudieEngine implements Engine {

	public function get($path, array $data = []) {
		$code = file_get_contents($path);

		$code = $data['code'] = $this->parseCode($code);

		try {
			ob_start();
			eval("?>\n$code");
			$output = ob_get_clean();
		}
		catch (\Throwable $ex) {
			dd($ex->getMessage(), $code);
		}

		return $output;
	}

	protected function parseCode($code) {
		$code = $this->parseLoops($code);
		$code = $this->parsePrints($code);

		return $code;
	}

	protected function parseLoops($code) {
		$code = preg_replace('#(\W):for (\w+) as (\w+)(\W)#', '$1<? foreach ($data[\'$2\'] as $data[\'$3\']): ?>$4', $code);
		$code = preg_replace('#(\W):for (\w+) as (\w+) => (\w+)(\W)#', '$1<? foreach ($data[\'$2\'] as $data[\'$3\'] => $data[\'$4\']): ?>$5', $code);
		$code = str_replace(':endfor', '<? endforeach ?>', $code);

		return $code;
	}

	protected function parsePrints($code) {
		$code = preg_replace('#:(\w+)\|(\w+)#', '<?= $2($data[\'$1\']) ?>', $code);

		$code = preg_replace('#:(\w+)#', '<?= $data[\'$1\'] ?>', $code);

		return $code;
	}

}
