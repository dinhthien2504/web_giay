<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json([
            'users' => $users
        ]);
    }
    public function changePassword(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'old_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        // Tìm user theo email
        $user = User::where('email', $request->email)->first();

        // Kiểm tra xem user có tồn tại không
        if (!$user) {
            return response()->json(['message' => 'Tài khoản không tồn tại!'], 404);
        }

        // Kiểm tra mật khẩu cũ có đúng không
        if (!Hash::check($request->old_password, $user->password)) {
            return response()->json(['message' => 'Mật khẩu cũ không đúng!'], 400);
        }

        // Cập nhật mật khẩu mới
        $user->password = Hash::make($request->new_password);
        $user->save();

        return response()->json(['message' => 'Đổi mật khẩu thành công!'], 200);
    }
}
