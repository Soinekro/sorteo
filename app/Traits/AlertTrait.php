<?php

namespace App\Traits;

trait AlertTrait
{
    public function alertar($type, $message)
    {
        $this->emit('alert', [
            'type' => $type,
            'message' => $message,
        ]);
    }

    public function alertSuccess($message)
    {
        $this->alertar('success', $message);
    }

    public function alertError($message)
    {
        $this->alertar('error', $message);
    }

    public function alertInfo($message)
    {
        $this->alertar('info', $message);
    }

    public function alertWarning($message)
    {
        $this->alertar('warning', $message);
    }

    public function alertQuestion($message)
    {
        $this->alertar('question', $message);
    }

    public function alertConfirm($message)
    {
        $this->alertar('confirm', $message);
    }

    public function alertToast($message)
    {
        $this->alertar('toast', $message);
    }
}
