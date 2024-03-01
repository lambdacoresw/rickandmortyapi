<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RickAndMortyController extends Controller
{

    private $url = "https://rickandmortyapi.com/api/";

    /**
     * Tüm karakterleri alır.
     *
     * Bu fonksiyon, API'den tüm karakterleri alır.
     *
     * @return \Illuminate\Http\JsonResponse API'den alınan karakterlerin JSON yanıtı.
     */
    public function getAllCharacters()
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->get($this->url . 'character', ['verify' => false]);
        $body = $response->getBody()->getContents();
        $characters = json_decode($body, true);
        return response()->json($characters);
    }

    /**
     * Belirli bir karakteri alır.
     *
     * Bu fonksiyon, belirli bir karakterin bilgilerini API'den alır.
     *
     * @param int $character_id Karakterin ID'si.
     * @return \Illuminate\Http\JsonResponse Belirli karakterin bilgilerini içeren JSON yanıtı.
     */
    public function getASingleCharacter($character_id)
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->get($this->url . 'character/' . $character_id, ['verify' => false]);
        $body = $response->getBody()->getContents();
        $characters = json_decode($body, true);
        return response()->json($characters);
    }

    /**
     * Belirli bir karakterin bilgilerini alır.
     *
     * Bu fonksiyon, belirli bir karakterin bilgilerini API'den alır.
     *
     * @param int $character_id Karakterin ID'si.
     * @return \Illuminate\Http\JsonResponse Belirli karakterin bilgilerini içeren JSON yanıtı.
     */
    public function getMultipleCharacter($ids)
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->get($this->url . 'character/' . $ids, ['verify' => false]);
        $body = $response->getBody()->getContents();
        $characters = json_decode($body, true);
        return response()->json($characters);
    }

    /**
     * Karakterleri filtreler.
     *
     * Bu fonksiyon, belirli ölçütlere göre karakterleri filtreler.
     *
     * @param \Illuminate\Http\Request $request Filtreleme kriterlerini içeren istek nesnesi.
     * @return \Illuminate\Http\JsonResponse Filtrelenmiş karakterlerin JSON yanıtı.
     */
    public function filterCharacters(Request $request)
    {
        $client = new \GuzzleHttp\Client();
        $queryParameters = http_build_query([
            'name' => $request->get('name', ''),
            'status' => $request->get('status', ''),
            'species' => $request->get('species', ''),
            'type' => $request->get('type', ''),
            'gender' => $request->get('gender', ''),
        ]);

        $url = $this->url . 'character/?' . $queryParameters;
        $response = $client->request('GET', $url);
        $body = $response->getBody()->getContents();
        $characters = json_decode($body, true);
        return response()->json($characters);
    }

    /**
     * Tüm lokasyonları alır.
     *
     * Bu fonksiyon, API'den tüm lokasyonları alır.
     *
     * @return \Illuminate\Http\JsonResponse API'den alınan lokasyonların JSON yanıtı.
     */
    public function getAllLocations()
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->get($this->url . 'location', ['verify' => false]);
        $body = $response->getBody()->getContents();
        $locations = json_decode($body, true);
        return response()->json($locations);
    }

    public function getASingleLocation($location_id)
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->get($this->url . 'location/' . $location_id, ['verify' => false]);
        $body = $response->getBody()->getContents();
        $locations = json_decode($body, true);
        return response()->json($locations);
    }

    /**
     * Belirli bir lokasyonun bilgilerini alır.
     *
     * Bu fonksiyon, belirli bir lokasyonun bilgilerini API'den alır.
     *
     * @param int $location_id Lokasyonun ID'si.
     * @return \Illuminate\Http\JsonResponse Belirli lokasyonun bilgilerini içeren JSON yanıtı.
     */
    public function getMultipleLocations($ids)
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->get($this->url . 'location/' . $ids, ['verify' => false]);
        $body = $response->getBody()->getContents();
        $locations = json_decode($body, true);
        return response()->json($locations);
    }

    /**
     * Lokasyonları filtreler.
     *
     * Bu fonksiyon, belirli ölçütlere göre lokasyonları filtreler.
     *
     * @param \Illuminate\Http\Request $request Filtreleme kriterlerini içeren istek nesnesi.
     * @return \Illuminate\Http\JsonResponse Filtrelenmiş lokasyonların JSON yanıtı.
     */
    public function filterLocations(Request $request)
    {
        $client = new \GuzzleHttp\Client();
        $queryParameters = http_build_query([
            'name' => $request->get('name', ''),
            'type' => $request->get('type', ''),
            'dimension' => $request->get('dimension', ''),
        ]);

        $url = $this->url . 'location/?' . $queryParameters;
        $response = $client->request('GET', $url);
        $body = $response->getBody()->getContents();
        $locations = json_decode($body, true);
        return response()->json($locations);
    }

    /**
     * Tüm bölümleri alır.
     *
     * Bu fonksiyon, API'den tüm bölümleri alır.
     *
     * @return \Illuminate\Http\JsonResponse API'den alınan bölümlerin JSON yanıtı.
     */
    public function getAllEpisodes()
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->get($this->url . 'episode', ['verify' => false]);
        $body = $response->getBody()->getContents();
        $episodes = json_decode($body, true);
        return response()->json($episodes);
    }

    /**
     * Belirli bir bölümün bilgilerini alır.
     *
     * Bu fonksiyon, belirli bir bölümün bilgilerini API'den alır.
     *
     * @param int $episode_id Bölümün ID'si.
     * @return \Illuminate\Http\JsonResponse Belirli bölümün bilgilerini içeren JSON yanıtı.
     */
    public function getASingleEpisode($episode_id)
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->get($this->url . 'episode/' . $episode_id, ['verify' => false]);
        $body = $response->getBody()->getContents();
        $episodes = json_decode($body, true);
        return response()->json($episodes);
    }

    /**
     * Birden fazla bölümün bilgilerini alır.
     *
     * Bu fonksiyon, belirtilen bölüm ID'lerine sahip bölümlerin bilgilerini API'den alır.
     *
     * @param array $ids Alınacak bölüm ID'lerinin dizisi.
     * @return \Illuminate\Http\JsonResponse Belirtilen bölümlerin bilgilerini içeren JSON yanıtı.
     */
    public function getMultipleEpisodes($ids)
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->get($this->url . 'episode/' . $ids, ['verify' => false]);
        $body = $response->getBody()->getContents();
        $episodes = json_decode($body, true);
        return response()->json($episodes);
    }

    /**
     * Bölümleri filtreler.
     *
     * Bu fonksiyon, belirli ölçütlere göre bölümleri filtreler.
     *
     * @param \Illuminate\Http\Request $request Filtreleme kriterlerini içeren istek nesnesi.
     * @return \Illuminate\Http\JsonResponse Filtrelenmiş bölümlerin JSON yanıtı.
     */
    public function filterEpisodes(Request $request)
    {
        $client = new \GuzzleHttp\Client();
        $queryParameters = http_build_query([
            'name' => $request->get('name', ''),
            'episode' => $request->get('episode', ''),
        ]);

        $url = $this->url . 'episode/?' . $queryParameters;
        $response = $client->request('GET', $url);
        $body = $response->getBody()->getContents();
        $episodes = json_decode($body, true);
        return response()->json($episodes);
    }
}
