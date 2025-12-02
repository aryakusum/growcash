# Setup Email untuk OTP Verification

Aplikasi GrowCash menggunakan email untuk mengirim kode OTP saat registrasi. Berikut beberapa opsi gratis yang bisa digunakan:

## Opsi 1: Mailtrap (Recommended untuk Development)

Mailtrap adalah service gratis yang bagus untuk testing email tanpa mengirim email ke inbox yang sebenarnya.

1. Daftar di [Mailtrap.io](https://mailtrap.io) (gratis)
2. Buat inbox baru
3. Copy SMTP credentials dari Mailtrap
4. Update file `.env`:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_mailtrap_username
MAIL_PASSWORD=your_mailtrap_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@growcash.com
MAIL_FROM_NAME="GrowCash"
```

## Opsi 2: Gmail SMTP (Gratis)

Gmail menyediakan SMTP gratis dengan batasan tertentu.

1. Aktifkan "Less secure app access" atau gunakan App Password
2. Untuk App Password:
   - Buka Google Account Settings
   - Security > 2-Step Verification (aktifkan dulu)
   - Security > App passwords
   - Generate password untuk "Mail"
3. Update file `.env`:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your_email@gmail.com
MAIL_PASSWORD=your_app_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your_email@gmail.com
MAIL_FROM_NAME="GrowCash"
```

## Opsi 3: Mailgun (Gratis - 5000 emails/bulan)

1. Daftar di [Mailgun](https://www.mailgun.com) (free tier)
2. Verifikasi domain atau gunakan sandbox domain
3. Update file `.env`:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailgun.org
MAIL_PORT=587
MAIL_USERNAME=your_mailgun_username
MAIL_PASSWORD=your_mailgun_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@your_domain.com
MAIL_FROM_NAME="GrowCash"
```

## Opsi 4: Resend (Gratis - 3000 emails/bulan)

1. Daftar di [Resend](https://resend.com) (free tier)
2. Dapatkan API key
3. Install package: `composer require resend/resend-php`
4. Update file `.env`:

```env
MAIL_MAILER=resend
RESEND_KEY=your_resend_api_key
MAIL_FROM_ADDRESS=noreply@yourdomain.com
MAIL_FROM_NAME="GrowCash"
```

## Testing Email

Setelah setup, test dengan:
1. Jalankan `php artisan tinker`
2. Test email:
```php
Mail::raw('Test email', function($message) {
    $message->to('your-email@example.com')
            ->subject('Test Email');
});
```

## Catatan

- Untuk development, gunakan Mailtrap
- Untuk production, gunakan Mailgun atau Resend
- Pastikan `.env` file tidak di-commit ke repository

