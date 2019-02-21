<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class CocktailTest extends TestCase
{
    protected static $endpoint = '/v1/cocktails';
    public function testGetSuccess()
    {
        $response = $this->call('GET', static::$endpoint);
        // テスト・HTTPステータスコードが200(OK)かどうか
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testGetResponseWrapping()
    {
        $response = $this->call('GET', static::$endpoint);

        $response_data = $response->getData();
        $response_json = json_encode($response_data);
        $response_array = json_decode($response_json, true);

        // テスト・「paginate」キーが含まれてるか
        $this->assertArrayHasKey(
            config('api.response.paginate_wrapper'),
            $response_array
        );

        // テスト・「data」キーが含まれてるか
        $this->assertArrayHasKey(
            config('api.response.data_wrapper'),
            $response_array
        );
    }

    public function testGetResponsePaginate()
    {
        $response = $this->call('GET', static::$endpoint);

        $response_data = $response->getData();
        $response_json = json_encode($response_data);
        $response_array = json_decode($response_json, true);

        // テスト・「pagenate」の要素数が6か
        $this->assertEquals(
            6,
            count($response_array['paginate'])
        );

        // テスト・「paginate」に「total」を含むか
        $this->assertArrayHasKey(
            'total',
            $response_array['paginate']
        );

        // テスト・「paginate」の「total」はtype:integerか
        $this->assertInternalType(
            'integer',
            $response_array['paginate']['total']
        );

        // テスト・「paginate」に「per_page」が含まれているか
        // テスト・「paginate」の「per_page」はtype:integerか
        // テスト・「paginate」の「current_page」が含まれているか
        // テスト・「paginate」の「current_page」はtype:integerか
        // テスト・「paginate」の「last_page」が含まれているか
        // テスト・「paginate」の「last_page」はtype:integerか
        // テスト・「paginate」の「form」が含まれているか
        // テスト・「paginate」の「form」はtype:integerか
        // テスト・「paginate」の「to」が含まれているか
        // テスト・「paginate」の「to」はtype:integerか
    }

    public function testGetResponseData()
    {
        $response = $this->call('GET', static::$endpoint);

        $response_data = $response->getData();
        $response_json = json_encode($response_data);
        $response_array= json_decode($response_json);

        // テスト・「data」の要素数が4か
        // テスト・「data」に「id」が含まれているか
        // テスト・「data」に「id」がtype:integerか
        // テスト・「data」に「name」が含まれているか
        // テスト・「data」に「name」がtype:integerか
        // テスト・「data」に「tags」が含まれているか
        // テスト・「data」に「tags」がtype:arrayか
        // テスト・「data」に「update_at」が含まれているか
        // テスト・「data」に「update_at」がtype:stringか

    }

    public function testGetResponseTag()
    {
        // テスト・「data」に「update_at」が含まれているか
    // テスト・「tags」の要素数が5か
    // テスト・「tags」に「id」が含まれているか
    // テスト・「tags」の「id」がtype:integerか
    // テスト・「tags」に「name」が含まれているか
    // テスト・「tags」の「name」がtype:stringか
    // テスト・「tags」に「good」が含まれているか
    // テスト・「tags」の「good」がtype:integerか
    // テスト・「tags」に「bad」が含まれているか
    // テスト・「tags」の「bad」がtype:integerか
    // テスト・「tags」に「tag_category」が含まれているか
    // テスト・「tags」の「tag_category」がtype:objectか

    }

    public function testGetResponseTag()
    {
    // テスト・「tag_category」の要素数が2つか
    // テスト・「tag_category」に「id」が含まれるか
    // テスト・「tag_category」の「id」がtype:integerか
    // テスト・「tag_category」に「name」が含まれるか
    // テスト・「tag_category」の「name」がtype:stringか

    }
}
