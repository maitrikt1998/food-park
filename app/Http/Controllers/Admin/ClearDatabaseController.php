<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;

class ClearDatabaseController extends Controller
{
    //
    function index(): View
    {
        return view('admin.clear-database.index');
    }

    function clearDB()
    {
        try{
            // wipeup database
            Artisan::call('migrate:fresh');
            // seed default data
            Artisan::call('db:seed',['--class'=>'UserSeeder']);
            Artisan::call('db:seed',['--class'=>'SettingSeeder']);
            Artisan::call('db:seed',['--class'=>'PaymentGatewaySettingSeeder']);
            Artisan::call('db:seed',['--class'=>'SectionTitleSeeder']);
            Artisan::call('db:seed',['--class'=>'MenuBuilderSeeder']);

            //delete unnecessory files
            $this->deleteFiles();

            return response(['status'=>'success', 'message'=>'Database wiped successfully!']);

        }Catch(\Exception $e){
            throw $e;
        }
    }

    function deleteFiles(): void
    {
        $path = public_path('uploads');
        $preserveFiles = ['avatar.jpg', 'media_67ae0167f229a.png', 'media_67ae01bfbda9f.png', 'media_67c305bb34485.png', 'media_67c305bb3e870.png', 'media_67c305bb44867.jpg'];

        $allFiles = File::allFiles($path);
        foreach($allFiles as $file){
            $filename = $file->getFilename();

            if(!in_array($filename, $preserveFiles)){
                File::delete($file->getPathname());
            }
        }
    }
}
