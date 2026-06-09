<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    const BANNER_PIC_FOLDER = 'banner_picture';
    const PRODUCT_PIC = 'original_image';


    /**
     * update image
     * @param mixed $folder
     * @param mixed $uploadedFile
     * @param string $filename
     * @return void
     */
    public function uploadImageToStorage($folder, $uploadedFile, $filename)
    {
        if (!Storage::makeDirectory('public/' . $folder)) {
            throw new \Exception('Could not create the directory');
        }

        Storage::disk('public')->putFileAs(
            $folder,
            $uploadedFile,
            $filename
        );
    }

    /**
     * function for sending successful response
     *
     * @param string $result
     * @param string $message
     * @param integer $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendResponse($result, $message, $code = 200)
    {
        $response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];

        return response()->json($response, $code);
    }

    /**
     * function for sending error response
     *
     * @param string $error
     * @param array $errorMessages
     * @param integer $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];

        if(!empty($errorMessages))
        {
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }
}
