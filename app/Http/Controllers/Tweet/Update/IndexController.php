<?php

namespace App\Http\Controllers\Tweet\Update;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tweet;
use App\Services\TweetService;//TweetServiceのインポート
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;


class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, TweetService $tweetService)
    {
        $tweetId = (int) $request->route('tweetId');

        //ログインユーザーIDと投稿者IDが一致しなかったら例外
        if (!$tweetService->checkOwnTweet($request->user()->id, $tweetId)){
            throw new AccessDeniedHttpException();
        }


        // if (is_null($tweet)) {
        //     throw new NotFountHttpException('存在しないつぶやきです。');
        // }
        // 以下のfirstOrFail()の記述で上記の記述を短縮できる
        $tweet = Tweet::where('id', $tweetId)->firstOrFail();

        return view('tweet.update')->with('tweet', $tweet);
    }
}
