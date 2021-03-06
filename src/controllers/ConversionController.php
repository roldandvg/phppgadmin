<?php

namespace PHPPgAdmin\Controller;
use \PHPPgAdmin\Decorators\Decorator;

/**
 * Base controller class
 */
class ConversionController extends BaseController {
	public $_name = 'ConversionController';

	function render() {
		$conf = $this->conf;
		$misc = $this->misc;
		$lang = $this->lang;

		$action = $this->action;
		if ($action == 'tree') {
			return $this->doTree();
		}

		$misc->printHeader($lang['strconversions']);
		$misc->printBody();

		switch ($action) {
			default:
				$this->doDefault();
				break;
		}

		return $misc->printFooter();

	}

	function doTree() {

		$conf = $this->conf;
		$misc = $this->misc;
		$lang = $this->lang;
		$data = $misc->getDatabaseAccessor();

		$constraints = $data->getConstraints($_REQUEST['table']);

		$reqvars = $misc->getRequestVars('schema');

		function getIcon($f) {
			switch ($f['contype']) {
				case 'u':
					return 'UniqueConstraint';
				case 'c':
					return 'CheckConstraint';
				case 'f':
					return 'ForeignKey';
				case 'p':
					return 'PrimaryKey';

			}
		}

		$attrs = [
			'text' => Decorator::field('conname'),
			'icon' => Decorator::callback('getIcon'),
		];

		return $misc->printTree($constraints, $attrs, 'constraints');

	}

	/**
	 * Show default list of conversions in the database
	 */
	public function doDefault($msg = '') {

		$conf = $this->conf;
		$misc = $this->misc;
		$lang = $this->lang;
		$data = $misc->getDatabaseAccessor();

		$this->printTrail('schema');
		$this->printTabs('schema', 'conversions');
		$misc->printMsg($msg);

		$conversions = $data->getconversions();

		$columns = [
			'conversion' => [
				'title' => $lang['strname'],
				'field' => Decorator::field('conname'),
			],
			'source_encoding' => [
				'title' => $lang['strsourceencoding'],
				'field' => Decorator::field('conforencoding'),
			],
			'target_encoding' => [
				'title' => $lang['strtargetencoding'],
				'field' => Decorator::field('contoencoding'),
			],
			'default' => [
				'title' => $lang['strdefault'],
				'field' => Decorator::field('condefault'),
				'type' => 'yesno',
			],
			'comment' => [
				'title' => $lang['strcomment'],
				'field' => Decorator::field('concomment'),
			],
		];

		$actions = [];

		echo $this->printTable($conversions, $columns, $actions, 'conversions-conversions', $lang['strnoconversions']);
	}
}
