<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Displays the main index page (Vue component 'Index/Index'),
     * passing a 'message' prop to it.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        // Returns the Vue component located at resources/js/Pages/Index/Index.vue
        // Sends a 'message' prop with the value 'hello from laravel!'
        return inertia(
            'Index/Index',
            [
                'message' => 'hello from laravel!'
            ]
        );
    }

    public function show()
    {
        // Returns the Vue component located at resources/js/Pages/Index/Show.vue
        return inertia('Index/Show');
    }
}
