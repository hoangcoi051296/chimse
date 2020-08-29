<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Customer extends Model implements Authenticatable

{
    use AuthenticableTrait;
    protected $table = 'customer';
    protected $fillable = ['name', 'email', 'phone', 'district_id', 'ward_id', 'password', 'is_active'];
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function data($request = null)
    {
        $data = $this->query()->orderBy('created_at', 'desc');

        if ($request->get('district') !== null) {
            $data = $data->where('district_id', $request->get('district'));
        }
        if ($request->get('ward') !== null) {
            $data = $data->where('ward_id', $request->get('ward'));
        }
        if ($request->get('price') !== null) {
            $price = $request->get('price');
            $data = $data->whereHas('posts', function ($q) use($price){
                $q->where('post.status',7)
                ->having(DB::raw("SUM(post.price)"),$price);
            });
        }
        if ($request->get('search') !== null) {
            $search = $request->get('search');
            $data->where('name', 'LIKE', '%' . $search . '%')
                ->orWhere('email', 'LIKE', '%' . $search . '%')
                ->orWhere('phone', 'LIKE', '%' . $search . '%')
                ->orWhereHas('ward', function ($query) use ($search) {
                    $query->whereHas('district', function ($q) use ($search) {
                        $q->where('name', 'like', '%' . $search . '%');
                    });
                });
        }
        $data = $data->paginate($request->get('per_page', 10));
        return $data;
    }

    public function rules()
    {
        $validate = [
//            'name' => "required",
            'email' => "required",
            'phone' => "required",
            'password' => "required",
        ];
    }

    public function messages(){
        return[
            'name.required' => 'không được để trống',
            'phone.required' => 'Không được để trống',
            'email.required' => 'Không được để trống',
            'password.required' => 'Không được để trống',
        ];
    }
    public function posts()
    {
        return $this->hasMany(Post::class, 'customer_id', 'id');
    }

    public function ward()
    {
        return $this->belongsTo(Ward::class, 'ward_id', 'xaid');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id', 'maqh');
    }

    public function employee()
    {
        return $this->belongsToMany(Employee::class, 'feedback', 'customer_id', 'employee_id')->withPivot('comment', 'rating')->withTimestamps();
    }

    public function getSumMoneyPaidAttribute()
    {
        return $this->posts()->where('post.status',7)->sum('post.price');
    }
}
