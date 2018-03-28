<?php

namespace App\FLA\Core;
use Exception;
use Illuminate\Support\Facades\DB;

abstract class AbstractBusinessFunction implements BussinesObject
{

    abstract protected function process($input, $oriInput);

    public function execute($input) {
        $oriInput = $input;

        try {
            DB::beginTransaction();

            $result = $this->process($input, $oriInput);

            DB::rollBack();

            return $result;
        } catch (Exception $e) {
            DB::rollBack();
            throw new CoreException($e->getMessage());
        }
    }

}