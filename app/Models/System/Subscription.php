<?php

declare(strict_types=1);

namespace App\Models\System;

use Illuminate\Database\Eloquent\Model;
use App\Models\Shared\Traits\HasMetaFields;
use \Stripe\Stripe as Stripe;

/**
 * Subscription Eloquent Model
 *
 * @author Antonio Vargas <localhost.80@gmail.com>
 * @copyright 2020 MdRepTime, LLC
 * @package App\Models\System
 */

class Subscription extends Model
{
    use HasMetaFields;

    /**
     * The database table used by the model.
     *
     * @var string
     * @access protected
     */
    protected $table = 'subscriptions';

    /**
     * @var string ACTIve
     */
    const ACTIVE = 'active';

    /**
     * @var string CANCELED
     */
    const CANCELED = 'canceled';

    /**
     * @var string INCOMPLETE
     */
    const INCOMPLETE = 'incomplete';

    /**
     * @var string INCOMPLETE_EXPIRED
     */
    const INCOMPLETE_EXPIRED = 'incomplete_expired';

    /**
     * @var string PAST_DUE
     */
    const PAST_DUE = 'past_due';

    /**
     * @var stirng TRIALING
     */
    const TRIALING = 'trialing';

    /**
     * @var string UNPAID
     */
    const UNPAID = 'unpaid';

    /**
     * @var array STATUS_TYPES
     */
    const STATUS_TYPES = [
        self::ACTIVE,
        self::CANCELED,
        self::INCOMPLETE,
        self::INCOMPLETE_EXPIRED,
        self::PAST_DUE,
        self::TRIALING,
        self::UNPAID
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array $casts Type casting field columns before interting to database.
     * @access protected
     */
    protected $casts = [
        'id'            => 'integer',
        'user_id'       => 'integer',
        'name'          => 'string',
        'stripe_id'     => 'string',
        'stripe_status' => 'string',
        'stripe_plan'   => 'string',
        'quantity'      => 'integer',
        'meta_fields'   => 'object',
        'trial_ends_at' => 'datetime',
        'ends_at'       => 'datetime',
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime'
    ];
}
