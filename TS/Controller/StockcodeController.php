<?php

namespace TS\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Silex\Application;
use Silex\ControllerProviderInterface;

/**
 * Class StockcodeController
 * @package TS\Controller
 */
class StockcodeController implements ControllerProviderInterface
{
    /**
     * Connect function is used by Silex to mount the controller to the application.
     *
     * Please list all routes inside here.
     *
     * @param Application $app Silex Application Object.
     *
     * @return Response Silex Response Object.
     */
    public function connect(Application $app)
    {
        /**
         * @var \Silex\ControllerCollection $factory
         */
        $factory = $app['controllers_factory'];

        $factory->get('/', 'TS\Controller\StockcodeController::getAll');
        $factory->post('/', 'TS\Controller\StockcodeController::addNew');
        $factory->get('/{stockcode}', 'TS\Controller\StockcodeController::getStockcode');
        $factory->delete('/{stockcode}', 'TS\Controller\StockcodeController::deleteStockcode');

        return $factory;
    }

    /**
     * Get all the stockcodes.
     *
     * @param Application $app The silex app.
     *
     * @return string
     */
    public function getAll(Application $app)
    {
        $toys = $app['idiorm.db']->for_table('Toys')->find_array();

        return new JsonResponse($toys);
    }

    /**
     * Add stock.
     *
     * @param Application $app
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function addNew(Application $app, Request $request)
    {
        $toys = $app['idiorm.db']->for_table('Toys')->create();

        // crear validación acorde a lo necesario
        if ($request->get('code')) {
            $toys->set([
                'code' => $request->get('code'),
                'name' => $request->get('name') ?: 'agregar nombre',
                'quantity' => $request->get('quantity') ?: 0,
                'description' => $request->get('description') ?: 'agregar descripción',
                'image' => $request->get('image') ?: 'agregar imagen',
            ]);
        }

        $toys->save();

        return new Response('Success', Response::HTTP_NO_CONTENT);
    }

    /**
     * Get a stockcode.
     *
     * @param Application $app The silex app.
     * @param string $stockcode The stockcode.
     *
     * @return string
     */
    public function getStockcode(Application $app, $stockcode)
    {
        $toy = $app['idiorm.db']
            ->for_table('Toys')
            ->where('code', $stockcode)
            ->find_array()
        ;

        if (!$toy) {
            $app->abort(404, "Stockcode {$stockcode} does not exist.");
        }

        return new JsonResponse($toy);
    }


    /**
     * Delete a stockcode.
     *
     * @param Application $app The silex app.
     * @param string $stockcode The stockcode.
     *
     * @return string
     */
    public function deleteStockcode(Application $app, $stockcode)
    {
        try {
            $toy = $app['idiorm.db']
                ->for_table('Toys')
                ->where('code', $stockcode)
                ->delete()
            ;

            $responseCode = Response::HTTP_NO_CONTENT;
            return new Response('Success', $responseCode);

        } catch (\Exception $e) {
            $responseCode = Response::HTTP_INTERNAL_SERVER_ERROR;
            return new Response($e->getMessage(), $responseCode);
        }

    }
}