<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\MailSettings;
use App\Traits\EncryptDecrypt;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class SettingController extends Controller
{
    use EncryptDecrypt;

    public function index(): View
    {
        $emailSetting = MailSettings::findOrFail(1);

        return view('admin.setting.index',
            [
               'emailSetting' => $emailSetting
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

}
