<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\MessageBag;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function responseBase($data, $message = '', $code = 200)
    {
        $responsebase["message"] = $message;
        $responsebase["data"] = $data;

        return response()->json($responsebase, $code);
    }

    protected function failResponse($message, $errors = [], $isArray = false)
    {
        if ($errors instanceof MessageBag) {
            $msgbag = $errors;
            $errors = [];
            foreach ($msgbag->messages() as $key => $value) $errors[] = ['attribute' => $key, 'text' => $value[0]];
        } else {
            $formattedError = [];
            foreach ($errors as $key => $value) {
                if (is_array($value)) {
                    $text = $value[0];
                } else {
                    $text = $value;
                }
                $formattedError[] = ['attribute' => $key, 'text' => $text];
            };
            $errors = $formattedError;
        }
        return response()->json([
            'message' => $message,
            'data' => $errors,
        ], 400);
    }
}
