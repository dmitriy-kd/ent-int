<?php

namespace App\Service;

use App\Entity\Notification;
use App\Entity\TestUserNotification;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Psr\Log\LoggerInterface;
use App\Enum\DeliveryTypeEnum;

abstract class AbstractNotificator
{
    protected ?DeliveryTypeEnum $sentBy = null;

    public function __construct(
        private readonly LoggerInterface $logger,
        private readonly EntityManagerInterface $entityManager,
    ) {}

    final public function sendNotification(TestUserNotification $testUserNotification): void
    {
        try {
            if ($testUserNotification->getProcessedAt()) {
                return;
            }

            $notification = $testUserNotification->getNotification();

            $this->setSentBy();

            $processedAt = $this->send($notification);
            $testUserNotification->setProcessedAt($processedAt);
            $testUserNotification->setSentBy($this->sentBy->value);

            $this->entityManager->flush();
        } catch (Exception $exception) {
            $this->logger->error($exception->getMessage());
        }
    }

    abstract protected function setSentBy();

    abstract protected function send(Notification $notification): DateTime;
}