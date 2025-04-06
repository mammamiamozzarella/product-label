<?php

namespace Aurora\ProductLabels\Model;


use Magento\Framework\Model\AbstractModel;
use Aurora\ProductLabels\Api\Data\LabelInterface;

class Label extends AbstractModel implements LabelInterface
{

    /**
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init(ResourceModel\Label::class);
    }

    /**
     * @return mixed
     */
    public function getLabelId(): mixed
    {
        return $this->getData(self::LABEL_ID);
    }

    /**
     * @param $id
     * @return $this
     */
    public function setLabelId($id): static
    {
        return $this->setData(self::LABEL_ID, $id);
    }

    /**
     * @return string|null
     */
    public function getLabelText(): ?string
    {
        return $this->getData(self::LABEL_TEXT);
    }

    /**
     * @param string $text
     * @return $this
     */
    public function setLabelText(string $text): static
    {
        return $this->setData(self::LABEL_TEXT, $text);
    }

    /**
     * @return string|null
     */
    public function getOptions(): ?string
    {
        return $this->getData(self::OPTIONS);
    }

    /**
     * @param string $options
     * @return $this
     */
    public function setOptions(string $options): static
    {
        return $this->setData(self::OPTIONS, $options);
    }
}
