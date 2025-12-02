<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\OtpCode;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Show login form
     */
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    /**
     * Handle login
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'));
        }

        throw ValidationException::withMessages([
            'email' => __('The provided credentials do not match our records.'),
        ]);
    }

    /**
     * Handle logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    /**
     * Show registration form
     */
    public function showRegisterForm()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.register');
    }

    /**
     * Handle registration - Step 1: Send OTP
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'email' => 'required|string|email|max:255|unique:users',
            'nomor_telepon' => 'required|string|max:20',
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                'regex:/[a-zA-Z]/', // Harus mengandung huruf
                'regex:/[0-9]/', // Harus mengandung angka
            ],
        ], [
            'password.min' => 'Password harus minimal 8 karakter.',
            'password.regex' => 'Password harus kombinasi huruf dan angka.',
        ]);

        // Generate OTP
        $code = OtpCode::generateCode();
        $expiresAt = now()->addMinutes(10);

        // Invalidate previous OTPs for this email
        OtpCode::where('email', $validated['email'])
            ->where('used', false)
            ->update(['used' => true]);

        // Create new OTP
        OtpCode::create([
            'email' => $validated['email'],
            'code' => $code,
            'expires_at' => $expiresAt,
        ]);

        // Send OTP via email
        try {
            Mail::send('emails.otp', [
                'code' => $code,
                'name' => $validated['name'],
            ], function ($message) use ($validated) {
                $message->to($validated['email'])
                    ->subject('Kode OTP Verifikasi GrowCash');
            });
        } catch (\Exception $e) {
            // Log error but continue
            \Log::error('Failed to send OTP email: ' . $e->getMessage());
        }

        // Store registration data in session
        $request->session()->put('registration_data', [
            'name' => $validated['name'],
            'tanggal_lahir' => $validated['tanggal_lahir'],
            'email' => $validated['email'],
            'nomor_telepon' => $validated['nomor_telepon'],
            'password' => $validated['password'],
        ]);

        return redirect()->route('verify-otp')
            ->with('success', 'Kode OTP telah dikirim ke email Anda. Silakan cek email Anda.');
    }

    /**
     * Show OTP verification form
     */
    public function showVerifyOtpForm()
    {
        if (!session('registration_data')) {
            return redirect()->route('register');
        }
        return view('auth.verify-otp');
    }

    /**
     * Verify OTP and complete registration
     */
    public function verifyOtp(Request $request)
    {
        $registrationData = $request->session()->get('registration_data');
        
        if (!$registrationData) {
            return redirect()->route('register')
                ->with('error', 'Sesi registrasi telah berakhir. Silakan daftar kembali.');
        }

        $request->validate([
            'otp_code' => 'required|string|size:6',
        ]);

        // Find valid OTP
        $otp = OtpCode::where('email', $registrationData['email'])
            ->where('code', $request->otp_code)
            ->where('used', false)
            ->where('expires_at', '>', now())
            ->first();

        if (!$otp) {
            return back()->withErrors([
                'otp_code' => 'Kode OTP tidak valid atau telah kedaluwarsa.',
            ])->withInput();
        }

        // Mark OTP as used
        $otp->markAsUsed();

        // Create user
        $user = User::create([
            'name' => $registrationData['name'],
            'tanggal_lahir' => $registrationData['tanggal_lahir'],
            'email' => $registrationData['email'],
            'nomor_telepon' => $registrationData['nomor_telepon'],
            'password' => bcrypt($registrationData['password']),
        ]);

        // Clear session
        $request->session()->forget('registration_data');

        // Login user
        Auth::login($user);

        return redirect()->route('dashboard')
            ->with('success', 'Registrasi berhasil! Selamat datang di GrowCash.');
    }

    /**
     * Resend OTP
     */
    public function resendOtp(Request $request)
    {
        $registrationData = $request->session()->get('registration_data');
        
        if (!$registrationData) {
            return redirect()->route('register')
                ->with('error', 'Sesi registrasi telah berakhir. Silakan daftar kembali.');
        }

        // Generate new OTP
        $code = OtpCode::generateCode();
        $expiresAt = now()->addMinutes(10);

        // Invalidate previous OTPs
        OtpCode::where('email', $registrationData['email'])
            ->where('used', false)
            ->update(['used' => true]);

        // Create new OTP
        OtpCode::create([
            'email' => $registrationData['email'],
            'code' => $code,
            'expires_at' => $expiresAt,
        ]);

        // Send OTP via email
        try {
            Mail::send('emails.otp', [
                'code' => $code,
                'name' => $registrationData['name'],
            ], function ($message) use ($registrationData) {
                $message->to($registrationData['email'])
                    ->subject('Kode OTP Verifikasi GrowCash');
            });
        } catch (\Exception $e) {
            \Log::error('Failed to send OTP email: ' . $e->getMessage());
        }

        return back()->with('success', 'Kode OTP baru telah dikirim ke email Anda.');
    }
}
