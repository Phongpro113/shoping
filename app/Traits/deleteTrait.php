<?php
namespace App\Traits;

use Illuminate\Support\Facades\Log;

trait deleteTrait {
    public function deleteTrait($id, $model) {
        try {
            $model->find($id)->delete();
            return response()->json([
                'code' => 200,
                'message' => 'success'
            ], 200);

        } catch (\Exception $exception) {
            log::error('Message' . $exception->getMessage() . 'Line : ' .  $exception->getLine());
            return response()->json([
                'code' => 500,
                'message' => 'fail'
            ], 500);
        }
    }
}
?>
