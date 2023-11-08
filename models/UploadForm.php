<?php

namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $filePhoto;

    public function rules()
    {
        return [
            [['filePhoto'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg', 'maxSize' => 1024 * 1024],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->filePhoto->saveAs('uploads/' . $this->filePhoto->baseName . '.' . $this->filePhoto->extension);
            return true;
        } else {
            return false;
        }
    }
}
