<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\MailSettings;
use App\Models\SiteHeaderSetting;
use App\Traits\EncryptDecrypt;
use App\Traits\ImageUploadTraits;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class SettingController extends Controller
{
    use EncryptDecrypt;
    use ImageUploadTraits;

    public function index(): View
    {
        $emailSetting = MailSettings::findOrFail(1);

        $headerSetting = SiteHeaderSetting::findOrFail(1);

        return view('admin.setting.index',
            [
               'emailSetting' => $emailSetting,
               'headerSetting' => $headerSetting
            ]
        );
    }


    public function updateEmailSetting( Request $request): RedirectResponse
    {
        $validate = $request->validate([
            'mailer' => ['required', 'string' ],
            'update_id' =>  ['required', 'string' ],
            'host' => ['required', 'string' ],
            'port' => ['required', 'string' ],
            'username' => ['required', 'string' ],
            'mail_password' => ['required', 'string' ],
            'encryption' => ['nullable', 'string' ],
            'address' => ['nullable', 'string' ],
        ]);

        $update_id = $this->decryptId($validate['update_id']);

        MailSettings::findOrFail($update_id)->update([
            'mailer' => $validate['mailer'],
            'host' => $validate['host'],
            'port' => $validate['port'],
            'username' => $validate['username'],
            'password' => $validate['mail_password'],
            'encryption' => $validate['encryption'],
            'from_address' => $validate['address'],
        ]);

        return Redirect::route('admin.settings')
            ->with([
                'status' => 'success',
                'message' => 'Email settings updated successfully !!'
            ]);
    }


    public function updateHeaderSetting( Request $request): RedirectResponse
    {
        $validate = $request->validate([
            'logo' => ['nullable', 'image' ],
            'update_id' =>  ['required', 'string' ],
            'address' =>  ['required', 'string' ],
            'working_days' => ['required', 'string' ],
            'phone' => ['required', 'string' ],
            'facebook' => ['nullable', 'string' ],
            'twitter' => ['nullable', 'string' ],
            'pinterest' => ['nullable', 'string' ],
            'google' => ['nullable', 'string' ],
            'vimeo' => ['nullable', 'string' ],
        ]);

        $update_id = $this->decryptId($validate['update_id']);
        $header_settings = SiteHeaderSetting::findOrFail($update_id);

        $imagePath = $this->updateImage($request, 'logo', 'upload/header/logo', $header_settings->logo);
        $updatePath =  empty(!$request->logo) ? $imagePath : $header_settings->logo;

        SiteHeaderSetting::findOrFail($update_id)->update([
            'logo' => $updatePath,
            'address' => $validate['address'],
            'working_days' => $validate['working_days'],
            'phone' => $validate['phone'],
            'facebook' => $validate['facebook'],
            'twitter' => $validate['twitter'],
            'pinterest' => $validate['pinterest'],
            'google' => $validate['google'],
            'vimeo' => $validate['vimeo'],
        ]);

        return Redirect::route('admin.settings')
            ->with([
                'status' => 'success',
                'message' => 'Header settings updated !!'
            ]);
    }

}
