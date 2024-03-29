<?php
namespace App\Traits;

use http\Env\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait StorageImageTrait {
    public function storageTraitUpload($request, $fieldName, $folderName) {
        if ($request->hasFile($fieldName)) {
            $file = $request->$fieldName;
            $fileNameOrigin = $file->getClientOriginalName();
            $fileNameHash = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $filePash = $request->file($fieldName)->storeAs('public/' . $folderName, $fileNameHash);

            $dataUploadTrait = [
                'file_name' => $fileNameOrigin,
                'file_path' => Storage::url($filePash)
            ];
            return $dataUploadTrait;
        }
        return null;
    }

    public function storageTraitUploadMultiple($file, $folderName) {
            $fileNameOrigin = $file->getClientOriginalName();
            $fileNameHash = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $filePash = $file->storeAs('public/' . $folderName, $fileNameHash);


            $dataUploadTrait = [
                'file_name' => $fileNameOrigin,
                'file_path' => Storage::url($filePash)
            ];
            return $dataUploadTrait;
    }
}
?>
