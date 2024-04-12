<?php



class User
{
    private int $id;
    private string $firstName;
    private string $lastName;
    private string $email;
    private string $password;
    private string $cv;
    private string $business;
    private string $address;
    private string $statusId;

    public function __construct(array $data)
    {
        $this-> hydrate($data);
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

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getCv(): string
    {
        return $this->cv;
    }

    public function setCv(string $cv): void
    {
        $this->cv = $cv;
    }

    public function getStatusId(): string
    {
        return $this->statusId;
    }

    public function setStatusId(string $statusId): void
    {
        $this->statusId = $statusId;
    }

    public function getBusiness(): string
    {
        return $this->business;
    }

    public function setBusiness(string $business): void
    {
        $this->business = $business;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function setAddress(string $address): void
    {
        $this->address = $address;
    }


}