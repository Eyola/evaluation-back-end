<?php

class Announce
{
    private int $id;
    private string $job;
    private string $place;
    private string $desription;
    private int $validate;
    private int $userId;

    public function __construct(array $data)
    {
        $this->hydrate($data);
    }

    public function hydrate(array $data)
    {
        foreach ($data as $key => $value) {
            $method = 'set'.ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getJob(): string
    {
        return $this->job;
    }

    public function setJob(string $job): void
    {
        $this->job = $job;
    }

    public function getDesription(): string
    {
        return $this->desription;
    }

    public function setDesription(string $desription): void
    {
        $this->desription = $desription;
    }

    public function getValidate(): int
    {
        return $this->validate;
    }

    public function setValidate(int $validate): void
    {
        $this->validate = $validate;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    public function getPlace(): string
    {
        return $this->place;
    }

    public function setPlace(string $place): void
    {
        $this->place = $place;
    }

}