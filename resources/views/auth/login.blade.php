<x-guest-layout>

    <div style="display: flex; min-height: 100vh; font-family: 'Inter', sans-serif;">

        <div style="flex: 1; background: #1e293b; color: white; padding: 60px; display: flex; flex-direction: column; justify-content: center; align-items: flex-start;">
            <div style="margin-bottom: 40px; font-size: 36px; font-weight: 800;">
                SmartStock
            </div>
            <h1 style="font-size: 28px; font-weight: 700; margin-bottom: 20px;">
                The Command Center
            </h1>
            <p style="font-size: 16px; color: #94a3b8; max-width: 400px;">
                Enterprise-grade inventory management. Simplified tracking, real-time analytics, and seamless distribution.
            </p>
            <div style="margin-top: 40px;">
                <span style="display: inline-block; width: 10px; height: 10px; border-radius: 50%; background-color: #ef4444; margin-right: 8px;"></span>
                <span style="display: inline-block; width: 10px; height: 10px; border-radius: 50%; background-color: #f59e0b; margin-right: 8px;"></span>
                <span style="display: inline-block; width: 10px; height: 10px; border-radius: 50%; background-color: #22c55e;"></span>
            </div>
        </div>

        <div style="flex: 1; background: #f4f7fa; padding: 60px; display: flex; flex-direction: column; justify-content: center;">
            <div style="max-width: 400px; width: 100%; margin: 0 auto; background: white; padding: 40px; border-radius: 20px; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);">

                <h2 style="font-size: 28px; font-weight: 800; color: #1e293b; margin-bottom: 10px;">
                    Welcome Back
                </h2>
                <p style="color: #64748b; margin-bottom: 30px;">
                    Enter your credentials to access the command center.
                </p>

                @if (session('status'))
                <div style="margin-bottom: 20px; font-size: 14px; color: #22c55e; background-color: #ecfdf5; border: 1px solid #a7f3d0; padding: 10px; border-radius: 8px; font-weight: 600;">
                    {{ session('status') }}
                </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div style="margin-bottom: 20px;">
                        <label for="email" style="display: block; font-size: 13px; font-weight: 700; color: #334155; margin-bottom: 8px;">Email Address</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                            style="width: 100%; border: 1px solid #e2e8f0; border-radius: 10px; padding: 12px; font-size: 15px; background: #f8fafc;"
                            placeholder="you@smartstock.com">
                        <x-input-error :messages="$errors->get('email')" class="mt-2" style="color: #ef4444; font-size: 12px; margin-top: 5px;" />
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label for="password" style="display: block; font-size: 13px; font-weight: 700; color: #334155; margin-bottom: 8px;">Password</label>
                        <input id="password" type="password" name="password" required autocomplete="current-password"
                            style="width: 100%; border: 1px solid #e2e8f0; border-radius: 10px; padding: 12px; font-size: 15px; background: #f8fafc;">
                        <x-input-error :messages="$errors->get('password')" class="mt-2" style="color: #ef4444; font-size: 12px; margin-top: 5px;" />
                    </div>

                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
                        <label for="remember_me" style="display: flex; align-items: center;">
                            <input id="remember_me" type="checkbox" name="remember"
                                style="border-radius: 6px; border: 1px solid #e2e8f0; color: #2563eb; margin-right: 8px;">
                            <span style="font-size: 14px; color: #64748b;">Keep me logged in</span>
                        </label>

                        @if (Route::has('password.request'))
                        <a style="font-size: 14px; color: #2563eb; text-decoration: none; font-weight: 600;" href="{{ route('password.request') }}">
                            Forgot Password?
                        </a>
                        @endif
                    </div>

                    <button type="submit"
                        style="width: 100%; background: #2563eb; color: white; padding: 14px 24px; border-radius: 12px; font-weight: 700; border: none; cursor: pointer; box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3); transition: background 0.2s;"
                        onmouseover="this.style.background='#1d4ed8'" onmouseout="this.style.background='#2563eb'">
                        Sign In
                    </button>

                    <div style="text-align: center; margin-top: 25px;">
                        New to the system?
                        <a href="{{ route('register') }}" style="font-size: 14px; color: #2563eb; text-decoration: none; font-weight: 700;">
                            Create an account
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>