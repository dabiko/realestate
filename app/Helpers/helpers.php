<?php

function checkPropertyType( string $type): string
{
    return match ($type) {
        'buy' => 'Buy',
        'sale' => 'Sale',
        'rent' => 'Rent',
        default => 'None',
    };
}

function checkPropertyTag( string $type): string
{
    return match ($type) {
        'featured' => 'Featured',
        'hot' => 'Hot',
        default => 'None',
    };
}

