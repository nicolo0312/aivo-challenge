<?php
namespace Services;
use \GuzzleHttp\Client;

class SearchService{
    private function getFromYoutube(){

        try {
            $search = $_GET['search'];
            $apiKey = 'AIzaSyC-05CpyfAygDDs78zODpUzaQoAX2DZUe4';
            $client = new \GuzzleHttp\Client(['base_uri' => 'https://www.googleapis.com/youtube/v3/', 'timeout'=>2.0]);
            $url = 'search?q='.$search.'&maxResults=10&type=video&part=snippet&key='.$apiKey;
            $result = $client->request('GET', $url);
            return json_decode($result->getBody()->getContents(),true);
        } catch (\Throwable $th) {
            throw $th;
        }

    }

    public function requiredInfo(){
        try {
            $data = $this->getFromYoutube();
            if($data["pageInfo"]["totalResults"]==0){
                return [];
            }
            $list = [];
            for($i=0;$i<count($data['items']);$i++){
                $info = [];
                $info["published_at"]=$data["items"][$i]["snippet"]["publishedAt"];
                $info["id"]= $data["items"][$i]["id"]["videoId"];
                $info["title"]= $data["items"][$i]["snippet"]["title"];
                $info["description"]= $data["items"][$i]["snippet"]["description"];
                $info["thumbnail"]= $data["items"][$i]["snippet"]["thumbnails"]["default"]["url"];
                $info["extra"]["channelId"]=$data["items"][$i]["snippet"]["channelId"];
                $info["extra"]["channelTitle"]= $data["items"][$i]["snippet"]["channelTitle"];
                array_push($list,$info);
            }
            return json_encode($list);
        } catch (\Throwable $error) {
            throw $error;
        }


    }
}