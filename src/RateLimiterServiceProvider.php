<?php

declare(strict_types=1);

namespace Oltrematica\RateLimiter;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class RateLimiterServiceProvider extends LaravelServiceProvider
{
    public function boot(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/rate-limiter.php', 'oltrematica-rate-limiter');

        $this->publishes([
            __DIR__.'/../config/rate-limiter.php' => config_path('rate-limiter.php'),
        ], 'ratelimiter-config');

        /*
         * API Rate Limiter
         */

        $this->configureRateLimiters();
        $this->configureLoginRateLimiters();
        $this->configureRegisterRateLimiters();

    }

    public function register() {}

    /**
     * Configures the API rate limiters.
     *
     * This method sets up the rate limiters for the API routes based on the configuration
     * values defined in the `rate-limiter` configuration file.
     *
     * To apply the rate limiters use `throttle:api` middleware in your routes.
     */
    public function configureRateLimiters(): void
    {
        /** @var bool $ignoreAdmins */
        $ignoreAdmins = config('rate-limiter.api.ignore_admins', true);

        /** @var int $limit */
        $limit = config('rate-limiter.api.limit');

        RateLimiter::for('api',
            function (Request $request) use ($limit, $ignoreAdmins) {
                /**
                 * check exists a $request->user() class and it implement isAdmin()
                 */
                if (
                    $ignoreAdmins &&
                    $request->user() !== null &&
                    method_exists($request->user(), 'isAdmin') &&
                    $request->user()->isAdmin()
                ) {
                    return Limit::none();
                }

                return Limit::perMinute($limit)->by($request->user()?->id ?: $request->ip());
            }
        );
    }

    /**
     * Configures the login rate limiters.
     *
     * This method sets up the rate limiters for the login requests based on the configuration
     * values defined in the `rate-limiter` configuration file.
     *
     * To apply the rate limiters use `throttle:login` middleware in your routes.
     */
    public function configureLoginRateLimiters(): void
    {
        /** @var int $login_per_minute */
        $login_per_minute = config('rate-limiter.api.login.limit_per_minute');

        /** @var int $login_per_email */
        $login_per_email = config('rate-limiter.api.login.limit_per_email');

        /**
         * Rate Limit Login
         */
        RateLimiter::for('login', fn (Request $request): array => [
            Limit::perMinute($login_per_minute)->by($request->ip()),
            Limit::perMinute($login_per_email)->by($request->input('email')),
        ]);
    }

    /**
     * Configures the register rate limiters.
     *
     * This method sets up the rate limiters for the register requests based on the configuration
     * values defined in the `rate-limiter` configuration file.
     *
     * To apply the rate limiters use `throttle:register` middleware in your routes.
     */
    public function configureRegisterRateLimiters(): void
    {
        /** @var int $register_limit */
        $register_limit = config('rate-limiter.api.register.limit');

        /**
         * Rate Limit Register
         */
        RateLimiter::for('register', fn (Request $request) => Limit::perMinute($register_limit)->by($request->ip()));
    }
}
