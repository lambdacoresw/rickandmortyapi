<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Characters;
use App\Models\Location;
use App\Models\Episode;
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

        foreach($characters['results'] as $character) 
        {            
            Characters::create([
                'name' => $character['name'],
                'status' => $character['status'],
                'species' => $character['species'],
                'type' => $character['type'] ?? '',
                'gender' => $character['gender'],
                'origin_name' => $character['origin']['name'] ?? 'unknown',  
                'origin_url' => $character['origin']['url'] ?? '',
                'location_name' => $character['location']['name'] ??'',
                'location_url' => $character['location']['url'] ?? '',
                'image' => $character['image'],
                'episodes' => json_encode($character['episode'])
            ]);
        }
        return response()->json([
            'message' => 'Characters Imported Successfully.'
        ]);
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
        $character = Characters::find($character_id);
        if(!$character)
        {
            return response()->json([
                'message' => 'Karakter Bulunamadi !'
            ]);
        }

        return response()->json($character);
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
        $getIDs = explode(',', $ids);
        $characters = Characters::findMany($getIDs);
        if ($characters->isEmpty())
        {
            return response()->json([
                'message' => 'Karakterler Bulunamadi !'
            ], 404);
        }

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
        $query = Characters::query();

        if ($request->has('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }
        if ($request->has('species')) {
            $query->where('species', $request->species);
        }
        if ($request->has('type')) {
            $query->where('type', $request->type);
        }
        if ($request->has('gender')) {
            $query->where('gender', $request->gender);
        }
        $characters = $query->get();
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
        $response = $client->request('GET', $this->url . 'location');
        $data = json_decode($response->getBody()->getContents(), true);
        foreach($data['results'] as $location)
        {
            Location::create([
                'name' => $location['name'],
                'type' => $location['type'],
                'dimension' => $location['dimension'],
            ]);
        }
        return response()->json([
            'message' => 'Locations Imported Successfully'
        ]);
    }

    public function getASingleLocation($location_id)
    {
        $location = Location::find($location_id);
        if(!$location)
        {
            return response()->json([
                'message' => 'Lokasyon Bulunamadi !'
            ]);
        }
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
        $getIDs = explode(',', $ids);
        $locations = Location::findMany($getIDs);
        if ($locations->isEmpty())
        {
            return response()->json([
                'message' => 'Lokasyon Bulunamadi !'
            ], 404);
        }

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
        $query = Location::query();

        if ($request->has('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
        if ($request->has('type')) {
            $query->where('type', $request->type);
        }
        if ($request->has('dimension')) {
            $query->where('dimension', $request->dimension);
        }
        
        $locations = $query->get();
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

        foreach($episodes['results'] as $episode) 
        {            
            Episode::create([
                'name' => $episode['name'],
                'air_date' => $episode['air_date'] ?? '',
                'episode' => $episode['episode'],
            ]);
        }
        return response()->json([
            'message' => 'Episodes Imported Successfully.'
        ]);
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
        $episode = Episode::find($episode_id);
        if(!$episode)
        {
            return response()->json([
                'message' => 'Bolum Bulunamadi !'
            ]);
        }
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
        $getIDs = explode(',', $ids);
        $episodes = Episode::findMany($getIDs);
        if ($episodes->isEmpty())
        {
            return response()->json([
                'message' => 'Bolumler Bulunamadi !'
            ], 404);
        }
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
        $query = Episode::query();

        if ($request->has('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
        if ($request->has('episode')) {
            $query->where('episode', $request->episode);
        }
        
        $episodes = $query->get();
        return response()->json($episodes);
    }
}
