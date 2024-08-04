<?php

namespace App\Enums;

enum EmailValidations: string
{
    case EMAILABLE_DELIVERABLE = 'deliverable';
    case ABSTRACT_DELIVERABLE = 'DELIVERABLE';
}
