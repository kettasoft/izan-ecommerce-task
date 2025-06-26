<?php

namespace Tests;

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Console\Kernel;
use Illuminate\Support\Facades\Hash;

trait CreatesApplication
{
  /**
   * Creates the application.
   *
   * @return Application
   */
  public function createApplication(): Application
  {
    $app = require __DIR__ . '/../bootstrap/app.php';

    $app->make(Kernel::class)->bootstrap();

    Hash::setRounds(4);

    return $app;
  }
}
