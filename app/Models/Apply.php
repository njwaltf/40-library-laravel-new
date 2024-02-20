<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apply extends Model
{
    protected $guarded = ['id'];
    public function scopeSearch($query, $keyword)
    {
        return $query->when($keyword, function ($query, $keyword) {
            $query->where(function ($query) use ($keyword) {
                $query->where('name', 'like', "%$keyword%")
                    ->orWhere('username', 'like', "%$keyword%")
                    ->orWhere('email', 'like', "%$keyword%")
                    ->orWhere('id_no', 'like', "%$keyword%");
            });
        });
    }
    public function scopeFilterByStatus($query, $status)
    {
        return $query->when($status, function ($query, $status) {
            $query->where('status', $status);
        });
    }
    use HasFactory;
}
