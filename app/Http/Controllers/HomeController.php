<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(): View
    {
        $tasks = auth()->user()?->tasks ?? [];
        $tags = auth()->user()?->tags ?? [];

        return view('index', compact('tasks', 'tags'));
    }
}
