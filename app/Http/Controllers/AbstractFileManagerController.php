<?php

namespace App\Http\Controllers;

use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

abstract class AbstractFileManagerController extends Controller
{
    protected function filesysteme(): FilesystemAdapter
    {
        return Storage::disk('public');
    }
}
