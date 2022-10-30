<?php

namespace TicketSwap\Assessment\Entity;

/**
 * The Administrator is the person can approve/dis-approve a List for sale.
 */
class Administrator
{
    /**
     * @var int
     */
    private int $id;
    /**
     * @var string
     */
    private string $name;
    /**
     * @var string
     */
    private string $username;
    /**
     * @var string
     */
    private string $password;

    /**
     * @param int $id
     * @param string $name
     * @param string $username
     * @param string $password
     */
    public function __construct(
        int    $id,
        string $name,
        string $username,
        string $password
    )
    {
        $this->setId($id)
            ->setName($name)
            ->setUsername($username)
            ->setPassword($password);
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Administrator
     */
    public function setId(int $id): Administrator
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Administrator
     */
    public function setName(string $name): Administrator
    {
        $this->name = $name;
        return $this;
    }


    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return Administrator
     */
    public function setUsername(string $username): Administrator
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return Administrator
     */
    public function setPassword(string $password): Administrator
    {
        $this->password = $password;
        return $this;
    }

}