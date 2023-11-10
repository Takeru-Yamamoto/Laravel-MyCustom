<?php

namespace MyCustom\Jobs;

use MyCustom\Jobs\BaseJob;

use Illuminate\Contracts\Queue\ShouldBeUniqueUntilProcessing;

abstract class BaseUniqueProcessingJob extends BaseJob implements ShouldBeUniqueUntilProcessing
{
}
