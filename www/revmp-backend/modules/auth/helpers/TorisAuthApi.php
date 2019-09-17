<?php

namespace app\modules\auth\helpers;

use yii\base\Exception;
use yii\web\BadRequestHttpException;

/**
 * Created by PhpStorm.
 * User: futul
 * Date: 10.10.18
 * Time: 14:21
 */
class TorisAuthApi
{
    /** @var string */
    public $baseUrl;

    /** @var string */
    public $aistoken;

    /** @var string */
    public $systemId;

    /**
     * @throws Exception
     */
    public function __construct($data)
    {
        foreach ($data as $attribute => $value) {
            $this->$attribute = $value;
        }
        if (!$this->systemId || !$this->aistoken) {
            throw new Exception('systemId и aistoken обязательны');
        }
    }

    /**
     * @return array
     * @throws BadRequestHttpException
     * @throws Exception
     */
    public function send(): array
    {
        /** @noinspection CurlSslServerSpoofingInspection */
        $options = [
            CURLOPT_CONNECTTIMEOUT => 30,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_FOLLOWLOCATION => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => true,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => [
                'Content-type:application/json',
                'Authorization:Token ' . $this->aistoken,
                'SystemID:' . $this->systemId,
            ],
            CURLOPT_HEADERFUNCTION => static function ($resource, $header) use (&$statusCode, &$headers) {
                $headers[] = $header;
                if (\strpos($header, 'HTTP/') === 0) {
                    $parts = \explode(' ', $header, 3);
                    $statusCode = $parts[1];
                }
                return \mb_strlen($header, '8bit');
            },
        ];

        $curl = \curl_init($this->baseUrl);
        \curl_setopt_array($curl, $options);
        $response = \curl_exec($curl);
        $errorNumber = \curl_errno($curl);
        $errorMessage = \curl_error($curl);
        \curl_close($curl);

        if ($errorNumber > 0) {
            throw new Exception('Curl error: #' . $errorNumber . ' - ' . $errorMessage);
        }

        foreach ($headers as $header) {
            $response = \str_replace($header, '', $response);
        }

        if (\strncmp('20', $statusCode ?? '', 2) === 0) {
            return \json_decode($response, true);
        }
        throw new BadRequestHttpException('Нет доступа к системе', 401);
    }
}