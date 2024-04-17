<?php

class Status
{
    private int $id;
    private string $status_name;

    public function __construct(array $data)
    {
        $this-> hydrate($data);
    }

    public function hydrate(array $data)
    {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);
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

    public function getStatus_name(): string
    {
        return $this->status_name;
    }

    public function setStatus_Name(string $status_name): void
    {
        $this->status_name = $status_name;
    }
}