<?php
namespace App\Helpers\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
trait StorageImageTrait
{

    public function storageTraitUpload($request, $fieldName, $folderName)
    {
        if ($request->hasFile($fieldName)) {
            $file = $request->$fieldName;
            $fileNameOrigin = $file->getClientOriginalName();
            $string_random = Str::random(32);
            $fileNameHas = $string_random . "." . $file->getClientOriginalExtension();
            $path = $request->file($fieldName)->storeAs('public/'. $folderName .'/'.auth()->id(), $fileNameHas);
            $dataUpload = [
                'file_name' => $fileNameOrigin,
                'file_path' => Storage::url($path),
            ];
            return $dataUpload;
        }
        return null;
    }

    public function storageTraitUploadMultiple($file, $folderName)
    {
        $fileNameOrigin = $file->getClientOriginalName();
        $string_random = Str::random(32);
        $fileNameHas = $string_random . "." . $file->getClientOriginalExtension();
        $path = $file->storeAs('public/'. $folderName .'/'.auth()->id(), $fileNameHas);
        $dataUpload = [
            'file_name' => $fileNameOrigin,
            'file_path' => Storage::url($path),
        ];
        return $dataUpload;
    }

}
