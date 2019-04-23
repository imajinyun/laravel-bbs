<?php

namespace App\Http\Controllers\Admin\System;

use Artisan;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;


class ArtisansController extends AdminController
{
    public function index(Request $request)
    {
        Artisan::call('list');
        $output = Artisan::output();
        $output = self::filterArtisanOutput($output);
        $commands = self::getCommandsFromOutput($output);

        $outputs = '';
        if ($request->getMethod() === 'POST') {
            $name = $request->name;
            $args = $request->args;
            $args = $args !== null ? ' ' . $args : '';

            try {
                $command = 'cd ' . base_path() . ' && php artisan ' . $name . $args;
                $process = new Process($command);
                $process->run();

                if (! $process->isSuccessful()) {
                    throw new ProcessFailedException($process);
                }
                $outputs = $process->getOutput();
            } catch (\Exception $exception) {
                $outputs = $exception->getMessage();
            }
        }

        return view('admin.systems.artisan.index', compact(
            'commands',
            'outputs'
        ));
    }

    private static function filterArtisanOutput($output): array
    {
        $output = array_filter(explode(PHP_EOL, $output));
        $index = array_search('Available commands:', $output, true);
        $output = array_slice($output, $index - 2, count($output));

        return $output;
    }

    private static function getCommandsFromOutput($output): array
    {
        $commands = [];

        foreach ($output as $line) {
            if (empty(trim(substr($line, 0, 2)))) {
                $parts = preg_split('/  +/', trim($line));
                $commands[] = (object) ['name' => trim(@$parts[0]), 'description' => trim(@$parts[1])];
            }
        }

        return $commands;
    }
}
