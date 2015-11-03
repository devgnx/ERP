<?php
namespace Gnxdev\NFe;

use Illuminate\Support\ServiceProvider;
use Symfony\Component\Finder\Finder;
use Illuminate\Filesystem\Filesystem;

class NFeServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadAutoloader(base_path('vendor'));
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
       //
    }

    /**
    * Require composer's autoload file the packages.
    *
    * @return void
    **/
    protected function loadAutoloader($path)
    {
        $finder = new Finder;
        $files  = new Filesystem;

        $autoloads = $finder->in($path)->files()->name('autoload.php')->depth('<= 3')->followLinks();

        foreach ($autoloads as $file) {
            $files->requireOnce($file->getRealPath());
        }
    }

}