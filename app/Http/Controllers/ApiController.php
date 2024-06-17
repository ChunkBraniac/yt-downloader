<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ApiController extends Controller
{
    //
    private function getYoutubeVideoId($url)
    {
        $pattern = '/(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/';
        preg_match($pattern, $url, $matches);
        return $matches[1] ?? null;
    }

    /**
     * Show the video ID extracted from a YouTube URL.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request)
    {
        $url = $request->input('videoUrl');
        $videoId = $this->getYoutubeVideoId($url);

        return response()->json([
            'video_id' => $videoId,
        ]);
    }

    public function getVideoLink(Request $request)
    {
        $url = $request->input('videoUrl');
        $quality = $request->input('resolution');

        $videoId = $this->getYoutubeVideoId($url);

        if ($videoId) {
            $apiKey = env('YOUTUBE_API_KEY');
            $apiUrl = "https://www.googleapis.com/youtube/v3/videos?id={$videoId}&key={$apiKey}&part=snippet";
            $client = new Client();
            $response = $client->get($apiUrl);
            $data = json_decode($response->getBody(), true);

            $title = $data['items'][0]['snippet']['title'] ?? 'Unknown Title';
        }

        // // check if the video link is either youtube or facebook or tiktok or instagram
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://youtube-media-downloader.p.rapidapi.com/v2/video/details?videoId={$videoId}&audios=true",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "x-rapidapi-host: youtube-media-downloader.p.rapidapi.com",
                "x-rapidapi-key: 19712ae800msh39302756eeef1abp1b8019jsnc7967b2210ac"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            // echo "cURL Error #:" . $err;
            Log::info($err);
        }

        $data = json_decode($response, true);

        if (isset($data['videos']['items']) && is_array($data['videos']['items'])) {
            foreach ($data['videos']['items'] as $links) {

                if ($links['quality'] == $quality && $links['extension'] == 'mp4') {
                    $link_url =  $links['url'];
                    $link_quality = $links['quality'];
                    break;
                }
            }

            return view('download', compact('link_url', 'link_quality', 'title'));
        }
    }
}
