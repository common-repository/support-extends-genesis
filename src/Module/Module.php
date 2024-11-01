<?php
namespace GS\GSModule;

/**
 * Module handle hooks
 *
 * @since 1.0.0
 */
if (!class_exists('GsModule')) {
	class GsModule
	{
		/**
		 * @var array $request
		 */
		protected $request;

		/**
		 * @var array $data
		 */
		protected $data;

		/**
		 * initiliaze
		 */
		public function __construct($request, $data)
		{
			$this->request = $request;
			$this->data = $data;
			$this->loopRequest();
		}

		/**
		 * hooks
		 */
		public function hooks($key)
		{

		}

		/**
		 * remove default hooks
		 * 
		 * @return void
		 */
		public function loopRequest()
		{
			foreach ($this->request as $key => $value) {
				if ($value == 1) {
					$this->hooks($key);
				} else {
					continue;
				}
			}
		}

	}// end class
}