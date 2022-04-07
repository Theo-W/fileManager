<?php

namespace App\Http\Controllers;

use App\Http\Requests\FolderCreateRequest;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FolderController extends AbstractFileManagerController
{
    public function index(Request $request)
    {
        $directories = $this->filesysteme()->directories($request->query->get('parent'));
        return collect($directories)->map([$this, 'toArray']);
    }

    public function store(FolderCreateRequest $request)
    {
        $data = $request->validated();
        $path = ($data['parent'] ?? '') . '/' . $data['name'];
        $this->filesysteme()->makeDirectory($path);

        return $this->toArray(trim($path, '/'));
    }

    public function delete(string $folder)
    {
        $this->filesysteme()->deleteDirectory($folder);
        return response('', Response::HTTP_NO_CONTENT);
    }

    public function toArray(string $folders): array
    {
        $pathinfo = pathinfo($folders);

        return [
            'id' => $folders,
            'name' => $pathinfo['filename'],
            'parent' => $pathinfo['dirname'] === '.' ? null : $pathinfo['dirname']
        ];
    }
}
