<?php 
namespace App\Repositories\Contracts;

interface QrRepositoryInterface
{
    public function createQrcode(array $data): string;

}