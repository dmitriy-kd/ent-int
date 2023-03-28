<?php

namespace App\Service;

use App\Entity\Notification;
use DateTime;
use App\Enum\DeliveryTypeEnum;

class AndroidPushNotificator extends AbstractNotificator
{
    public function setSentBy()
    {
        $this->sentBy = DeliveryTypeEnum::PUSH_ANDROID;
    }

    public function send(Notification $notification): DateTime
    {
        $text = $notification->getMessage();

        return new DateTime();
    }
}