<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;



class TmdbService
{

    private HttpClientInterface  $client;

    public function __construct(HttpClientInterface  $client)
    {
        $this->client = $client;
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     */
    private function getPopulars(string $category, string $page): array
    {
        $response = $this->client->request(

            "GET",
            "https://api.themoviedb.org/3/discover/{$category}?api_key=ddec886742429cd922ebad0010e96c2d&language=fr-FR&sort_by=popularity.desc&include_adult=false&include_video=false&page={$page}&with_watch_monetization_types=flatrate"
        );


        return $response->toArray();
    }

    public function showPopulars(string $category, string $page): array
    {
        $populars = $this->getPopulars($category, $page);
        $popularsResult = $populars['results'];
        $popularsArr = [];
        $arrayPage= [];

        foreach ($popularsResult as $popular) {
            $popularsArr[] = [
                "id" => $popular['id'],
                "title" => ($category === 'movie') ? $popular['title'] : $popular['name'],
                "poster_path" => $popular['poster_path']
            ];
        }
        $arrayPage ["page {$page}"] = [$popularsArr];
        return $arrayPage ;
    }
}
