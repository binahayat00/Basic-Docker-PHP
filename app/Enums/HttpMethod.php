<?php

namespace App\Enums;

enum HttpMethod: string
{
    case POST = "POST";
    case GET = "GET";
    case PUT = "PUT";
    case DELETE = "DELETE";
    case OPTIONS = "OPTIONS";
}
