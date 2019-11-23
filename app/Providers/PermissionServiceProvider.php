<?php

namespace App\Providers;

use App\Supports\Permission;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;

class PermissionServiceProvider extends ServiceProvider
{
    public function boot(Permission $permission): void
    {
        $permission->registerPermissions();
    }

    public function register(): void
    {
        $this->registerBladeExtensions();
    }

    protected function registerBladeExtensions(): void
    {
        $this->app->afterResolving('blade.compiler', static function (BladeCompiler $bladeCompiler) {
            $bladeCompiler->directive('hasrole', static function ($arguments) {
                [$role] = explode(',', $arguments . ',');
                return "<?php if (auth()->check() && auth()->user()->hasRole({$role})): ?>";
            });

            $bladeCompiler->directive('endhasrole', static function () {
                return '<?php endif; ?>';
            });
        });
    }
}
