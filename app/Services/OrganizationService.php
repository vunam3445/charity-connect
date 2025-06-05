<?php

namespace App\Services;


use App\Repositories\Repository\OrganizationRepositoryInterface;

class OrganizationService
{
    protected $organizationRepo;

    public function __construct(OrganizationRepositoryInterface $organizationRepo)
    {
        $this->organizationRepo = $organizationRepo;
    }

    // lấy thông tin profile của tổ chức
    public function getProfile(string $id)
    {
        return $this->organizationRepo->findById($id);
    }
    // lấy danh sách tổ chức đang chờ duyệt
    public function getPendingOrganizations()
    {
        return $this->organizationRepo->getPending();
    }

    // lấy danh sách tổ chức đã duyệt
    public function getApprovedOrganizations()
    {
        return $this->organizationRepo->getApproved();
    }
    // duyệt tổ chức
    public function approve(string $id, bool $returnObject = false)
    {
        $organization = $this->organizationRepo->approve($id);
        $organization->approved = 'approved';
        $organization->save();

        return $returnObject ? $organization : true;
    }

    // từ chối tổ chức
    public function reject(string $note,string $id): bool
    {
        return $this->organizationRepo->reject($note,$id)->save();
    }
    // lấy danh sách tổ chức đã bị từ chối
    public function getRejectedOrganizations()
    {
        return $this->organizationRepo->getRejected();
    }
    // tạo mã QR
    public function createQrcode(array $data): string
    {
        // Kiểm tra dữ liệu đầu vào
        if (empty($data['event_id'])) {
            throw new \InvalidArgumentException('Thiếu event_id');
        }
        $filename = 'qr_' . $data['event_id'] . '.png';
        $path = public_path('images/' . $filename); // Đường dẫn thực tế tới file ảnh

        // Nếu file QR đã tồn tại, trả về đường dẫn ảnh cũ
        if (file_exists($path)) {
            return asset('images/' . $filename); // Trả về URL ảnh cho frontend
        }
        return $this->organizationRepo->createQrcode($data);
    }

    // search tổ chức
    public function search(string $keyword)
    {
        return $this->organizationRepo->search($keyword);
    }

        public function getEventPeding(string $organizationId)
    {
        return $this->organizationRepo->getEventPeding($organizationId);
    }
    public function getEventRejected(string $organizationId)
    {
        return $this->organizationRepo->getEventRejected($organizationId);
    }
}
