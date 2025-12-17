<x-guest-layout>
    <div style="display: grid; grid-template-columns: 1fr 1fr; min-height: 100vh; font-family: 'Inter', sans-serif;">

        <div style="background: #1e293b; display: flex; flex-direction: column; justify-content: center; padding: 60px; color: white;">
            <h1 style="font-size: 42px; font-weight: 900; letter-spacing: -1px; margin-bottom: 20px;">Join SmartStock</h1>
            <p style="font-size: 18px; color: #94a3b8; line-height: 1.6;">Start managing your inventory with precision and scale.</p>
        </div>

        <div style="background: white; display: flex; align-items: center; justify-content: center; padding: 40px;">
            <div style="width: 100%; max-width: 400px;">
                <h2 style="font-size: 28px; font-weight: 800; color: #1e293b; margin-bottom: 32px;">Create Account</h2>

                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div style="margin-bottom: 20px;">
                        <label style="font-weight: 700; color: #475569; font-size: 13px;">Full Name</label>
                        <input type="text" name="name" required style="width: 100%; border-radius: 12px; border: 1px solid #e2e8f0; padding: 12px 16px; margin-top: 8px;">
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label style="font-weight: 700; color: #475569; font-size: 13px;">Work Email</label>
                        <input type="email" name="email" required style="width: 100%; border-radius: 12px; border: 1px solid #e2e8f0; padding: 12px 16px; margin-top: 8px;">
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label style="font-weight: 700; color: #475569; font-size: 13px;">Password</label>
                        <input type="password" name="password" required style="width: 100%; border-radius: 12px; border: 1px solid #e2e8f0; padding: 12px 16px; margin-top: 8px;">
                    </div>

                    <div style="margin-bottom: 24px;">
                        <label style="font-weight: 700; color: #475569; font-size: 13px;">Confirm Password</label>
                        <input type="password" name="password_confirmation" required style="width: 100%; border-radius: 12px; border: 1px solid #e2e8f0; padding: 12px 16px; margin-top: 8px;">
                    </div>

                    <button type="submit" style="width: 100%; background: #3b82f6; color: white; padding: 14px; border-radius: 12px; font-weight: 800; border: none; cursor: pointer;">
                        Register Account
                    </button>

                    <a href="{{ route('login') }}" style="display: block; text-align: center; margin-top: 20px; color: #64748b; font-size: 14px; text-decoration: none;">Already have an account? <b>Login</b></a>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>