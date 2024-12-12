<?php

namespace App\Imports;

use App\Models\ProductCombinations;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class VariationsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new ProductCombinations([
            'id' => $row['id'],  // Match the header name in the Excel file
            'price' => $row['price'],
            'image' => $this->storeImage($row['combination_image']), // Match exact header name
        ]);
    }

    private function storeImage($image)
    {
        $imagePath = public_path('assets/attribute_images/' . $image);

        if (file_exists($imagePath)) {
            return 'assets/attribute_images/' . $image;
        }

        return null; // Return null if the image doesn't exist
    }
}
