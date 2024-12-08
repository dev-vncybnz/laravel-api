<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class Employee extends Model
{
    use HasFactory, SoftDeletes;

    // This is used to specify which fields can be filled using forms/external requests
    protected $fillable = [
        'first_name',
        'last_name',
        'gender',
        'birth_date'
    ];

    // Specify which fields should not be returned
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    // Accessors should be added here so that they will be returned
    protected $appends = [
        'full_name',
    ];

    // Accessor or Custom Attribute
    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->first_name . ' ' . $this->last_name
        );
    }

    public function getEmployees(Request $request)
    {
        $perPage = $request->integer('per_page');
        $keyword = $request->string('keyword');

        $query = $this->search($keyword);

        return $query->paginate($perPage);
    }

    public function scopeSearch($query, $keyword)
    {
        return $query->where('first_name', 'like', "%$keyword%")
            ->orWhere('last_name', 'like', "%$keyword%");
    }
}
