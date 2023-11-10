<?php

namespace MyCustom\Repositories\Enums;

use MyCustom\Enums\EnumTrait;

enum OperatorEnum: string
{
    case EQUAL                 = "=";
    case NOT_EQUAL             = "!=";
    case GREATER_THAN          = ">";
    case GREATER_THAN_OR_EQUAL = ">=";
    case LESS_THAN             = "<";
    case LESS_THAN_OR_EQUAL    = "<=";
    case LIKE                  = "LIKE";
    case NOT_LIKE              = "NOT LIKE";
    case IN                    = "IN";
    case NOT_IN                = "NOT IN";
    case BETWEEN               = "BETWEEN";
    case NOT_BETWEEN           = "NOT BETWEEN";

    use EnumTrait;
}
