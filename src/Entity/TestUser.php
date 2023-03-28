<?php

namespace App\Entity;

class TestUser
{
    private ?int $id = null;

    private string $deliveryType;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDeliveryType(): string
    {
        return $this->deliveryType;
    }

    public function setDeliveryType(string $type): self
    {
        $this->deliveryType = $type;

        return $this;
    }
}