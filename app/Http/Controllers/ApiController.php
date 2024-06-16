<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    //
    public function getVideoLink(Request $request)
    {
        $request->validate([
            'videoUrl' => 'required'
        ]);

        // check if the video link is either youtube or facebook or tiktok or instagram
        $url = $request->videoUrl;
        $filename = "";

        if (strpos($url, 'youtube.com') !== false || strpos($url, 'youtu.be') !== false) {
            // let us get the filename for youtube
            parse_str(parse_url($url, PHP_URL_QUERY), $query);
            $videoId = $query['v'] ?? null;

            if ($videoId) {
                $apiKey = env('YOUTUBE_API_KEY');
                $apiUrl = "https://www.googleapis.com/youtube/v3/videos?id={$videoId}&key={$apiKey}&part=snippet";
                $client = new Client();
                $response = $client->get($apiUrl);
                $data = json_decode($response->getBody(), true);

                $filename = $data['items'][0]['snippet']['title'] ?? 'Unknown Title';
            }
        } elseif (strpos($url, 'facebook.com') !== false) {

            $filename = "Unknown Title";
        } elseif (strpos($url, 'instagram.com') !== false) {

            $client = new Client();
            $response = $client->get($url);
            $html = $response->getBody()->getContents();

            preg_match('/<meta property="og:title" content="(.*?)"/', $html, $matches);

            $filename = $matches[1] ?? 'Unknown Title';
        } elseif (strpos($url, 'tiktok.com') !== false) {

            $client = new Client();
            $response = $client->get($url);
            $html = $response->getBody()->getContents();

            preg_match('/<meta property="og:title" content="(.*?)"/', $html, $matches);

            $filename = $matches[1] ?? 'Unknown Title';
        } else {
            $filename = "";
        }

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://social-media-video-downloader.p.rapidapi.com/smvd/get/all?url={$request->videoUrl}&filename={$filename}",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "x-rapidapi-host: social-media-video-downloader.p.rapidapi.com",
                "x-rapidapi-key: 19712ae800msh39302756eeef1abp1b8019jsnc7967b2210ac"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        }

        $data = json_decode($response, true);

        $audioLink = '';
        $sd360pLink = '';
        $render1080p60Link = '';
        $render720p60Link = '';
        $render720pLink = '';
        $render480pLink = '';
        $render240pLink = '';
        $render144pLink = '';

        // Iterate over the "links" array and store links based on their qualities
        foreach ($data['links'] as $link) {
            switch ($link['quality']) {
                case 'audio':
                    $audioLink = $link['link'];
                    break;
                case 'sd_360p':
                    $sd360pLink = $link['link'];
                    break;
                case 'render_1080p60':
                    $render1080p60Link = $link['link'];
                    break;
                case 'render_720p60':
                    $render720p60Link = $link['link'];
                    break;
                case 'render_720p':
                    $render720pLink = $link['link'];
                    break;
                case 'render_480p':
                    $render480pLink = $link['link'];
                    break;
                case 'render_240p':
                    $render240pLink = $link['link'];
                    break;
                case 'render_144p':
                    $render144pLink = $link['link'];
                    break;
                default:
                    // Handle unknown qualities if necessary
                    break;
            }
        }

        return view('download', compact('render720p60Link', 'render480pLink', 'render240pLink'));
    }
}
