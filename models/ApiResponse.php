<?php

namespace app\models;

use app\models\Document;
use Yii;

class ApiResponse
{
    const ERROR_TABLET_EMPTY         = 'Не заполнен параметр ID планшета';
    const ERROR_TABLET_NOT_FOUND     = 'Планшет не найден';

    public $result = [
        'error' => 0,
        'error_message' => null,
        'message' => null,
        'data' => [],
    ];

    public function getDocuments()
    {
        $params = Yii::$app->request->get();
        $tablet_id = isset($params['tablet_id']) ? $params['tablet_id'] : null;

        $data = [];
        if(!$tablet_id) {
            $this->addError(self::ERROR_TABLET_EMPTY);
            return $this->result;
        }
        if(!$tablet = Tablet::findOne($tablet_id)) {
            $this->addError(self::ERROR_TABLET_NOT_FOUND);
            return $this->result;
        }

        if($documents = Document::findModels()->andWhere(['tablet_id' => $tablet->id])->andWhere(['canceled' => 0])->all()) {
            foreach($documents as $document) {
                if(!$document->signatures) {
                    $data[] = $document->contentResponse();
                }
            }
        }
        if($data) {
            $this->result['data'] = $data;
        }
    }

    public function setSignatures($data)
    {
        // здесь отправляем емейл, если send_email установлен в true
        if(isset($data['document_id'])) {
            if(!$document = Document::findOne($data['document_id'])) {
                $this->addError('Документ не найден');
                return $this->result;
            }
            if($document->is_signature) {
                $this->addError('Документ уже подписан');
                return $this->result;
            }
            if(isset($data['signatures'])) {
                $document->contentWithSignatures($data['signatures']);
                $document->contentWithPatterns($data);
                $document->generatePdf();
                $document->uploadFile();
                if(!$document->hasDocumentErrors()) {
                    if($document->saveSignatures($data['signatures'])) {
                        $this->result['message'] = 'Успешно добавлено '.count($data['signatures']).' подписей, документ сгенерирован';
                    }
                }
                else {
                    $this->addError($document->getErrorsMessage());
                }
            }
        }
    }












    public function hasErrors()
    {
        return $this->result['error'];
    }
    private function addError($errorMessage)
    {
        $this->result['error'] = 1;
        $this->result['error_message'] = $errorMessage;
        $this->result['data'] = [];
    }
}
