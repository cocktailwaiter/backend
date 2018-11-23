<?php
namespace App\Http\Controllers;

use Carbon\Carbon;
use Laravel\Lumen\Routing\Controller as BaseController;

class ApiController extends BaseController
{
    protected function makeApiResponseFormatByPaginateQueryAndData($paginate, $data)
    {
        return [
            config('api.response.paginate_wrapper') => $this->makeResponsePaginate($paginate),
            config('api.response.data_wrapper') => $data
        ];
    }

    protected function makeResponsePaginate($paginate_info)
    {
        $paginate_info = $paginate_info->toArray();

        $response_paginate = [];
        foreach (config('api.response.paginates') as $paginate) {
            $response_paginate[$paginate] = is_null($paginate_info[$paginate]) ? null : (integer)$paginate_info[$paginate];
        }

        return $response_paginate;
    }

    protected function dataFormat($data, string $format): string
    {
        switch ($format) {
            case 'string':
                $formattedData = $data;
                break;
            case 'datetime':
                $formattedData = Carbon::parse($data)->toDateTimeString();
                break;
            case 'date':
                $formattedData = Carbon::parse($data)->toDateString();
                break;
            case 'time':
                $formattedData = Carbon::parse($data)->toTimeString();
                break;
            default:
                $formattedData = $data;
                break;
        }

        return $formattedData;
    }
}
