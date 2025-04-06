<?php

namespace Aurora\ProductLabels\Api\Data;

interface LabelInterface
{
    const LABEL_ID = 'label_id';
    const LABEL_TEXT = 'label_text';
    const OPTIONS = 'options';

    /**
     * @return mixed
     */
    public function getLabelId(): mixed;

    /**
     * @param int $id
     * @return $this
     */
    public function setLabelId(int $id): static;

    /**
     * @return string|null
     */
    public function getLabelText(): ?string;

    /**
     * @param string $text
     * @return $this
     */
    public function setLabelText(string $text): static;

    /**
     * @return string|null
     */
    public function getOptions(): ?string;

    /**
     * @param string $options
     * @return $this
     */
    public function setOptions(string $options): static;
}
