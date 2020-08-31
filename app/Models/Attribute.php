<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $table = 'attribute';
    protected $fillable = ['name', 'category_id', 'type', 'options'];

    public function data($condition)
    {
        $data = $this->query();
        if (isset($condition['create_from']) && isset($condition['create_to'])) {
            $data->whereDate('created_at', '>=', $condition['create_from'])->whereDate('created_at', '<=',
                $condition['create_to']);
        } elseif (isset($condition['create_from'])) {
            $data->whereDate('created_at', '>=', $condition['create_from']);
        } elseif (isset($condition['create_to'])) {
            $data->whereDate('created_at', '<=', $condition['create_to']);
        }
        if (isset($condition['category'])) {
            $data->where('category_id', $condition['category']);
        }
        if (isset($condition['type'])) {
            $data->where('type', $condition['type']);
        }
        if (isset($condition['search'])) {
            $data->where('name', 'like', '%' . $condition['search'] . '%')
                ->orWhere('type', 'like', '%' . $condition['search'] . '%');
        }
        $data = $data->paginate(15);
        return $data;
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function post()
    {
        return $this->belongsToMany(Post::class, 'post_attribute', 'attribute_id', 'post_id')->withPivot('value');
    }

    public function rules($id = null)
    {
        return [
            'name' => "required| string| max:255|unique:attribute,name," . $id,
            'value.*' => 'required|min:1',
            'key.*' => 'required|min:1',
        ];
    }

    public function message()
    {
        return [
            'name.required' => 'Nhập tên thuộc tính',
            'value.*.required' => 'Nhập giá trị thuộc tính',
            'key.*.required' => 'Nhập giá trị thuộc tính'
        ];
    }

    public function saveData($data)
    {
        if (isset($data['key']) && isset($data['value'])) {
            $data['options'] = json_encode(array_combine($data['key'], $data['value']));
        }
        return $this->fill($data)->save();
    }

    public function updateData($data, $id)
    {
        $attribute = $this->find($id);
        if (isset($data['key']) && isset($data['value'])) {
            $data['options'] = json_encode(array_combine($data['key'], $data['value']));
        }

        if ($data['type'] == 'input' || $data['type'] == 'textarea') {
            $data['options'] = null;
            if ($attribute->post) {
                foreach ($attribute->post as $key => $p) {
                    $attribute->post()->sync([$p->pivot->post_id => ['value' => null]]);
                }
            }

        }
        return $attribute->fill($data)->save();
    }

    public function deleteData($id)
    {
        $this->find($id)->delete();
    }
}
