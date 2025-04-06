<?php

namespace Aurora\ProductLabels\Test\Unit;

use Aurora\ProductLabels\Api\Data\LabelInterface;
use Aurora\ProductLabels\Api\LabelRepositoryInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use PHPUnit\Framework\TestCase;

class LabelRepositoryTest extends TestCase
{
    /**
     * Test for getById() method - success case
     */
    public function testGetByIdSuccess()
    {
        $labelId = 1;
        $labelMock = $this->createMock(LabelInterface::class);

        $repositoryMock = $this->createMock(LabelRepositoryInterface::class);

        $repositoryMock->expects($this->once())
            ->method('getById')
            ->with($labelId)
            ->willReturn($labelMock);

        $this->assertEquals($labelMock, $repositoryMock->getById($labelId));
    }

    /**
     * Test for getById() method - NoSuchEntityException
     */
    public function testGetByIdNoSuchEntityException()
    {
        $labelId = 999;

        $repositoryMock = $this->createMock(LabelRepositoryInterface::class);

        $repositoryMock->expects($this->once())
            ->method('getById')
            ->with($labelId)
            ->willThrowException(new NoSuchEntityException(__('Label not found')));

        $this->expectException(NoSuchEntityException::class);
        $repositoryMock->getById($labelId);
    }

    /**
     * Test for save() method
     */
    public function testSave()
    {
        $labelMock = $this->createMock(LabelInterface::class);

        $repositoryMock = $this->createMock(LabelRepositoryInterface::class);

        $repositoryMock->expects($this->once())
            ->method('save')
            ->with($labelMock)
            ->willReturn($labelMock);

        $this->assertEquals($labelMock, $repositoryMock->save($labelMock));
    }

    /**
     * Test for delete() method
     */
    public function testDelete()
    {
        $labelMock = $this->createMock(LabelInterface::class);

        $repositoryMock = $this->createMock(LabelRepositoryInterface::class);

        $repositoryMock->expects($this->once())
            ->method('delete')
            ->with($labelMock)
            ->willReturn(true);

        $this->assertTrue($repositoryMock->delete($labelMock));
    }

    /**
     * Test for getAllLabels() method
     */
    public function testGetAllLabels()
    {
        $labelMock = $this->createMock(LabelInterface::class);

        $repositoryMock = $this->createMock(LabelRepositoryInterface::class);

        $repositoryMock->expects($this->once())
            ->method('getAllLabels')
            ->willReturn([$labelMock]);

        $this->assertEquals([$labelMock], $repositoryMock->getAllLabels());
    }
}
