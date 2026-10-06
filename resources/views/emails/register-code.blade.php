<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Your verification code</title>
</head>
<body style="margin:0;padding:24px;background:#05101F;font-family:Arial,Helvetica,sans-serif;color:#EAF2FC;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="max-width:480px;margin:0 auto;background:#0C2138;border:1px solid #1d3550;border-radius:16px;">
        <tr>
            <td style="padding:32px;">
                <h1 style="margin:0 0 12px;font-size:20px;color:#EAF2FC;">Verify your email</h1>
                <p style="margin:0 0 20px;font-size:15px;line-height:1.6;color:#A4BAD6;">
                    Use this code to finish opening your Venture Asia account:
                </p>
                <p style="margin:0 0 20px;font-size:32px;font-weight:700;letter-spacing:8px;color:#2CD4E6;font-family:'Courier New',monospace;">
                    {{ $code }}
                </p>
                <p style="margin:0;font-size:13px;line-height:1.6;color:#6E87A8;">
                    The code expires in {{ $minutes }} minutes. If you didn't request it, you can ignore this email.
                </p>
            </td>
        </tr>
    </table>
</body>
</html>
