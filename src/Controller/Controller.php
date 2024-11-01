<?php
namespace GS\GSController;

/**
 * This class create a basic controller
 * 
 * @author Duy Nguyen <duyngha@gmail.com>
 * @since 1.0.0
 */

if (!class_exists('GsController')) {
	class GsController
	{
		// request code & request meesage
		// option name & option value
		// methods: 1. set option name
		//          2. set option value
		//          3. get option value
		//          4. set request: name & value
		//          5. send request

		/**
		 * @var string $option_name
		 */
		protected $option_name;

		/**
		 * @var string $key
		 */
		protected $key = [
			'GsModelFooter' => 'footer',
			'GsModelHeader' => 'header',
			'GsModelCustomCss' => 'customcss',
			'GsModelSingleTemp' => 'singletemp',
			'GsModelTitleBar' => 'titlebar',
		];

		/**
		 * @var string $option_value
		 */

		/**
		 * @var array $request
		 */
		protected $request;

		/**
		 * initiliaze
		 */
		public function __construct($key, $option)
		{
			$this->option_name = $option;
			$this->getOptionValue();
			$this->setRequest();
			$this->router($key, $this->request);
		}

		/**
		 * get option value
		 */
		public function getOptionValue()
		{
			$value = array();
			$value = get_option($this->option_name);
			return $value;
		}

		/**
		 * set request
		 */
		public function setRequest()
		{
			$request = array();
			foreach ($this->getOptionValue() as $key => $value) {
				if (preg_match('/req_.*/', $key) == 1) {
					$request[$key] = $value;
				}
			}
			$this->request = $request;
		}

		/**
		 * router
		 * 
		 * @param string $key
		 * @param array $req
		 * @return void
		 */
		public function router($key, $req)
		{
			$model = 'GS\GSModule\\GSModel\\' . array_search($key, $this->key);
			$obj = new $model($req, $this->getOptionValue());
		}

	} // end class
}