<?php
namespace App\Enums;
enum ReactionEmoji: string
{
    case LIKE = '👍';
    case LOVE = '❤️';
    case LAUGH = '😂';
    case WOW = '😮';
    case SAD = '😢';
    case ANGRY = '😡';
}