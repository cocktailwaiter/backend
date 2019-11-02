<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class TagCategoryTest extends TestCase
{
    protected static $endpoint = '/v1/tag_categories';

    public function testGetSuccess()
    {
        $response = $this->call('GET', static::$endpoint);
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testGetResponseWrapping()
    {
        $response = $this->call('GET', static::$endpoint);

        $response_data = $response->getData();
        $response_json = json_encode($response_data);
        $response_array = json_decode($response_json, true);

        $this->assertArrayHasKey(
            config('api.response.paginate_wrapper'),
            $response_array
        );

        $this->assertArrayHasKey(
            config('api.response.data_wrapper'),
            $response_array
        );
    }
}
