<?php

namespace Aurora\ProductLabels\Test\Unit;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;
use Aurora\ProductLabels\Model\Label;
use Aurora\ProductLabels\Model\ResourceModel\Label as LabelResource;
use Magento\Framework\Model\Context;
use Magento\Framework\Registry;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\EntityManager\MetadataPool;

class LabelTest extends TestCase
{
    /**
     * @var Label
     */
    protected $label;

    /**
     * @var LabelResource|MockObject
     */
    protected $labelResourceMock;

    /**
     * @var MockObject
     */
    protected function setUp(): void
    {
        $this->labelResourceMock = $this->createMock(LabelResource::class);

        $contextMock = $this->createMock(Context::class);
        $registryMock = $this->createMock(Registry::class);
        $scopeConfigMock = $this->createMock(ScopeConfigInterface::class);
        $dataObjectProcessorMock = $this->createMock(DataObjectProcessor::class);
        $joinProcessorMock = $this->createMock(JoinProcessorInterface::class);
        $metadataPoolMock = $this->createMock(MetadataPool::class);

        $objectManager = new ObjectManager($this);

        $this->label = $objectManager->getObject(Label::class, [
            'context' => $contextMock,
            'registry' => $registryMock,
            'resource' => $this->labelResourceMock,
            'data' => [],
        ]);
    }

    public function testLabelSetAndGet()
    {
        $this->label->setLabelId(1);
        $this->assertEquals(1, $this->label->getLabelId());

        $this->label->setLabelText('Label Text');
        $this->assertEquals('Label Text', $this->label->getLabelText());

        $this->label->setOptions('["option1", "option2"]');
        $this->assertEquals('["option1", "option2"]', $this->label->getOptions());
    }
}
