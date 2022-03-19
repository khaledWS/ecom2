<?php

namespace App\Console\Commands\Admin;

use App\Models\Files;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class removeDeletedFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:recycleStorage';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Removes the Files that have been softDeleted from the Files DB';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $files = Files::all();
        $fileNames= $files->pluck('file_name');
        $filesToDelete = collect();
        $disks = ['categories', 'vendors', 'products'];
        $diskFiles = collect();
        foreach($disks as $disk){
            $diskFiles->put($disk,Storage::disk($disk)->files());
        }
        dd($fileNames);
        foreach($diskFiles as $dir){
            $x = collect($dir);
            $deleted = $x->diff($fileNames);
            $filesToDelete->push($deleted);
        }
        // $x= $fileNames->diff($diskFiles);
        dd($filesToDelete);
        // foreach($filesToDelete as delete)
        // $filesToDelete->map(function ($value,$key))
        // $dirctores = Storage::disk('vendors')->files();
    }
}
