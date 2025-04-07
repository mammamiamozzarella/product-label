<?php

namespace Aurora\ProductLabels\Model;

use Aurora\ProductLabels\Api\ProductLabelRepositoryInterface;
use Magento\Framework\App\ResourceConnection;
use Magento\Framework\Exception\LocalizedException;
use Aurora\ProductLabels\Model\ResourceModel\ProductLabel;
use Aurora\ProductLabels\Model\ResourceModel\Label;

class ProductLabelRepository implements ProductLabelRepositoryInterface
{
    /**
     * @param ResourceConnection $resourceConnection
     */
    public function __construct(
        private readonly ResourceConnection $resourceConnection
    ) {
    }

    /**
     * @inheritdoc
     *
     * @throws LocalizedException
     */
    public function assignLabelsToProduct(int $productId, array $labelIds): void
    {
        $connection = $this->resourceConnection->getConnection();
        $table = $this->resourceConnection->getTableName(ProductLabel::TABLE_NAME);

        try {
            $connection->beginTransaction();

            $existingLabelIds = $connection->fetchCol(
                $connection->select()
                    ->from($table, ProductLabel::PRIMARY_KEY)
                    ->where('product_id = ?', $productId)
            );

            $newLabelIds = array_diff($labelIds, $existingLabelIds);

            $labelIdsToRemove = array_diff($existingLabelIds, $labelIds);

            if (!empty($labelIdsToRemove)) {
                $labelIdsToRemoveString = implode(',', $labelIdsToRemove);
                $connection->delete(
                    $table,
                    $connection->quoteInto(
                        'product_id = ? AND label_id IN (' . $labelIdsToRemoveString . ')',
                        $productId
                    )
                );
            }

            foreach ($newLabelIds as $labelId) {
                if (!empty($labelId)) {
                    $connection->insert($table, [
                        'product_id' => $productId,
                        'label_id'   => (int)$labelId,
                    ]);
                }
            }

            $connection->commit();
        } catch (\Exception $e) {
            $connection->rollBack();
            throw new LocalizedException(__('Unable to assign labels to product: %1', $e->getMessage()));
        }
    }

    /**
     * Retrieve labels by product ID
     *
     * @param int $productId
     * @return array
     */
    public function getLabelsByProductId(int $productId): array
    {
        $connection = $this->resourceConnection->getConnection();

        $productLabelsTable = $this->resourceConnection->getTableName(ProductLabel::TABLE_NAME);
        $labelsTable = $this->resourceConnection->getTableName(Label::TABLE_NAME);

        $select = $connection->select()
            ->from(
                ['apl' => $productLabelsTable],
                [ProductLabel::PRIMARY_KEY]
            )
            ->join(
                ['l' => $labelsTable],
                'apl.label_id = l.label_id',
                ['label_text' => 'l.label_text']
            )
            ->where('apl.product_id = :product_id');

        return $connection->fetchAll($select, ['product_id' => $productId]);
    }

    /**
     * Retrieve label IDs by product ID
     *
     * @param int $productId
     * @return array
     */
    public function getLabelsIdsByProductId(int $productId): array
    {
        $connection = $this->resourceConnection->getConnection();

        $productLabelsTable = $this->resourceConnection->getTableName(ProductLabel::TABLE_NAME);

        $select = $connection->select()
            ->from(
                ['apl' => $productLabelsTable],
                ['label_id']
            )
            ->where('apl.product_id = :product_id');

        return $connection->fetchCol($select, ['product_id' => $productId]);
    }
}
