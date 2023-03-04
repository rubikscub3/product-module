<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'price',
        'status',
        'person_id',
        'type',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'person_id' => 'integer',
    ];

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function scopeFilterByName($query, $name)
    {
        return $query->where('name', 'like', '%'.$name.'%');
    }

    public function scopeFilterByPerson($query, $personId)
    {
        return $query->where('person_id', $personId);
    }

    public function recordHistories()
    {
        return $this->hasMany(ProductRecordHistory::class);
    }
}