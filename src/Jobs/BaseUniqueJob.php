<?php

namespace MyCustom\Jobs;

use MyCustom\Jobs\BaseJob;

use Illuminate\Contracts\Queue\ShouldBeUnique;

abstract class BaseUniqueJob extends BaseJob implements ShouldBeUnique
{
}
