<?php

namespace App\Http\Controllers\Swagger;

use App\Http\Controllers\Controller;


/**
 *
 * @OA\Post(
 *     path="/api/v1/notebook",
 *     summary="Создание",
 *     tags={"Notebook"},
 *
 *     @OA\RequestBody(
 *         @OA\JsonContent(
 *             allOf={
 *                 @OA\Schema(
 *                     @OA\Property(property="fullName", type="string", example="Кон Чен ыЙ"),
 *                     @OA\Property(property="company", type="string", example="Едения корея"),
 *                     @OA\Property(property="phone", type="integer", example="89135624307"),
 *                     @OA\Property(property="email", type="string", example="korei@gmail.com"),
 *                     @OA\Property(property="birthday", type="date", example="7.10.1952"),
 *                     @OA\Property(property="image", type="string", example="https://icdn.lenta.ru/images/2020/06/08/15/20200608154336600/square_320_3071243fc6e30d9f50ede8dd1272923b.jpg"),
 *                 )
 *             }
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="fullName", type="string", example="Кон Чен ыЙ"),
 *                 @OA\Property(property="company", type="string", example="Едения корея"),
 *                 @OA\Property(property="phone", type="integer", example="89135624307"),
 *                 @OA\Property(property="email", type="string", example="korei@gmail.com"),
 *                 @OA\Property(property="birthday", type="date", example="7.10.1952"),
 *                 @OA\Property(property="image", type="string", example="https://icdn.lenta.ru/images/2020/06/08/15/20200608154336600/square_320_3071243fc6e30d9f50ede8dd1272923b.jpg"),
 *             ),
 *         ),
 *     ),
 * ),
 *
 * @OA\Get(
 *     path="/api/v1/notebook",
 *     summary="Список",
 *     tags={"Notebook"},
 *
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", type="array", @OA\Items(
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="fullName", type="string", example="Кон Чен ыЙ"),
 *                 @OA\Property(property="company", type="string", example="Едения корея"),
 *                 @OA\Property(property="phone", type="integer", example="89135624307"),
 *                 @OA\Property(property="email", type="string", example="korei@gmail.com"),
 *                 @OA\Property(property="birthday", type="date", example="7.10.1952"),
 *                 @OA\Property(property="image", type="string", example="https://icdn.lenta.ru/images/2020/06/08/15/20200608154336600/square_320_3071243fc6e30d9f50ede8dd1272923b.jpg"),
 *             )),
 *             @OA\Property(property="links", type="object",
 *                 @OA\Property(property="first", type="string", example="http://127.0.0.1:8000/api/v1/notebook?page=1"),
 *                 @OA\Property(property="last", type="string", example="http://127.0.0.1:8000/api/v1/notebook?page=2"),
 *                 @OA\Property(property="prev", type="string", example=null),
 *                 @OA\Property(property="next", type="string", example="http://127.0.0.1:8000/api/v1/notebook?page=2"),
 *             ),
 *             @OA\Property(property="meta", type="object",
 *                 @OA\Property(property="current_page", type="string", example=1),
 *                 @OA\Property(property="from", type="string", example=1),
 *                 @OA\Property(property="last_page", type="string", example=2),
 *                 @OA\Property(property="links", type="array", @OA\Items(
 *                     @OA\Property(property="url", type="string", example="http://127.0.0.1:8000/api/v1/notebook?page=1"),
 *                     @OA\Property(property="label", type="string", example="1"),
 *                     @OA\Property(property="active", type="string", example=true),
 *                 )),
 *                 @OA\Property(property="path", type="string", example="http://127.0.0.1:8000/api/v1/notebook"),
 *                 @OA\Property(property="per_page", type="string", example=10),
 *                 @OA\Property(property="to", type="string", example=10),
 *                 @OA\Property(property="total", type="string", example=11),
 *             ),
 *         ),
 *     ),
 * ),
 *
 * @OA\Get(
 *     path="/api/v1/notebook/{notebook}",
 *     summary="Еденичная запись",
 *     tags={"Notebook"},
 *     @OA\Parameter(
 *         description="ID notebook",
 *         in="path",
 *         name="notebook",
 *         required=true,
 *         example=1,
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="fullName", type="string", example="Кон Чен ыЙ"),
 *                 @OA\Property(property="company", type="string", example="Едения корея"),
 *                 @OA\Property(property="phone", type="integer", example="89135624307"),
 *                 @OA\Property(property="email", type="string", example="korei@gmail.com"),
 *                 @OA\Property(property="birthday", type="date", example="7.10.1952"),
 *                 @OA\Property(property="image", type="string", example="https://icdn.lenta.ru/images/2020/06/08/15/20200608154336600/square_320_3071243fc6e30d9f50ede8dd1272923b.jpg"),
 *             ),
 *         ),
 *     ),
 * ),
 *
 * @OA\Patch(
 *     path="/api/v1/notebook/{notebook}",
 *     summary="Обновление",
 *     tags={"Notebook"},
 *     @OA\Parameter(
 *         description="ID notebook",
 *         in="path",
 *         name="notebook",
 *         required=true,
 *         example=1,
 *     ),
 *     @OA\RequestBody(
 *         @OA\JsonContent(
 *             allOf={
 *                 @OA\Schema(
 *                     @OA\Property(property="fullName", type="string", example="Ким Чен Ым"),
 *                     @OA\Property(property="company", type="string", example="Северная корея"),
 *                     @OA\Property(property="phone", type="integer", example="8913624307"),
 *                     @OA\Property(property="email", type="string", example="koreiEdit@gmail.com"),
 *                     @OA\Property(property="birthday", type="date", example="23.11.1956"),
 *                     @OA\Property(property="image", type="string", example=null),
 *                 )
 *             }
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="fullName", type="string", example="Ким Чен Ым"),
 *                     @OA\Property(property="company", type="string", example="Северная корея"),
 *                     @OA\Property(property="phone", type="integer", example="8913624307"),
 *                     @OA\Property(property="email", type="string", example="koreiEdit@gmail.com"),
 *                     @OA\Property(property="birthday", type="date", example="23.11.1956"),
 *                     @OA\Property(property="image", type="string", example=null),
 *             ),
 *         ),
 *     ),
 * ),
 *
 * @OA\Delte(
 *     path="/api/v1/notebook/{notebook}",
 *     summary="Удаление",
 *     tags={"Notebook"},
 *     @OA\Parameter(
 *         description="ID notebook",
 *         in="path",
 *         name="notebook",
 *         required=true,
 *         example=1,
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="done"),
 *         ),
 *     ),
 * ),
 *
 */
class IndexController extends Controller
{

}

