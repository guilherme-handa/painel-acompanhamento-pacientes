<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ServeAndDev extends Command
{
  protected $signature = 'serve:dev {--ip=} {--porta=}';
  protected $description = 'Executa php artisan serve e npm run dev';

  public function handle()
  {
    $ip = $this->option('ip') ?: '127.0.0.1';
    $porta = $this->option('porta') ?: '8080';

    // Executa php artisan serve em um processo separado
    $this->info('Iniciando servidor de desenvolvimento Laravel...');
    $serveCommand = sprintf('php artisan serve --host=%s --port=%s', escapeshellarg($ip), escapeshellarg($porta));
    $serveProcess = popen($serveCommand, 'r');

    if ($serveProcess) {
      $this->info('Servidor de desenvolvimento Laravel iniciado.');

      $this->info('Iniciando npm run dev...');
      $npmCommand = sprintf('npm run dev -- --host=%s', escapeshellarg($ip));
      $npmProcess = popen($npmCommand, 'r');

      if ($npmProcess) {
        $this->info('npm run dev iniciado.');
      } else {
        $this->error('Falha ao iniciar npm run dev.');
      }
    } else {
      $this->error('Falha ao iniciar o servidor de desenvolvimento Laravel.');
    }

    while (!feof($serveProcess) && !feof($npmProcess)) {
      echo fgets($serveProcess);
      echo fgets($npmProcess);
    }

    pclose($serveProcess);
    pclose($npmProcess);
  }
}


