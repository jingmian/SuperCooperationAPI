<?php


namespace App\Consts\ErrorCode;

/**
 * 2位平台号+2位模块号+3位功能+3位业务码号
 * 内部平台号为10,接单模块04，接任务功能为01，业务错误001
 *
 *
 * Class ReceiveErrorCode
 * @package App\Consts\ErrorCode
 */
class ReceiveErrorCode
{
    const RECEIVE_CERTIFICATION_NOT = 100401001;
    const RECEIVE_FORBIDDEN = 100401002;
    const RECEIVE_BLACKED = 100401003;
    const RECEIVE_LEVEL_NOT_ENOUGH = 100401004;
    const RECEIVE_NOT_SELF = 100401005;
    const RECEIVE_OTHER_RECEIVED = 100401006;
    const RECEIVE_COMPETITION_PRICE_ERROR = 100401007;
    const RECEIVE_CANCEL_LIMIT = 100401008;
    const RECEIVE_FACE_CERTIFY = 100308009;
    const RECEIVE_COMPENSATE = 100308010;
    const RECEIVE_FAILED = 100401011;

    const DELIVERY_HELPER_UN_RECEIVE = 100402001;
    const DELIVERY_EMPLOYER_UN_RECEIVE = 100402002;
    const DELIVERY_FAILED = 100402003;

    const CANCEL_FAILED = 100403001;
    const CANCEL_QUOTED_UN_CONFIRM = 100403002;

    const DEFER_TIME_ERROR = 100404001;
    const DEFER_TIME_NOT = 100404002;
    const DEFER_ONLY_ONCE = 100404003;
    const DEFER_FAILED = 100404004;
}
