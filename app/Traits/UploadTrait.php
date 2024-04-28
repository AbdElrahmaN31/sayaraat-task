<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

trait UploadTrait
{
    public function storeFile(UploadedFile $file, $folder = 'uploads', $disk = 'public')
    {
        $path = $file->store($folder, $disk);

        return $path;
    }

    public function updateFile(UploadedFile $file, $currentFilePath, $folder = 'uploads', $disk = 'public')
    {
        if ($currentFilePath) {
            $this->deleteFile($currentFilePath);
        }

        return $this->storeFile($file, $folder, $disk);
    }

    public function deleteFile($path, $disk = 'public')
    {
        if (Storage::disk($disk)->exists($path)) {
            Storage::disk($disk)->delete($path);
        }
    }

    public function getFilePath($path, $disk = 'public')
    {
        return Storage::disk($disk)->url($path);
    }

    public function storeImage(UploadedFile $file, $folder = 'uploads', $disk = 'public', $resizeWidth = null, $resizeHeight = null)
    {
        $path = $file->store($folder, $disk);

        if ($resizeWidth && $resizeHeight) {
            $image = Image::make(storage_path("app/{$path}"));
            $image->resize($resizeWidth, $resizeHeight);
            $image->save();
        }

        return $path;
    }

    public function updateImage(UploadedFile $file, $currentFilePath, $folder = 'uploads', $disk = 'public', $resizeWidth = null, $resizeHeight = null)
    {
        if ($currentFilePath) {
            $this->deleteFile($currentFilePath);
        }

        return $this->storeImage($file, $folder, $disk, $resizeWidth, $resizeHeight);
    }
}
