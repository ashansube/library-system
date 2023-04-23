<?php

namespace App\Http\Controllers\Admin;

use Vonage\Client;
use App\Models\User;
use Vonage\SMS\Message\SMS;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Vonage\Client\Credentials\Basic;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);
        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:11'],
            'password' => ['required', 'string', 'min:8'],
            'role_as' => ['required', 'integer'],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role_as' => $request->role_as,
        ]);

        return redirect('/admin/users')->with('message', 'User Created Successfully');
    }

    public function edit(int $userId)
    {
        $user = User::findOrFail($userId);
        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, int $userId)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:11'],
            'password' => ['required', 'string', 'min:8'],
            'role_as' => ['required', 'integer'],
        ]);

        User::findOrFail($userId)->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role_as' => $request->role_as,
        ]);

        return redirect('/admin/users')->with('message', 'User Updated Successfully');
    }

    public function destroy(int $userId)
    {
        $user = User::findOrFail($userId);
        $user->delete();

        return redirect('/admin/users')->with('message', 'User Deleted Successfully');
    }

    public function getSMSDeta(int $userId)
    {
        $user = User::findOrFail($userId);
        return view('admin.user.send-sms', compact('user'));
    }

    public function sendSMS(Request $request)
    {
        $to = $request->to;
        $text = $request->text;

        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://rest.nexmo.com/sms/json',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>'{
            "from": "Vonage APIs",
            "text":"'.$text.'",
            "to" : "'.$to.'",
            "api_key" : "'.env('VONAGE_API_KEY').'",
            "api_secret" : "'.env('VONAGE_API_SECRET').'"
        }',
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;

        return redirect('/admin/users')->with('message', 'SMS Sent Successfully');
    }
}
