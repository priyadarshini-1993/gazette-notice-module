<?php

namespace common\services;

use Yii;
use yii\httpclient\Client;

class GazetteService
{
    const API_URL = 'https://www.thegazette.co.uk/all-notices/notice/data.json';

    public function getNotices($page = 1, $limit = 10)
    {
        $client = new Client(['transport' => 'yii\\httpclient\\CurlTransport']);

        try {
            $response = $client->createRequest()
                ->setMethod('GET')
                ->setUrl(self::API_URL)
                ->setData(['results-page' => $page])
                ->setOptions([
                    CURLOPT_TIMEOUT => 10,
                    CURLOPT_SSL_VERIFYPEER => false,
                    CURLOPT_SSL_VERIFYHOST => false,
                ])
                ->send();

            if (!$response->isOk) {
                Yii::error('Failed to fetch Gazette notices: HTTP ' . $response->statusCode, __METHOD__);
                return ['total' => 0, 'items' => []];
            }

            $data = $response->data;
            $items = $data['entry'] ?? [];

            //Calculating total pages from the 'last' link
            $totalPages = 1;
            if (!empty($data['link'])) {
                foreach ($data['link'] as $link) {
                    if (isset($link['@rel']) && $link['@rel'] === 'last') {
                        if (preg_match('/results-page=(\d+)/', $link['@href'], $matches)) {
                            $totalPages = (int) $matches[1];
                            break;
                        }
                    }
                }
            }

            //Calculate total results
            $total = $totalPages * $limit;

            return [
                'total' => $total,
                'items' => $items,
            ];
        } catch (\Exception $e) {
            Yii::error("Error fetching notices: " . $e->getMessage(), __METHOD__);
            return ['total' => 0, 'items' => []];
        }
    }
}
