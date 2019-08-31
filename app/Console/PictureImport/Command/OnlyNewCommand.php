<?php

namespace App\Console\PictureImport\Command;

use App\Console\Core\Utils\Fingerprint;
use App\Picture;

class OnlyNewCommand extends AbstractImportCommand
{
    protected const TYPE = 'only_new';

    public function execute(array $data): void
    {
        $fingerprints = Picture::getFingerprints();
        $parsedData = $this->filterElementsToProcess($data, $fingerprints);

        foreach ($parsedData as $element)
        {
            /** @var Picture $picture */
            $picture = Picture::findBySourceId($element['id']);

            if (null !== $picture)
            {
                $model = $this->builder->build($element);
                $picture->update($model->getAttributes());

                $this->addResult([
                    'Update picture id: ' . $picture->getSourceId() => $picture->getAttributes()
                ]);
            }
            else
            {
                $picture = $this->builder->build($element);
                $picture->save();

                $this->addResult([
                    'Add picture id: ' . $picture->getSourceId() => $picture->getAttributes()
                ]);
            }
        }
    }

    private function filterElementsToProcess(array $data, array $fingerprints): array
    {
        $parsedArray = [];
        foreach ($data as $element)
        {
            $fingerprint = Fingerprint::make($element);

            if (false === in_array($fingerprint, $fingerprints))
            {
                $parsedArray[$fingerprint] = $element;
            }
        }

        return $parsedArray;
    }
}
