<?php

namespace App\Util;

use App\Interfaces\ImageStorage;
use Google\Cloud\Storage\StorageClient;

class ImageGCPStorage implements ImageStorage
{
    protected $storage;
    protected $bucket;

    public function __construct()
    {
        $this->storage = new StorageClient();
        $this->bucket = $this->storage->bucket(env('GCP_STORAGE_BUCKET'));
    }

    public function store($request): ?string
    {
        $imageFile = $request->file('image');
        if (!$imageFile) {
            return null;
        }

        $fileName = uniqid() . '_' . $imageFile->getClientOriginalName();
        $bucket = $this->bucket;

        $bucket->upload(
            fopen($imageFile->getRealPath(), 'r'),
            [
                'name' => $fileName,
            ]
        );

        return sprintf('https://storage.googleapis.com/%s/%s', env('GCP_STORAGE_BUCKET'), $fileName);
    }
}
