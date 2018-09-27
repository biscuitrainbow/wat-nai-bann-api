<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TwitterController extends ApiController
{

    function getDateCreated($tweet)
    {
        return $tweet['created_at'];
    }

    public function fetchBaseHashtag()
    {

        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'https://api.twitter.com/1.1/search/tweets.json?q=%23Tradewar&result_type=recent&count=100', [
            'headers' => [
                'Authorization' => 'Bearer AAAAAAAAAAAAAAAAAAAAAPt%2B8QAAAAAAm4B1xCCIa36Uj6VcABQFyE8kw64%3Da3y0xR1BVIYDEX6q9TR5Y3FiMMCgpKggQSjz2W27uWGFhgxqgD',
            ]
        ]);

        $json = json_decode($response->getBody(), true);

        for ($i = 0; $i < 1; $i++) {
            $next = '';

            if ($i == 0) {
                $next = $json['search_metadata']['next_results'];
            } else {
                $next = $nJson['search_metadata']['next_results'];
            }


            $nResponse = $client->request(' GET', ' https ://api.twitter.com/1.1/search/tweets.json' . $next, [
                'connect_timeout' => 0,
                'timeout' => 0,
                'headers' => [
                    'Authorization' => 'Bearer AAAAAAAAAAAAAAAAAAAAAPt%2B8QAAAAAAm4B1xCCIa36Uj6VcABQFyE8kw64%3Da3y0xR1BVIYDEX6q9TR5Y3FiMMCgpKggQSjz2W27uWGFhgxqgD',
                ]
            ]);

            // $nJson = json_decode($nResponse->getBody(), true);
          ///  array_push($json['statuses'], $nJson['statuses']);
        }

        // return count($json['statuses']);

        // $dates = array_map(array($this, 'getDateCreated'), $json['statuses']);
        // return $dates;
       // $json = json_encode($response, true);
      //  return $json[''];
    }
}
