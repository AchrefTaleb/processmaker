<?php

namespace ProcessMaker\Http\Controllers\Process;

use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;
use ProcessMaker\Http\Controllers\Controller;
use ProcessMaker\Models\Catalog;
use ProcessMaker\Models\Screen;
use ProcessMaker\Models\Script;

class ScreenController extends Controller
{
    /**
     * Get the list of screens
     *
     * @return Factory|View
     */
    public function index()
    {
        $catalog = Catalog::where('type', Screen::class)->get();
        $types = [];
        foreach ($catalog as $item) {
            $types[$item->value] = $item->label;
        }
        return view('processes.screens.index', compact('types'));
    }

    /**
     * Get page edit
     *
     * @param Screen $screen
     *
     * @return Factory|View
     */
    public function edit(Screen $screen)
    {
        return view('processes.screens.edit', compact('screen'));
    }

    /**
     * Get page export
     *
     * @param Screen $screen
     *
     * @return Factory|View
     */
    public function export(Screen $screen)
    {
        return view('processes.screens.export', compact('screen'));
    }

    /**
     * Get page import
     *
     * @param Screen $screen
     *
     * @return Factory|View
     */
    public function import(Screen $screen)
    {
        return view('processes.screens.import');
    }


    public function download(Screen $screen, $key)
    {
        $fileName = snake_case($screen->title) . '.spark';
        $fileContents = Cache::get($key);

        if (! $fileContents) {
            return abort(404);
        } else {
            return response()->streamDownload(function () use ($fileContents) {
                echo $fileContents;
            }, $fileName);
        }
    }
}
