<?php
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property string title
 * @property array rows
 * @property Carbon created_at
 * @property Carbon updated_at
 */
class Todo extends Model
{
    protected $casts = [
        'rows' => 'array',
    ];
}
