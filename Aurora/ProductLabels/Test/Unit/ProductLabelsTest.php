<?php

namespace Aurora\ProductLabels\Test\Unit\ViewModel;


use Aurora\ProductLabels\Api\Data\LabelInterface;
use Magento\Framework\View\Element\BlockInterface;
use PHPUnit\Framework\TestCase;
use Aurora\ProductLabels\ViewModel\ProductLabels;
use Aurora\ProductLabels\Api\ProductLabelRepositoryInterface;
use PHPUnit\Framework\MockObject\MockObject;

class ProductLabelsTest extends TestCase
{
    /**
     * @var ProductLabels
     */
    private $viewModel;

    /**
     * @var ProductLabelRepositoryInterface|MockObject
     */
    private $labelRepository;

    /**
     * @var BlockInterface|MockObject
     */
    protected function setUp(): void
    {
        $this->labelRepository = $this->createMock(ProductLabelRepositoryInterface::class);
        $this->viewModel = new ProductLabels($this->labelRepository);
    }

    /**
     * Test that the getLabelsForProduct method returns an array of labels
     */
    public function testGetLabelsForProductReturnsLabels()
    {
        $productId = 1;
        $mockLabel = $this->createMock(LabelInterface::class);
        $mockLabel->method('getLabelText')->willReturn('New Arrival');

        $this->labelRepository->method('getLabelsByProductId')
            ->with($productId)
            ->willReturn([$mockLabel]);

        $labels = $this->viewModel->getLabelsForProduct($productId);

        $this->assertIsArray($labels);
        $this->assertNotEmpty($labels);
        $this->assertEquals('New Arrival', $labels[0]->getLabelText());
    }

    /**
     * Test that the getLabelsForProduct method returns an empty array when no labels are found
     */
    public function testGetLabelsForProductReturnsEmptyWhenNoLabels()
    {
        $productId = 2;
        $this->labelRepository->method('getLabelsByProductId')
            ->with($productId)
            ->willReturn([]);

        $labels = $this->viewModel->getLabelsForProduct($productId);

        $this->assertIsArray($labels);
        $this->assertEmpty($labels);
    }
}
