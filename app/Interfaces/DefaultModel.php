<?php
/**
 * Created by PhpStorm.
 * User: Joabe
 * Date: 01/05/2018
 * Time: 08:16
 */

namespace App\Http;


use Illuminate\Http\Request;

interface DefaultModel
{
    /**
     * @param $attributes
     * @return mixed
     */
    public static function insert($attributes);

    /**
     * @param array $attributes
     * @param array $options
     * @return mixed
     */
    public function update(array $attributes = [], array $options = []);

    /**
     * @param Request $request
     * @return mixed
     */
    public static function search(Request $request);

    /**
     * @return array
     */
    public static function dataTablesColumns();

    /**
     * @return array
     */
    public static function dataTablesSearchForm();

    /**
     * @return array
     */
    public static function fieldsFormCreate();

    /**
     * @return array
     */
    public static function fieldsFormEdit();

    /**
     * @return string
     */
    public function __toString();

}