<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Post extends Model
{
    protected $fillable = ['title', 'body', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function addComment($data)
    {
        $this->comments()->create($data);
    }

    public function scopeFilter($query, $filters)
    {
        if ($month = (array_key_exists('month', $filters))? $filters['month']:false) {
            $query->whereMonth('created_at', Carbon::parse($month)->month);
        }

        if ($year = (array_key_exists('year', $filters))?$filters['year']:false) {
            $query->whereYear('created_at', $year);
        }

        return $query;
    }

    public static function archives()
    {
        return static::selectRaw('year(created_at) year, monthname(created_at) month, count(*) published')
            ->groupBy('year', 'month')
            ->orderByRaw('min(created_at) desc')
            ->get()
            ->toArray();
    }
}
