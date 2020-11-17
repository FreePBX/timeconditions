<?php
namespace FreePBX\modules\Timeconditions\Api\Rest;
use FreePBX\modules\Api\Rest\Base;
class Timeconditions extends Base {
	protected $module = 'timeconditions';
	public function setupRoutes($app) {

		/**
		 * @verb GET
		 * @returns - a list of timeconditions settings
		 * @uri /timeconditions
		 */
		$app->get('/', function ($request, $response, $args) {
			\FreePBX::Modules()->loadFunctionsInc('timeconditions');
			$timeconditions = timeconditions_list();
			$timeconditions = $timeconditions ? $timeconditions : false;
			return $response->withJson($timeconditions);
		})->add($this->checkAllReadScopeMiddleware());

		/**
		 * @verb GET
		 * @returns - timeconditions state
		 * @uri /timeconditions/:id
		 */
		$app->get('/{id}', function ($request, $response, $args) {
			\FreePBX::Modules()->loadFunctionsInc('timeconditions');
			$tcstate = timeconditions_get_state($args['id']);
			if ($tcstate !== false) {
				$timeconditions = array();
				$timeconditions['state'] = $tcstate;
			}
			$timeconditions = $timeconditions ? $timeconditions : false;
			return $response->withJson($timeconditions);
		})->add($this->checkAllReadScopeMiddleware());

		/**
		 * @verb PUT
		 * @uri /timeconditions/:id
		 */
		$app->put('/{id}', function ($request, $response, $args) {
			\FreePBX::Modules()->loadFunctionsInc('timeconditions');
			$params = $request->getParsedBody();
			return $response->withJson(timeconditions_set_state($args['id'], $params['state']));
		})->add($this->checkAllWriteScopeMiddleware());
	}
}
