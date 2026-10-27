<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class RobotsController extends Controller
{
    public function __invoke(): Response
    {
        $path = public_path('robots.txt');

        if (! is_readable($path)) {
            abort(404);
        }

        return response(file_get_contents($path), 200, [
            'Content-Type' => 'text/plain; charset=UTF-8',
        ]);
    }
}
