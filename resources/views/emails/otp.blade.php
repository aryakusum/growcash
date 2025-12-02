<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kode OTP Verifikasi</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px;">
    <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 30px; text-align: center; border-radius: 10px 10px 0 0;">
        <h1 style="color: white; margin: 0;">GrowCash</h1>
    </div>
    
    <div style="background: #f9fafb; padding: 30px; border-radius: 0 0 10px 10px;">
        <h2 style="color: #1f2937; margin-top: 0;">Verifikasi Email Anda</h2>
        
        <p>Halo {{ $name }},</p>
        
        <p>Terima kasih telah mendaftar di GrowCash. Untuk menyelesaikan proses registrasi, silakan masukkan kode OTP berikut:</p>
        
        <div style="background: white; border: 2px dashed #667eea; border-radius: 10px; padding: 20px; text-align: center; margin: 30px 0;">
            <div style="font-size: 36px; font-weight: bold; color: #667eea; letter-spacing: 10px;">
                {{ $code }}
            </div>
        </div>
        
        <p style="color: #6b7280; font-size: 14px;">
            <strong>Catatan:</strong> Kode ini akan kedaluwarsa dalam 10 menit. Jangan bagikan kode ini kepada siapa pun.
        </p>
        
        <p style="margin-top: 30px; color: #6b7280; font-size: 14px;">
            Jika Anda tidak melakukan registrasi ini, abaikan email ini.
        </p>
    </div>
    
    <div style="text-align: center; margin-top: 20px; color: #9ca3af; font-size: 12px;">
        <p>&copy; {{ date('Y') }} GrowCash. All rights reserved.</p>
    </div>
</body>
</html>

