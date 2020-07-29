<?php


namespace App\Consts\ErrorCode;

/**
 * 2位平台号+2位模块号+3位功能+3位业务码号
 * 内部平台号为10,用户模块01，登录注册功能为01，秘密错误001
 *
 *
 * Class UserErrorCode
 * @package App\Consts\ErrorCode
 */
class UserErrorCode
{
    const  REGISTER_VALIDATION_ERROR = 100101001;
    const  REGISTER_PHONE_EXIST = 100101002;
    const  REGISTER_FAILED = 100101003;
    const  INFO_NOT_EXIST = 100101004;
    const  INFO_PHONE_NOT_EXIST = 100101006;
    const  LOGIN_PASSWORD_ERROR = 100101007;
    const  MODIFY_PASSWORD_ERROR = 100101008;
    const  MODIFY_PHONE_ERROR = 100101009;
    const  NOT_ADMIN = 100101010;

    const  SKILL_VALIDATION_ERROR = 100102001;
    const  SKILL_EXIST = 100102002;
    const  SKILL_NUM_MAX_LIMIT = 100102003;

    const  FEEDBACK_VALIDATION_ERROR = 100103001;

    const  CERTIFICATION_OKR_VERIFIED = 100104001;
    const  CERTIFICATION_OKR_PARAM_ERROR = 100104002;
    const  CERTIFICATION_OKR_VERIFY_FAILED = 100104003;
    const  CERTIFICATION_OKR_VALIDATION_ERROR = 100104003;
    const  CERTIFICATION_OKR_INFO_NOT_EXIST = 100104005;
    const  CERTIFICATION_OKR_VERIFY_DOING = 100104006;
    const  CERTIFICATION_OKR_UN_APPLY = 100104007;


    const  BANK_VALIDATION_ERROR = 100105001;
    const  BANK_EXIST = 100105002;

    const  ADDRESS_LIB_NOT_EXIST = 100105001;
    const  ADDRESS_VALIDATION_ERROR = 100105002;
    const  ADDRESS_MAX_LIMIT = 100105003;

    const  BLACK_PARAM_ERROR = 100106001;
    const  BLACK_SAVE_NOT_SELF = 100106002;
}
