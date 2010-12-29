<?php
/**
 * A simple extension to add a sort field to an object.
 *
 * @package silverstripe-orderable
 */
class Orderable extends DataObjectDecorator {

	public function extraStatics() {
		return array(
			'db' => array('Sort' => 'Int'),
			'default_sort' => '"Sort"'
		);
	}

	public function onBeforeWrite() {
		if (!$this->owner->Sort) {
			$max = DB::query(sprintf(
				'SELECT MAX("Sort") + 1 FROM "%s"', $this->owner->class
			));
			$this->owner->Sort = $max->value();
		}
	}

}