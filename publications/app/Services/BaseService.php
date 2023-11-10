<?php

namespace App\Services;

use App\Repositories as Repos;
use App\Repositories\Entities\UserEntity;

/**
 * 基底Serviceクラス
 * 
 * ServiceはControllerと1対1であり、ビジネスロジック部分担当。
 * 各Repositoryのインスタンスをメンバ変数として保持しておく。
 * ServiceはControllerのConstructでインスタンス化し、保持する。
 */
abstract class BaseService
{
    public readonly Repos\EmailResetRepository $EmailResetRepository;
    public readonly Repos\PasswordResetTokenRepository $PasswordResetTokenRepository;
    public readonly Repos\UserRepository $UserRepository;

    function __construct()
    {
        $this->EmailResetRepository         = new Repos\EmailResetRepository;
        $this->PasswordResetTokenRepository = new Repos\PasswordResetTokenRepository;
        $this->UserRepository               = new Repos\UserRepository;
    }

    public function authUserEntity(): UserEntity
    {
        return $this->UserRepository->findById(authUserId());
    }
}