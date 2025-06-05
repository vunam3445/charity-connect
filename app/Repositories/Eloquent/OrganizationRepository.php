<?php

namespace App\Repositories\Eloquent;

use App\Models\Organization;
use App\Models\Event;

use App\Repositories\Repository\OrganizationRepositoryInterface;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\Log;

class OrganizationRepository implements OrganizationRepositoryInterface
{
    public function findById(string $id)
    {
        return Organization::findOrFail($id);
    }

    public function getAll()
    {
        return Organization::orderBy('created_at', 'desc')->paginate(10);
    }
    public function getPending()
    {
        return Organization::where('approved', 'pending')->paginate(10);
    }
    public function getApproved()
    {
        return Organization::where('approved', 'approved')->paginate(10);
    }
    public function getRejected()
    {
        return Organization::where('approved', 'rejected')->paginate(10);
    }
    public function reject(string $note, string $id)
    {
        $organization = Organization::findOrFail($id);
        $organization->approved = 'rejected';
        $organization->note = $note;
        $organization->save();
        return $organization;
    }
    public function approve(string $id)
    {
        $organization = Organization::findOrFail($id);
        $organization->approved = 'approved';
        $organization->save();
        return $organization;
    }

    public function createQrcode(array $data): string
    {
        try {
            $path = "/events/checkin/{$data['event_id']}";
            $url = url($path);

            Log::info('Creating QR code for URL: ' . $url);

            $filename = 'qr_' . $data['event_id'] . '.png';
            $fullPath = public_path('images/' . $filename);

            $result = Builder::create()
                ->writer(new PngWriter())
                ->data($url)
                ->size(300)
                ->margin(10)
                ->build();

            $result->saveToFile($fullPath);

            return asset('images/' . $filename);
        } catch (\Exception $e) {
            Log::error('QR Code generation failed: ' . $e->getMessage());
            return '';
        }
    }


    public function search(string $keyword)
    {
        return Organization::where('username', 'like', '%' . $keyword . '%')
            ->orWhere('description', 'like', '%' . $keyword . '%')
            ->orWhere('email', 'like', '%' . $keyword . '%')
            ->orWhere('phone', 'like', '%' . $keyword . '%')
            ->orderBy('created_at', 'desc')

            ->paginate(10);
    }

    public function getEventPeding(string $organizationId)
    {
        return Event::where('organization_id', $organizationId)
            ->where('approved', 'pending')
            ->orderBy('created_at', 'desc')
            ->get();
    }
    public function getEventRejected(string $organizationId)
    {
        return Event::where('organization_id', $organizationId)
            ->where('approved', 'rejected')
             ->orderBy('created_at', 'desc')
            ->get();;
    }
}
