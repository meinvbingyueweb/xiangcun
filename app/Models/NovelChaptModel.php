<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NovelChaptModel extends Model
{
    //使用软删除
    use SoftDeletes;

    protected $table = 'as_novel_chapt';
}
