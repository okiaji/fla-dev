<?php

namespace App\FLA\Core;
use App\FLA\Common\CommonConstant;
use App\FLA\Core\Util\DateUtil;
use Exception;
use Illuminate\Support\Facades\DB;

abstract class AbstractBusinessTransaction implements BussinesObject
{

    abstract protected function prepare(&$input, $oriInput);
    abstract protected function process(&$input, $oriInput);

    public function execute($input) {

        $oriInput = $input;

        try {
            DB::beginTransaction();

            $this->prepare($input, $oriInput);
            $result = $this->process($input, $oriInput);

            DB::commit();
            return $result;

        } catch (Exception $e) {
            DB::rollBack();
            throw new CoreException($e->getMessage());
        }
    }

    protected function activated(&$input) {
        $input['active'] = CommonConstant::$YES;
        $input['activeDatetime'] = DateUtil::currentDatetime();
        $input['nonActiveDatetime'] = CommonConstant::$EMPTY_VALUE;
    }

    protected function deActivated(&$input) {
        $input['active'] = CommonConstant::$NO;
        $input['nonActiveDatetime'] = DateUtil::currentDatetime();
        $input['activeDatetime'] = CommonConstant::$EMPTY_VALUE;
    }

}