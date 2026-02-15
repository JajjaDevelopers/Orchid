<?php

/**
 * This File contains the subscriber model to handle
 * vistor subscriptions
 *
 * PHP version 8
 *
 * @category  Models
 * @package    App\Models
 * @author     Kibooli Felix <kiboolif@gmail.com>
 * @license  MIT (https://opensource.org/licenses/MIT)
 * @link       https://github.com/KIBOOLI-FELIX/mribrahimsite.git
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * This is a Subscriber model class that
 * handles visitor subscriptions
 *
 * PHP version 8
 *
 * @category  Models
 * @package    App\Models
 * @author     Kibooli Felix <kiboolif@gmail.com>
 * @license  MIT (https://opensource.org/licenses/MIT)
 * @link       https://github.com/KIBOOLI-FELIX/mribrahimsite.git
 */
class Subscriber extends Model
{
    use HasFactory;

    protected $fillable = ['name','email','token','status','ip_address','phone_number','event','eventId'];
/**
 * Get the event that this subscriber registered for.
 *
 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
 */
public function event()
{
    return $this->belongsTo(Events::class, 'eventId');
}
}
