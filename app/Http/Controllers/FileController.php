<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadFileRequest;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FileController extends AbstractFileManagerController
{
    public function index(Request $request)
    {
        $folder = $request->get('folder');
        $files = $this->filesysteme()->files($folder);

        return collect($files)
            ->filter(fn (string $file) => !str_starts_with($file, '.'))
            ->values()
            ->map([$this, 'toArray']);
    }

    public function store(UploadFileRequest $request)
    {
        $file = $request->file('file');
        $folder = $request->post('folder');
        $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $path = $file->storeAs($folder, $filename . '_' . $file->hashName(), 'public');

        return $this->toArray($path);
    }

    public function delete(string $file)
    {
        $this->filesysteme()->delete($file);
        return response('', Response::HTTP_NO_CONTENT);
    }

    public function toArray(string $file): array
    {
        $info = pathinfo($file);
        $disk = $this->filesysteme();

        return [
            'id' => $file,
            'name' => $info['basename'],
            'url' => $disk->url($file),
            'folder' => $info['dirname'] === '.' ? null : $info['dirname'],
            'thumbnail' => $disk->url($file),
        ];
    }
}
