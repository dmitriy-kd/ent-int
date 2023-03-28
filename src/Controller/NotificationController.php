<?php

namespace App\Controller;

use App\Repository\NotificationRepository;
use App\Entity\TestUser;
use App\Repository\TestUserNotificationRepository;
use App\Service\NotificatorCreator;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class NotificationController extends AbstractController
{
    public function __construct(
        private readonly NotificatorCreator $notificatorCreator,
        private readonly NotificationRepository $notificationRepository,
        private readonly LoggerInterface $logger,
        private readonly TestUserNotificationRepository $testUserNotificationRepository,
    ) {}

    public function sendNotification(int $notificationId)
    {
        $notification = $this->notificationRepository->find($notificationId);

        $users = $notification->getUsers();

        foreach ($users as $user) {
            /** @var TestUser $user */

            if (!in_array($user->getDeliveryType(), $notification->getDeliveryTypes(), true)) {
                $this->logger->error('User notification do not has allowed type');
                continue;
            }

            $notificator = $this->notificatorCreator->createNotificator(
                $user->getDeliveryType()
            );

            $testUserNotification = $this->testUserNotificationRepository->getByNotificationAndTestUser(
                $notification,
                $user
            );

            $notificator->sendNotification($testUserNotification);
        }

    }
}