<?php

namespace App\Http\Controllers\Tweet;

use App\Http\Controllers\Controller;
use App\Models\Tweet;
use Illuminate\Http\Request;

use App\Services\TweetService;//TweetServiceのインポート

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request,TweetService $tweetService)
    {
        $tweets = $tweetService->getTweets(); //つぶやきの一覧を取得

        return view('tweet.index')
            ->with('tweets', $tweets);
    }
}
