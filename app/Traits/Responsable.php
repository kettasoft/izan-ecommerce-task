<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait Responsable
{
  /**
   * @param $result
   * @param $message
   * @return JsonResponse
   */
  public function sendResponse($result, $message, $code = 200): JsonResponse
  {
    $response = [
      'success' => true,
      'data'    => $result,
      'message' => $message,
      'status'  => $code,
    ];
    return response()->json($response, $code);
  }

  /**
   * @param $error
   * @param array $errorMessage
   * @param int $code
   * @return JsonResponse
   */
  public function sendError($error, array $errorMessage = [], int $code): JsonResponse
  {
    $response = [
      'success' => false,
      'message' => $error,
      'status'  => $code,
    ];
    if (! empty($errorMessage)) {
      $response['data'] = $errorMessage;
    }
    return response()->json($response, $code);
  }

  /**
   * @param $successMessage
   * @param int $code
   * @return JsonResponse
   */
  public function sendSuccess($successMessage, int $code = 200): JsonResponse
  {
    $response = [
      'success' => true,
      'message' => $successMessage,
      'status'  => $code,
    ];
    return response()->json($response, $code);
  }

  /**
   * @param $result
   * @param $message
   * @return JsonResponse
   */
  public function sendErrorData($result, $message, $code = 200): JsonResponse
  {
    $response = [
      'success' => false,
      'data'    => $result,
      'message' => $message,
      'status'  => $code,
    ];
    return response()->json($response, $code);
  }
}
