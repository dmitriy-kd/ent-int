<?php

namespace App\Enum;

enum DeliveryTypeEnum: string
{
    case EMAIL = 'email';
    case SMS = 'sms';
    case PUSH_ANDROID = 'push-android';
    case PUSH_IOS = 'push-ios';
}
