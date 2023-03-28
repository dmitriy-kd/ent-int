<?php

namespace App\Service;

use Exception;
use App\Enum\DeliveryTypeEnum;

class NotificatorCreator
{
    public function createNotificator(string $deliveryType): AbstractNotificator
    {
        $deliveryTypeEnum = DeliveryTypeEnum::tryFrom($deliveryType);

        if (!$deliveryTypeEnum) {
            throw new Exception('Unexpected delivery type');
        }

        switch ($deliveryTypeEnum) {
            case DeliveryTypeEnum::EMAIL:
                return new EmailNotificator();
            case DeliveryTypeEnum::SMS:
                return new SmsNotificator();
            case DeliveryTypeEnum::PUSH_ANDROID:
                return new AndroidPushNotificator();
            case DeliveryTypeEnum::PUSH_IOS:
                return new IosPushNotificator();
        }

        throw new Exception('Something went wrong');
    }
}