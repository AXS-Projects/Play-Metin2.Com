<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Download;
use App\Models\DownloadDescription;

class DownloadController extends Controller
{
    public function index()
    {
        $downloads = Download::all();
        $language = app()->getLocale(); // Obține limba activă a utilizatorului

        // Caută descrierea în limba selectată
        $description = DownloadDescription::where('language', $language)->first();

        // Dacă nu există în limba selectată, încearcă engleza
        if (!$description) {
            $description = DownloadDescription::where('language', 'en')->first();
        }

        // Dacă nu există nici în engleză, folosește mesajul implicit
        $finalDescription = $description ? $description->description : __('messages.page_download_no_description');

        return view('download', [
            'downloads' => $downloads,
            'description' => $finalDescription,
            'title' => ' - Download',
        ]);
    }
}
