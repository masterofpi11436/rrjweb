<?php

namespace App\Http\Controllers\Policy;

// Base Controller
use Illuminate\Http\Request;

// Models required
use Smalot\PdfParser\Parser;
use App\Models\Policy\Policy;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class BuilderController extends Controller
{
    public function index()
    {
        return view('Policy.Builder.builder.index');
    }

    public function create()
    {
        return view('Policy.Builder.builder.create');
    }
}
