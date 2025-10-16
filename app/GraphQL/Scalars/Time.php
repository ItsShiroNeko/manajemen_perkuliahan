<?php

namespace App\GraphQL\Scalars;

use Carbon\Carbon;
use GraphQL\Type\Definition\ScalarType;

class Time extends ScalarType
{
    public string $name = 'Time';
    public ?string $description = 'A time string in the format HH:mm or HH:mm:ss';

    public function serialize($value)
    {
        // Convert to string in standard format
        return Carbon::parse($value)->format('H:i:s');
    }

    public function parseValue($value)
    {
        return $this->parseTimeString($value);
    }

    public function parseLiteral($valueNode, ?array $variables = null)
    {
        return $this->parseTimeString($valueNode->value);
    }

    private function parseTimeString(string $value)
    {
        // Jika format HH:mm:ss → langsung parse
        if (preg_match('/^\d{2}:\d{2}:\d{2}$/', $value)) {
            return Carbon::createFromFormat('H:i:s', $value);
        }

        // Jika format HH:mm → tambahkan :00 otomatis
        if (preg_match('/^\d{2}:\d{2}$/', $value)) {
            return Carbon::createFromFormat('H:i:s', $value . ':00');
        }

        throw new \Exception("Invalid time format, expected HH:mm or HH:mm:ss, got: $value");
    }
}
