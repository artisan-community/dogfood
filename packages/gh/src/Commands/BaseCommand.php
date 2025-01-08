<?php

namespace ArtisanBuild\GH\Commands;

use Illuminate\Support\Facades\Process;

class BaseCommand implements GHCommand
{
    public array $options = [];

    protected string $config_key = '';

    public function option($option): static
    {
        $this->options[] = $option;

        return $this;
    }

    public function getOptions($key): string
    {
        return $this->options === []
            ? implode(' ', config(implode('.', [$this->config_key, $key]), []))
            : implode(' ', $this->options);
    }

    public function executeCommand(string $command): string
    {
        $process = Process::run(trim($command));

        if (! $process->successful()) {
            return $process->errorOutput();
        }

        return $process->output();
    }
}
