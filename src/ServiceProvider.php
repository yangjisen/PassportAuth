<?php

namespace YangJiSen\PassportAuth;

use Illuminate\Auth\AuthServiceProvider;
use Laravel\Passport\Passport;

class ServiceProvider extends AuthServiceProvider
{

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/config/passport.php','auth');
    }

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        /* 注册路由 */
        Passport::routes();

        /* Token 过期时间 */
        Passport::tokensExpireIn(
            now()->addDays(config('auth.passport.token_expired', 30))
        );

        /* Token 刷新Token过期时间 */
        Passport::refreshTokensExpireIn(
            now()->addDays(config('auth.passport.refresh_expired', 45))
        );

        /* 个人令牌有效期 */
        Passport::personalAccessTokensExpireIn(
            now()->addDays(config('auth.passport.personal_expired', 30))
        );
    }

}
