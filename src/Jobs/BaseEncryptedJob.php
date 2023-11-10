<?php

namespace MyCustom\Jobs;

use MyCustom\Jobs\BaseJob;

use Illuminate\Contracts\Queue\ShouldBeEncrypted;

abstract class BaseEncryptedJob extends BaseJob implements ShouldBeEncrypted
{
}
