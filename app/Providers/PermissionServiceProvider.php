<?php

namespace App\Providers;

use App\Supports\Permission;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;

class PermissionServiceProvider extends ServiceProvider
{
    public function boot(Permission $permission)
    {
        $permission->registerPermissions();
    }

    public function register()
    {
        $this->registerBladeExtensions();
    }

    protected function registerBladeExtensions()
    {
        $this->app->afterResolving('blade.compiler', function (BladeCompiler $bladeCompiler) {
            $bladeCompiler->directive('hasrole', function ($arguments) {
                [$role] = explode(',', $arguments . ',');
                return "<?php if (auth()->check() && auth()->user()->hasRole({$role})): ?>";
            });

            $bladeCompiler->directive('endhasrole', function () {
                return '<?php endif; ?>';
            });
        });
    }
}