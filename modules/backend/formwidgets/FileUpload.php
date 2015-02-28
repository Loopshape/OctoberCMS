<?php namespace Backend\FormWidgets;

use Str;
use Input;
use Validator;
use System\Models\File;
use System\Classes\SystemException;
use Backend\Classes\FormField;
use Backend\Classes\FormWidgetBase;
use October\Rain\Support\ValidationException;
use Exception;

/**
 * File upload field
 * Renders a form file uploader field.
 *
 * Supported options:
 * - mode: image-single, image-multi, file-single, file-multi
 * - upload-label: Add file
 * - empty-label: No file uploaded
 *
 * @package october\backend
 * @author Alexey Bobkov, Samuel Georges
 */
class FileUpload extends FormWidgetBase
{
    /**
     * {@inheritDoc}
     */
    public $defaultAlias = 'fileupload';

    public $imageWidth;
    public $imageHeight;
    public $previewNoFilesMessage;

    /**
     * {@inheritDoc}
     */
    public function init()
    {
        $this->imageHeight = $this->getConfig('imageHeight', 100);
        $this->imageWidth = $this->getConfig('imageWidth', 100);
        $this->previewNoFilesMessage = $this->getConfig(
            'previewNoFilesMessage',
            'backend::lang.form.preview_no_files_message'
        );

        $this->checkUploadPostback();
    }

    /**
     * {@inheritDoc}
     */
    public function render()
    {
        $this->prepareVars();
        return $this->makePartial('container');
    }

    /**
     * Prepares the view data
     */
    public function prepareVars()
    {
        $this->vars['fileList'] = $this->getFileList();
        $this->vars['singleFile'] = array_get($this->vars['fileList'], 0, null);
        $this->vars['displayMode'] = $this->getDisplayMode();
        $this->vars['emptyIcon'] = $this->getConfig('emptyIcon', 'icon-plus');
        $this->vars['imageHeight'] = $this->imageHeight;
        $this->vars['imageWidth'] = $this->imageWidth;
    }

    protected function getFileList()
    {
        $list = $this->getRelationObject()->withDeferred($this->sessionKey)->orderBy('sort_order')->get();

        /*
         * Set the thumb for each file
         */
        foreach ($list as $file) {
            $file->thumb = $file->getThumb($this->imageWidth, $this->imageHeight, ['mode' => 'crop']);
        }

        return $list;
    }

    /**
     * Returns the display mode for the file upload. Eg: file-multi, image-single, etc.
     * @return string
     */
    protected function getDisplayMode()
    {
        $mode = $this->getConfig('mode', 'image');

        if (str_contains($mode, '-')) {
            return $mode;
        }

        $relationType = $this->getRelationType();
        $mode .= ($relationType == 'attachMany' || $relationType == 'morphMany') ? '-multi' : '-single';

        return $mode;
    }

    /**
     * Returns the value as a relation object from the model,
     * supports nesting via HTML array.
     * @return Relation
     */
    protected function getRelationObject()
    {
        list($model, $attribute) = $this->resolveModelAttribute($this->valueFrom);
        return $model->{$attribute}();
    }

    /**
     * Returns the value as a relation type from the model,
     * supports nesting via HTML array.
     * @return Relation
     */
    protected function getRelationType()
    {
        list($model, $attribute) = $this->resolveModelAttribute($this->valueFrom);
        return $model->getRelationType($attribute);
    }

    /**
     * Removes a file attachment.
     */
    public function onRemoveAttachment()
    {
        if (($file_id = post('file_id')) && ($file = File::find($file_id))) {
            $this->getRelationObject()->remove($file, $this->sessionKey);
        }
    }

    /**
     * Sorts file attachments.
     */
    public function onSortAttachments()
    {
        if ($sortData = post('sortOrder')) {
            $ids = array_keys($sortData);
            $orders = array_values($sortData);

            $file = new File;
            $file->setSortableOrder($ids, $orders);
        }
    }

    /**
     * Loads the configuration form for an attachment, allowing title and description to be set.
     */
    public function onLoadAttachmentConfig()
    {
        if (($file_id = post('file_id')) && ($file = File::find($file_id))) {
            $this->vars['file'] = $file;
            return $this->makePartial('config_form');
        }

        throw new SystemException('Unable to find file, it may no longer exist');
    }

    /**
     * Commit the changes of the attachment configuration form.
     */
    public function onSaveAttachmentConfig()
    {
        try {
            if (($file_id = post('file_id')) && ($file = File::find($file_id))) {
                $file->title = post('title');
                $file->description = post('description');
                $file->save();

                $file->thumb = $file->getThumb($this->imageWidth, $this->imageHeight, ['mode' => 'crop']);
                return ['item' => $file->toArray()];
            }

            throw new SystemException('Unable to find file, it may no longer exist');
        }
        catch (Exception $ex) {
            return json_encode(['error' => $ex->getMessage()]);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function loadAssets()
    {
        $this->addCss('css/fileupload.css', 'core');
        $this->addJs('js/fileupload.js', 'core');
    }

    /**
     * {@inheritDoc}
     */
    public function getSaveValue($value)
    {
        return FormField::NO_SAVE_DATA;
    }

    /**
     * Checks the current request to see if it is a postback containing a file upload
     * for this particular widget.
     */
    protected function checkUploadPostback()
    {
        if (!($uniqueId = post('X_OCTOBER_FILEUPLOAD')) || $uniqueId != $this->getId()) {
            return;
        }

        try {
            $uploadedFile = Input::file('file_data');

            $isImage = starts_with($this->getDisplayMode(), 'image');

            $validationRules = ['max:'.File::getMaxFilesize()];
            if ($isImage) {
                $validationRules[] = 'mimes:jpg,jpeg,bmp,png,gif,svg';
            }

            $validation = Validator::make(
                ['file_data' => $uploadedFile],
                ['file_data' => $validationRules]
            );

            if ($validation->fails()) {
                throw new ValidationException($validation);
            }

            if (!$uploadedFile->isValid()) {
                throw new SystemException('File is not valid');
            }

            $fileRelation = $this->getRelationObject();

            $file = new File();
            $file->data = $uploadedFile;
            $file->is_public = $fileRelation->isPublic();
            $file->save();

            $fileRelation->add($file, $this->sessionKey);

            $file->thumb = $file->getThumb($this->imageWidth, $this->imageHeight, ['mode' => 'crop']);
            $result = $file;

        }
        catch (Exception $ex) {
            $result = json_encode(['error' => $ex->getMessage()]);
        }

        header('Content-Type: application/json');
        die($result);
    }
}
