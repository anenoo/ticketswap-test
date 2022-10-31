<?php

namespace TicketSwap\Assessment\tests\Entity;

use PHPUnit\Framework\TestCase;
use TicketSwap\Assessment\Entity\Administrator;

class AdministratorTest extends TestCase
{
    /**
     * @covers \TicketSwap\Assessment\Entity\Administrator::__construct
     * @group administrator
     * @test
     */
    public function itShouldBePossibleToCreateAdministratorByConstruct()
    {
        $admin = new Administrator(
            id: 1,
            name: 'Supper Admin',
            username: 'super_admin',
            password: 'test'
        );
        $this->assertEquals(1, $admin->getId());
        $this->assertEquals('Supper Admin', $admin->getName());
        $this->assertEquals('super_admin', $admin->getUsername());
        $this->assertEquals('test', $admin->getPassword());
    }

    /**
     * @covers \TicketSwap\Assessment\Entity\Administrator::setId
     * @group administrator
     * @test
     */
    public function itShouldBePossibleToSetId()
    {
        $admin = new Administrator(
            id: 1,
            name: 'Supper Admin',
            username: 'super_admin',
            password: 'test'
        );
        $admin->setId(2);
        $this->assertEquals(2, $admin->getId());
    }

    /**
     * @covers \TicketSwap\Assessment\Entity\Administrator::setName
     * @group administrator
     * @test
     */
    public function itShouldBePossibleToSetName()
    {
        $admin = new Administrator(
            id: 1,
            name: 'Supper Admin',
            username: 'super_admin',
            password: 'test'
        );
        $admin->setName('New Admin');
        $this->assertEquals('New Admin', $admin->getName());
    }

    /**
     * @covers \TicketSwap\Assessment\Entity\Administrator::setUsername
     * @group administrator
     * @test
     */
    public function itShouldBePossibleToSetUserName()
    {
        $admin = new Administrator(
            id: 1,
            name: 'Supper Admin',
            username: 'super_admin',
            password: 'test'
        );
        $admin->setUsername('new_admin');
        $this->assertEquals('new_admin', $admin->getUsername());
    }

    /**
     * @covers \TicketSwap\Assessment\Entity\Administrator::setPassword
     * @group administrator
     * @test
     */
    public function itShouldBePossibleToSetPassword()
    {
        $admin = new Administrator(
            id: 1,
            name: 'Supper Admin',
            username: 'super_admin',
            password: 'test'
        );
        $admin->setPassword('test123');
        $this->assertEquals('test123', $admin->getPassword());
    }

    /**
     * @covers \TicketSwap\Assessment\Entity\Administrator::getId
     * @group administrator
     * @test
     */
    public function itShouldBePossibleToGetId()
    {
        $admin = new Administrator(
            id: 1,
            name: 'Supper Admin',
            username: 'super_admin',
            password: 'test'
        );
        $this->assertEquals(1, $admin->getId());
    }

    /**
     * @covers \TicketSwap\Assessment\Entity\Administrator::getName
     * @group administrator
     * @test
     */
    public function itShouldBePossibleToGetName()
    {
        $admin = new Administrator(
            id: 1,
            name: 'Supper Admin',
            username: 'super_admin',
            password: 'test'
        );
        $this->assertEquals('Supper Admin', $admin->getName());
    }

    /**
     * @covers \TicketSwap\Assessment\Entity\Administrator::getUsername
     * @group administrator
     * @test
     */
    public function itShouldBePossibleToGetUserName()
    {
        $admin = new Administrator(
            id: 1,
            name: 'Supper Admin',
            username: 'super_admin',
            password: 'test'
        );
        $this->assertEquals('super_admin', $admin->getUsername());
    }

    /**
     * @covers \TicketSwap\Assessment\Entity\Administrator::getPassword
     * @group administrator
     * @test
     */
    public function itShouldBePossibleToGetPassword()
    {
        $admin = new Administrator(
            id: 1,
            name: 'Supper Admin',
            username: 'super_admin',
            password: 'test'
        );
        $this->assertEquals('test', $admin->getPassword());
    }
}
