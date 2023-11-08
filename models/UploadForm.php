<?php

namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFiles;

    public function rules()
    {
        return [
            [['imageFiles'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg', 'maxSize' => 1024 * 1024],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->imageFiles->saveAs('uploads/' . $this->imageFiles->baseName . '.' . $this->imageFiles->extension);
            return true;
        } else {
            return false;
        }
    }
}
