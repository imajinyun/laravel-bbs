<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TransformerMakeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:transformer {name : The name of the transformer}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new transformer class';

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
     * @return mixed
     */
    public function handle()
    {
        $name = ucfirst($this->argument('name'));
        $this->createDirectories();
        $content = $this->compileHandlerStub($name);
        $file = app_path('Transformers') . "/{$name}.php";

        if (! is_file($file)) {
            touch($file);
            file_put_contents($file, $content);
            $this->info('Transformer created successfully.');
        } else {
            $this->error('Transformer already exists!');
        }
    }

    /**
     * Create the directories for the files.
     *
     * @return void
     */
    protected function createDirectories(): void
    {
        $directory = app_path('Transformers');
        ! is_dir($directory) && ! mkdir($directory, 0755, true) && ! is_dir($directory);
    }

    protected function compileHandlerStub($name)
    {
        return str_replace(
            ['{{namespace}}', '{{name}}'],
            [$this->getAppNamespace(), $name],
            file_get_contents(resource_path('stubs/make/ExampleTransformer.stub'))
        );
    }

    protected function getAppNamespace(): string
    {
        return 'App';
    }
}
